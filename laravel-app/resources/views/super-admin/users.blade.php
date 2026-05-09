<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — All Users</title>
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
      <div class="topbar-title" id="topbar-title">All Users</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-purple badge" id="topbar-role-badge">SUPER ADMIN</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page sa-page" id="page-super-admin-users">
        <div class="section-header">
          <div class="section-title">User Management</div>
          <div class="section-sub">Search, filter, change roles, or remove users</div>
        </div>

        <div class="panel" style="margin-bottom:1.2rem;">
          <div class="panel-body">
            <div class="sa-filter-row">
              <input class="input sa-filter-search" id="sa-user-search" placeholder="Search name or email…" oninput="saLoadUsers()">
              <select class="input sa-filter-role" id="sa-user-role-filter" onchange="saLoadUsers()">
              <option value="all">All Roles</option>
              <option value="member">Member</option>
              <option value="coach">Coach</option>
              <option value="admin">Gym Admin</option>
              <option value="nutrition-specialist">Nutrition Specialist</option>
              <option value="user">User</option>
              </select>
              <span id="sa-user-count" class="badge badge-muted sa-user-count"></span>
            </div>
          </div>
        </div>

        <div class="panel">
          <div class="panel-body" style="padding:0;">
            <div id="sa-users-table-wrap">
              <div class="empty-state" style="padding:2rem;"><i class="fas fa-users"></i><p>Loading users…</p></div>
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
