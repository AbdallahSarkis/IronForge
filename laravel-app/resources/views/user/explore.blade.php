<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IRONFORGE — Gym Management</title>
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
      <div class="topbar-title" id="topbar-title">Explore</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
        <button class="btn btn-secondary btn-sm" id="cart-btn" onclick="toggleCart()" style="display:none;">
          <i class="fas fa-shopping-bag"></i> Cart <span id="cart-count" style="background:var(--accent);color:#000;border-radius:20px;padding:1px 7px;font-size:0.75rem;margin-left:2px;"></span>
        </button>
      </div>
    </div>
    <div class="page-content">
<div class="page" id="page-user-explore">
        <div class="section-header">
          <div class="section-title">Explore Fitness Around You</div>
          <div class="section-sub">Find nearby gyms and coaches before choosing a membership plan.</div>
        </div>
        <div class="stats-grid">
          <div class="stat-card accent">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-calendar-check"></i></div>
              <span class="badge badge-green">Active</span>
            </div>
            <div class="stat-card-val">3</div>
            <div class="stat-card-label">Upcoming Sessions</div>
          </div>
          <div class="stat-card blue">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-dumbbell"></i></div>
            </div>
            <div class="stat-card-val">12</div>
            <div class="stat-card-label">Workouts This Month</div>
          </div>
          <div class="stat-card purple">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-fire"></i></div>
            </div>
            <div class="stat-card-val">7</div>
            <div class="stat-card-label">Day Streak</div>
          </div>
          <div class="stat-card green">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-shopping-bag"></i></div>
            </div>
            <div class="stat-card-val">2</div>
            <div class="stat-card-label">Recent Orders</div>
          </div>
        </div>

        <div class="grid-2">
          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Membership</div>
                <span class="badge badge-accent">Premium</span>
              </div>
              <div class="panel-body">
                <div class="membership-card">
                  <div class="membership-tier">PREMIUM</div>
                  <div class="membership-plan">ACTIVE MEMBER</div>
                  <div style="display:flex;justify-content:space-between;align-items:flex-end;">
                    <div>
                      <div style="color:var(--muted);font-size:0.78rem;margin-bottom:3px;">Expires</div>
                      <div style="font-weight:600;">Dec 31, 2026</div>
                    </div>
                    <div style="text-align:right;">
                      <div style="color:var(--muted);font-size:0.78rem;margin-bottom:3px;">Member ID</div>
                      <div style="font-weight:600;font-family:'Bebas Neue';letter-spacing:2px;">MBR-001</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-header"><div class="panel-title">Recent Orders</div></div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">Order #o1 — 2 items</div>
                  <div style="font-size:0.8rem;color:var(--muted);">2026-03-28</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-weight:700;">$84.98</div>
                  <span class="badge badge-green">COMPLETED</span>
                </div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">Order #o2 — 1 item</div>
                  <div style="font-size:0.8rem;color:var(--muted);">2026-04-01</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-weight:700;">$49.98</div>
                  <span class="badge badge-blue">SHIPPED</span>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Live Gym Presence</div>
                <span class="badge badge-green">Live</span>
              </div>
              <div class="panel-body">
                <div class="live-presence-val" id="live-members-count">0</div>
                <div class="live-presence-sub" id="live-members-sub">0 members currently checked in</div>
                <div class="live-presence-updated" id="live-members-updated">No active check-ins right now</div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Upcoming Classes</div>
                <button class="btn btn-sm btn-secondary" onclick="switchPage('member-workouts')">View All</button>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">HIIT Training</div>
                  <div style="font-size:0.8rem;color:var(--muted);">Coach Sarah Johnson</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">Apr 6</div>
                  <div style="font-size:0.78rem;color:var(--muted);">10:00 AM</div>
                </div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">Strength & Conditioning</div>
                  <div style="font-size:0.8rem;color:var(--muted);">Coach Sarah Johnson</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">Apr 8</div>
                  <div style="font-size:0.78rem;color:var(--muted);">2:00 PM</div>
                </div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">Yoga Flow</div>
                  <div style="font-size:0.8rem;color:var(--muted);">Coach Mike Davis</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">Apr 10</div>
                  <div style="font-size:0.78rem;color:var(--muted);">6:00 PM</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ── CART PANEL ── -->
<div class="cart-panel" id="cart-panel">
  <div class="cart-header">
    <div style="font-weight:700;font-size:1.05rem;"><i class="fas fa-shopping-bag" style="color:var(--accent);margin-right:8px;"></i> Cart</div>
    <button class="modal-close" onclick="toggleCart()"><i class="fas fa-times"></i></button>
  </div>
  <div class="cart-body" id="cart-body">
    <div class="empty-state"><i class="fas fa-shopping-bag"></i><p>Your cart is empty</p></div>
  </div>
  <div class="cart-footer" id="cart-footer" style="display:none;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
      <span style="font-weight:600;">Total</span>
      <span style="font-family:'Bebas Neue';font-size:1.5rem;color:var(--accent);" id="cart-total">$0.00</span>
    </div>
    <button class="btn btn-primary" style="width:100%;" onclick="checkout()"><i class="fas fa-credit-card"></i> Checkout</button>
  </div>
</div>
<!-- ── MODALS ── -->
<!-- Workout Detail Modal -->
<div class="modal-overlay" id="workout-modal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title" id="workout-modal-title">Workout</div>
      <button class="modal-close" onclick="closeModal('workout-modal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="workout-modal-body"></div>
  </div>
</div>

<!-- Exercise Detail Modal -->
<div class="modal-overlay" id="exercise-modal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title" id="exercise-modal-title">Exercise</div>
      <button class="modal-close" onclick="closeModal('exercise-modal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="exercise-modal-body"></div>
  </div>
</div>

<!-- Toast -->
<div id="toast" class="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg">Done!</span>
</div>
<script src="../assets/js/app.js"></script>
</body>
</html>
