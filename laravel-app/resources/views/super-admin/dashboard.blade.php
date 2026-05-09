<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Super Admin Dashboard</title>
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
      <button class="logout-btn" onclick="doLogout()">
        <i class="fas fa-sign-out-alt"></i><span>Log Out</span>
      </button>
    </div>
  </nav>

  <div class="main" id="main">
    <div class="topbar">
      <div class="topbar-title" id="topbar-title">Super Admin</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-purple badge" id="topbar-role-badge">SUPER ADMIN</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page sa-page" id="page-super-admin-dashboard">
        <div class="section-header">
          <div class="section-title">Platform Overview</div>
          <div class="section-sub">Live stats across all gyms, coaches, and members</div>
        </div>

        <!-- KPI Cards -->
        <div class="sa-kpi-grid">
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(168,85,247,0.15);color:#a855f7;"><i class="fas fa-users"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Total Users</div>
              <div class="sa-kpi-value" id="sa-stat-total-users">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(74,222,128,0.15);color:#4ade80;"><i class="fas fa-id-card"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Members</div>
              <div class="sa-kpi-value" id="sa-stat-members">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(96,165,250,0.15);color:#60a5fa;"><i class="fas fa-user-tie"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Coaches</div>
              <div class="sa-kpi-value" id="sa-stat-coaches">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(249,115,22,0.15);color:#f97316;"><i class="fas fa-dumbbell"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Gyms</div>
              <div class="sa-kpi-value" id="sa-stat-gyms">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(232,255,71,0.12);color:var(--accent);"><i class="fas fa-dollar-sign"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Total Revenue</div>
              <div class="sa-kpi-value" id="sa-stat-revenue">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(248,113,113,0.15);color:#f87171;"><i class="fas fa-qrcode"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Check-ins Today</div>
              <div class="sa-kpi-value" id="sa-stat-checkins-today">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(250,204,21,0.15);color:#facc15;"><i class="fas fa-apple-whole"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Nutrition Specialists</div>
              <div class="sa-kpi-value" id="sa-stat-nutrition">—</div>
            </div>
          </div>
          <div class="sa-kpi-card">
            <div class="sa-kpi-icon" style="background:rgba(34,197,94,0.15);color:#22c55e;"><i class="fas fa-shopping-bag"></i></div>
            <div class="sa-kpi-body">
              <div class="sa-kpi-label">Total Orders</div>
              <div class="sa-kpi-value" id="sa-stat-orders">—</div>
            </div>
          </div>
        </div>

        <div class="sa-panel-grid" style="margin-top:1.5rem;">
          <!-- Role distribution -->
          <div class="panel">
            <div class="panel-header"><div class="panel-title"><i class="fas fa-chart-pie" style="color:var(--accent);margin-right:8px;"></i>User Distribution</div></div>
            <div class="panel-body" id="sa-role-distribution-list"></div>
          </div>

          <!-- Top coaches snapshot -->
          <div class="panel">
            <div class="panel-header">
              <div class="panel-title"><i class="fas fa-star" style="color:var(--accent);margin-right:8px;"></i>Top Coaches</div>
              <button class="btn btn-sm btn-secondary" onclick="switchPage('super-admin-reports')">View All</button>
            </div>
            <div class="panel-body" id="sa-top-coaches-list"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../assets/js/app.js"></script>
</body>
</html>
