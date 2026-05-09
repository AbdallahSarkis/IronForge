<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE - User Access</title>
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
      <div class="user-avatar" id="user-avatar">SA</div>
      <div class="user-info">
        <div class="user-name" id="user-name-label">Super Admin</div>
        <div class="user-role role-super-admin" id="user-role-badge">Super Admin</div>
      </div>
    </div>
    <div class="sidebar-nav" id="sidebar-nav"></div>
    <div class="sidebar-footer">
      <button class="logout-btn" onclick="doLogout()"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></button>
    </div>
  </nav>

  <div class="main" id="main">
    <div class="topbar">
      <div class="topbar-title" id="topbar-title">User Access</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-purple badge" id="topbar-role-badge">SUPER ADMIN</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page sa-page" id="page-super-admin-user-access">
        <div class="section-header">
          <div class="section-title">User Access</div>
          <div class="section-sub">Select a user and control module permissions across the whole project</div>
        </div>

        <div class="sa-access-grid">
          <div class="panel">
            <div class="panel-header">
              <div class="panel-title"><i class="fas fa-users" style="color:var(--accent);margin-right:8px;"></i>Users</div>
            </div>
            <div class="panel-body">
              <input id="sa-access-user-search" class="input" placeholder="Search users..." style="margin-bottom:0.8rem;">
              <div id="sa-access-users-list" class="sa-access-users-list">
                <div class="empty-state" style="padding:1.2rem;"><i class="fas fa-spinner fa-spin"></i><p>Loading users...</p></div>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-header">
              <div class="panel-title"><i class="fas fa-shield-halved" style="color:var(--accent);margin-right:8px;"></i>Modules</div>
              <button class="btn btn-sm btn-primary" onclick="saSaveSelectedUserModules()"><i class="fas fa-save"></i> Save Access</button>
            </div>
            <div class="panel-body">
              <div id="sa-access-selected-user" class="muted" style="margin-bottom:0.9rem;">Select a user to edit access</div>
              <div id="sa-access-modules-list" class="sa-access-modules-list">
                <div class="muted">No user selected.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../assets/js/app.js"></script>
</body>
</html>
