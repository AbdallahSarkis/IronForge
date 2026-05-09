<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE - Nutrition Specialist Profile</title>
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
      <div class="user-avatar" id="user-avatar">NS</div>
      <div class="user-info">
        <div class="user-name" id="user-name-label">Nutrition Specialist</div>
        <div class="user-role role-nutrition-specialist" id="user-role-badge">Nutrition Specialist</div>
      </div>
    </div>

    <div class="sidebar-nav" id="sidebar-nav"></div>

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
      <div class="page" id="page-nutrition-specialist-profile">
        <div class="section-header">
          <div class="section-title">Edit General Information</div>
          <div class="section-sub">Update your profile details</div>
        </div>

        <div id="profile-message" style="margin-bottom:14px;"></div>

        <div class="panel" style="max-width:600px;">
          <div class="panel-body">
            <form id="profile-form" method="POST" action="/nutrition-specialist/profile/update">
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
                <input type="text" class="form-control" name="location_address" id="profile-location-address" placeholder="Search your location">
                <input type="hidden" name="location_latitude" id="profile-latitude">
                <input type="hidden" name="location_longitude" id="profile-longitude">
              </div>

              <div style="display:flex;gap:10px;margin-top:20px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">
                  <i class="fas fa-save"></i> Save Changes
                </button>
                <button type="button" class="btn btn-secondary" onclick="switchPage('nutrition-specialist-dashboard')" style="flex:1;">
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

<div id="toast" class="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg">Done!</span>
</div>

<script src="../assets/js/app.js"></script>
</body>
</html>
