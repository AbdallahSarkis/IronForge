<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Edit Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div id="app">
  <nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="sidebar-logo">
        <div class="icon"><i class="fas fa-dumbbell"></i></div>
        <div class="name">IRONFORGE</div>
      </div>
      <button class="collapse-btn" onclick="toggleSidebar()" id="collapse-btn">
        <i class="fas fa-chevron-left" id="collapse-icon"></i>
      </button>
    </div>

    <div class="sidebar-user" id="sidebar-user">
      <div class="user-avatar" id="user-avatar">JD</div>
      <div class="user-info">
        <div class="user-name" id="user-name-label">John Doe</div>
        <div class="user-role role-user" id="user-role-badge">User</div>
      </div>
    </div>

    <div class="sidebar-nav" id="sidebar-nav">
      <!-- Dynamic nav items injected here -->
    </div>

    <div class="sidebar-footer">
      <button class="logout-btn" onclick="doLogout()">
        <i class="fas fa-sign-out-alt"></i>
        <span>Log Out</span>
      </button>
    </div>
  </nav>

  <div class="main" id="main">
    <div class="topbar">
      <div class="topbar-title" id="topbar-title">Profile</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page" id="page-user-profile">
        <div class="section-header">
          <div class="section-title">Edit General Information</div>
          <div class="section-sub">Update your profile details</div>
        </div>

        <div id="profile-message" style="margin-bottom:14px;"></div>

        <div class="panel" style="max-width:600px;">
          <div class="panel-body">
            <form id="profile-form" method="POST" action="/user/profile/update">
              @csrf

              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="profile-name" required>
              </div>

              <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="profile-email" required>
              </div>

              <div class="form-group">
                <label class="form-label">Gender</label>
                <select class="form-control" name="gender" id="profile-gender" required>
                  <option value="">Select gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" id="profile-dob" required>
              </div>

              <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" name="location_address" id="profile-location-address" placeholder="Search your location or click on the map">
                <input type="hidden" name="location_latitude" id="profile-latitude">
                <input type="hidden" name="location_longitude" id="profile-longitude">
              </div>

              <div class="form-group">
                <label class="form-label">Map</label>
                <div id="profile-map" style="height:280px;border:1px solid rgba(255,255,255,0.12);border-radius:12px;overflow:hidden;"></div>
                <button type="button" class="btn btn-secondary btn-sm" onclick="useMyCurrentLocation()" style="margin-top:10px;">
                  <i class="fas fa-location-crosshairs"></i> Use My Current Location
                </button>
                <div style="margin-top:8px;color:var(--muted);font-size:0.82rem;">Tip: Click on the map to pin your exact location.</div>
              </div>

              <div style="display:flex;gap:10px;margin-top:20px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">
                  <i class="fas fa-save"></i> Save Changes
                </button>
                <button type="button" class="btn btn-secondary" onclick="switchPage('user-dashboard')" style="flex:1;">
                  <i class="fas fa-arrow-left"></i> Back to Dashboard
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div id="toast" class="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg">Done!</span>
</div>

<script src="../assets/js/app.js"></script>
@php($mapsApiKey = config('services.google_maps.key'))
<script>
let profileMap;
let profileMarker;
let profileGeocoder;
let profileAutocomplete;

function setProfileMarker(lat, lng) {
  const position = { lat, lng };
  profileMap.setCenter(position);
  if (!profileMarker) {
    profileMarker = new google.maps.Marker({
      position,
      map: profileMap,
      draggable: true,
    });
    profileMarker.addListener('dragend', () => {
      const p = profileMarker.getPosition();
      if (!p) return;
      updateCoordinates(p.lat(), p.lng());
      reverseGeocode(p.lat(), p.lng());
    });
  } else {
    profileMarker.setPosition(position);
  }
}

function updateCoordinates(lat, lng) {
  document.getElementById('profile-latitude').value = lat.toFixed(7);
  document.getElementById('profile-longitude').value = lng.toFixed(7);
}

function reverseGeocode(lat, lng) {
  if (!profileGeocoder) return;
  profileGeocoder.geocode({ location: { lat, lng } }, (results, status) => {
    if (status === 'OK' && results && results[0]) {
      document.getElementById('profile-location-address').value = results[0].formatted_address;
    }
  });
}

function useMyCurrentLocation() {
  if (!navigator.geolocation) {
    showToast('Geolocation is not supported on this device');
    return;
  }

  navigator.geolocation.getCurrentPosition((position) => {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;

    updateCoordinates(lat, lng);

    if (window.google && window.google.maps && !profileMap) {
      window.initProfileMap();
    }

    if (profileMap) {
      setProfileMarker(lat, lng);
      profileMap.setZoom(16);
      reverseGeocode(lat, lng);
    }

    showToast('Current location captured');
  }, () => {
    showToast('Location permission denied or unavailable');
  }, {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 0,
  });
}

window.initProfileMap = function initProfileMap() {
  const mapEl = document.getElementById('profile-map');
  if (!mapEl || !window.google || !window.google.maps) return;

  const fallbackCenter = { lat: 25.2048, lng: 55.2708 };
  const latVal = parseFloat(document.getElementById('profile-latitude').value || '');
  const lngVal = parseFloat(document.getElementById('profile-longitude').value || '');
  const hasSavedCoords = !Number.isNaN(latVal) && !Number.isNaN(lngVal);

  profileMap = new google.maps.Map(mapEl, {
    center: hasSavedCoords ? { lat: latVal, lng: lngVal } : fallbackCenter,
    zoom: hasSavedCoords ? 14 : 10,
    mapTypeControl: false,
    streetViewControl: false,
  });

  profileGeocoder = new google.maps.Geocoder();

  if (hasSavedCoords) {
    setProfileMarker(latVal, lngVal);
  }

  const input = document.getElementById('profile-location-address');
  profileAutocomplete = new google.maps.places.Autocomplete(input, {
    fields: ['geometry', 'formatted_address'],
  });

  profileAutocomplete.addListener('place_changed', () => {
    const place = profileAutocomplete.getPlace();
    if (!place.geometry || !place.geometry.location) return;
    const lat = place.geometry.location.lat();
    const lng = place.geometry.location.lng();
    setProfileMarker(lat, lng);
    updateCoordinates(lat, lng);
    if (place.formatted_address) {
      input.value = place.formatted_address;
    }
  });

  profileMap.addListener('click', (event) => {
    const lat = event.latLng.lat();
    const lng = event.latLng.lng();
    setProfileMarker(lat, lng);
    updateCoordinates(lat, lng);
    reverseGeocode(lat, lng);
  });
};

document.addEventListener('DOMContentLoaded', async function() {
  try {
    const response = await fetch('/session-user', {
      headers: { Accept: 'application/json' },
      credentials: 'same-origin',
    });

    if (response.ok) {
      const user = await response.json();
      document.getElementById('profile-name').value = user.name || '';
      document.getElementById('profile-email').value = user.email || '';
      document.getElementById('profile-gender').value = user.gender || '';
      document.getElementById('profile-dob').value = user.date_of_birth || '';
      document.getElementById('profile-location-address').value = user.location_address || '';
      document.getElementById('profile-latitude').value = user.location_latitude ?? '';
      document.getElementById('profile-longitude').value = user.location_longitude ?? '';

      if (window.google && window.google.maps) {
        window.initProfileMap();
      }

      const noSavedCoords = !user.location_latitude || !user.location_longitude;
      if (noSavedCoords) {
        useMyCurrentLocation();
      }
    }
  } catch (error) {
    // Keep form usable even if profile prefill fails.
  }

  const profileForm = document.getElementById('profile-form');
  if (!profileForm) return;

  profileForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    try {
      const response = await fetch(this.action, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
      });

      if (!response.ok) {
        showToast('Error updating profile');
        return;
      }

      showToast('Profile updated successfully!');
      setTimeout(() => {
        window.location.href = '/user/dashboard.html';
      }, 800);
    } catch (error) {
      showToast('Error updating profile');
    }
  });
});
</script>
@if($mapsApiKey)
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $mapsApiKey }}&libraries=places&callback=initProfileMap"></script>
@else
<script>
document.addEventListener('DOMContentLoaded', function() {
  const mapEl = document.getElementById('profile-map');
  if (!mapEl) return;
  mapEl.innerHTML = '<div style="padding:14px;color:var(--muted);font-size:0.9rem;">Google Maps is not configured. Add GOOGLE_MAPS_API_KEY in .env to enable map selection.</div>';
});
</script>
@endif
</body>
</html>
