<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Reports</title>
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
      <div class="topbar-title" id="topbar-title">Reports</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-purple badge" id="topbar-role-badge">SUPER ADMIN</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page sa-page" id="page-super-admin-reports">
        <div class="section-header">
          <div class="section-title">Platform Reports</div>
          <div class="section-sub">Revenue, activity, and product analytics</div>
        </div>

        <div class="sa-panel-grid">
          <div class="panel">
            <div class="panel-header"><div class="panel-title"><i class="fas fa-shopping-bag" style="color:var(--accent);margin-right:8px;"></i>Orders by Status</div></div>
            <div class="panel-body" id="sa-orders-by-status"></div>
          </div>
          <div class="panel">
            <div class="panel-header"><div class="panel-title"><i class="fas fa-trophy" style="color:var(--accent);margin-right:8px;"></i>Top Selling Products</div></div>
            <div class="panel-body" id="sa-top-products"></div>
          </div>
        </div>

        <div class="panel" style="margin-top:1.5rem;">
          <div class="panel-header"><div class="panel-title"><i class="fas fa-qrcode" style="color:var(--accent);margin-right:8px;"></i>Check-ins (Last 30 Days)</div></div>
          <div class="panel-body" id="sa-checkin-chart"></div>
        </div>

        <div class="panel" style="margin-top:1.5rem;">
          <div class="panel-header"><div class="panel-title"><i class="fas fa-user-tie" style="color:var(--accent);margin-right:8px;"></i>All Coaches</div></div>
          <div class="panel-body" style="padding:0;">
            <div id="sa-coaches-table"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../assets/js/app.js"></script>
</body>
</html>
