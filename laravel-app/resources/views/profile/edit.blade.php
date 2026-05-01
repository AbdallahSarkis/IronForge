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
        <div class="user-name" id="user-name-label">{{ $user->name }}</div>
        <div class="user-role" id="user-role-badge">{{ ucfirst($user->role) }}</div>
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
      <div class="topbar-title" id="topbar-title">Edit Profile</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page active">
        <div class="section-header">
          <div class="section-title">Edit General Information</div>
          <div class="section-sub">Update your profile details</div>
        </div>

        @if ($errors->any())
          <div class="alert" style="margin-bottom:14px;padding:12px 14px;border-radius:10px;background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.4);color:#fecaca;font-size:0.85rem;">
            <i class="fas fa-exclamation-circle" style="margin-right:8px;"></i>
            {{ $errors->first() }}
          </div>
        @endif

        @if (session('status'))
          <div class="alert" style="margin-bottom:14px;padding:12px 14px;border-radius:10px;background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.4);color:#bbf7d0;font-size:0.85rem;">
            <i class="fas fa-check-circle" style="margin-right:8px;"></i>
            {{ session('status') }}
          </div>
        @endif

        <div class="panel">
          <div class="panel-body">
            <form method="POST" action="/{{ $user->role }}/profile/update">
              @csrf

              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
              </div>

              <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
              </div>

              <div class="form-group">
                <label class="form-label">Gender</label>
                <select class="form-control" name="gender" required>
                  <option value="">Select gender</option>
                  <option value="male" @selected($user->gender === 'male')>Male</option>
                  <option value="female" @selected($user->gender === 'female')>Female</option>
                  <option value="other" @selected($user->gender === 'other')>Other</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" value="{{ $user->date_of_birth?->format('Y-m-d') }}" required>
              </div>

              <div style="display:flex;gap:10px;margin-top:20px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">
                  <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="/{{ $user->role }}/dashboard.html" class="btn btn-secondary" style="flex:1;text-align:center;text-decoration:none;">
                  <i class="fas fa-times"></i> Cancel
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../assets/js/app.js"></script>
<script>
  // Hide sidebar nav and search for profile page
  document.addEventListener('DOMContentLoaded', function() {
    const nav = document.getElementById('sidebar-nav');
    if (nav) {
      nav.innerHTML = '<div class="nav-section-label">Navigation</div>';
      nav.innerHTML += `
        <button class="nav-item" onclick="window.location.href='dashboard.html'" style="display:flex;align-items:center;gap:10px;">
          <i class="fas fa-arrow-left"></i><span>Back to Dashboard</span>
        </button>
      `;
    }
  });
</script>
</body>
</html>
