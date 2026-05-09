<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Gyms</title>
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
      <div class="topbar-title" id="topbar-title">Gyms</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-purple badge" id="topbar-role-badge">SUPER ADMIN</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page sa-page" id="page-super-admin-gyms">
        <div class="section-header">
          <div class="section-title">All Gyms</div>
          <div class="section-sub">Every gym registered on the platform</div>
        </div>
        <div class="panel">
          <div class="panel-body">
            <div id="sa-gyms-list" class="sa-gyms-grid">
              <div class="empty-state"><i class="fas fa-dumbbell"></i><p>Loading gyms…</p></div>
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
