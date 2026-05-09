<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE - Nutrition Members</title>
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
      <div class="topbar-title" id="topbar-title">Members</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
      </div>
    </div>

    <div class="page-content">
      <div class="page" id="page-nutrition-specialist-members">
        <div class="section-header">
          <div class="section-title">Members Nutrition Targets</div>
          <div class="section-sub">Set target and max calories, carbs, and proteins per member</div>
        </div>
        <div class="grid-2" id="nutrition-specialist-members-list"></div>
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
