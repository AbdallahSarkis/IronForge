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
<div class="page" id="page-user-dashboard" style="display:none;">
        <div class="section-header">
          <div class="section-title">Explore Fitness Around You</div>
          <div class="section-sub">Find nearby gyms and coaches before choosing a membership plan.</div>
        </div>
  <div class="page" id="page-user-dashboard">
          <div class="section-header">
            <div class="section-title">Welcome</div>
            <div class="section-sub">Your fitness journey starts here. Explore nearby gyms and coaches.</div>
          </div>

          <div class="stats-grid">
            <div class="stat-card accent">
              <div class="stat-card-top">
                <div class="stat-card-icon"><i class="fas fa-map-marker-alt"></i></div>
              </div>
              <div class="stat-card-val">3</div>
              <div class="stat-card-label">Nearby Gyms</div>
            </div>
            <div class="stat-card blue">
              <div class="stat-card-top">
                <div class="stat-card-icon"><i class="fas fa-user-tie"></i></div>
              </div>
              <div class="stat-card-val">5</div>
              <div class="stat-card-label">Available Coaches</div>
            </div>
            <div class="stat-card purple">
              <div class="stat-card-top">
                <div class="stat-card-icon"><i class="fas fa-star"></i></div>
              </div>
              <div class="stat-card-val">4.8</div>
              <div class="stat-card-label">Avg Rating</div>
            </div>
            <div class="stat-card green">
              <div class="stat-card-top">
                <div class="stat-card-icon"><i class="fas fa-users"></i></div>
              </div>
              <div class="stat-card-val">1.2K</div>
              <div class="stat-card-label">Active Members</div>
            </div>
          </div>

          <div class="grid-2">
            <div>
              <div class="panel">
                <div class="panel-header">
                  <div class="panel-title">Getting Started</div>
                </div>
                <div class="panel-body">
                  <p style="margin-bottom:12px;color:var(--muted);">Complete these steps to get the most out of IRONFORGE:</p>
                  <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                    <div style="width:6px;height:6px;background:var(--accent);border-radius:50%;"></div>
                    <span>Complete your profile</span>
                  </div>
                  <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                    <div style="width:6px;height:6px;background:var(--accent);border-radius:50%;"></div>
                    <span>Explore nearby gyms</span>
                  </div>
                  <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:6px;height:6px;background:var(--accent);border-radius:50%;"></div>
                    <span>Connect with a coach</span>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div class="panel">
                <div class="panel-header">
                  <div class="panel-title">Quick Links</div>
                </div>
                <div style="padding:16px;display:flex;flex-direction:column;gap:10px;">
                  <button class="btn btn-secondary" onclick="switchPage('user-profile')" style="justify-content:flex-start;">
                    <i class="fas fa-user" style="margin-right:8px;"></i> View Profile
                  </button>
                  <button class="btn btn-secondary" onclick="switchPage('user-near-gyms')" style="justify-content:flex-start;">
                    <i class="fas fa-map-marker-alt" style="margin-right:8px;"></i> Find Gyms
                  </button>
                  <button class="btn btn-secondary" onclick="switchPage('user-near-coaches')" style="justify-content:flex-start;">
                    <i class="fas fa-user-tie" style="margin-right:8px;"></i> Find Coaches
                  </button>
                </div>
              </div>
            </div>
          </div>
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
<!-- Client Detail Modal -->
<div class="modal-overlay" id="client-modal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title" id="client-modal-title">Client</div>
      <button class="modal-close" onclick="closeModal('client-modal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="client-modal-body"></div>
  </div>
</div>

<!-- Toast -->
<div id="toast" class="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg">Done!</span>
</div>

<!-- Profile Edit Modal -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
        <div style="display:flex;gap:10px;margin-top:20px;">
          <button type="submit" class="btn btn-primary" style="flex:1;">
            <i class="fas fa-save"></i> Save Changes
          </button>
          <button type="button" class="btn btn-secondary" onclick="closeProfileModal()" style="flex:1;">
            <i class="fas fa-times"></i> Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="../assets/js/app.js"></script>
</body>
</html>
</html>