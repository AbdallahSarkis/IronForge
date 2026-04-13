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
        <div class="user-role role-member" id="user-role-badge">Member</div>
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
      <div class="topbar-title" id="topbar-title">Check-In</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
        <button class="btn btn-secondary btn-sm" id="cart-btn" onclick="toggleCart()" style="display:none;">
          <i class="fas fa-shopping-bag"></i> Cart <span id="cart-count" style="background:var(--accent);color:#000;border-radius:20px;padding:1px 7px;font-size:0.75rem;margin-left:2px;"></span>
        </button>
      </div>
    </div>
    <div class="page-content">
      <div class="page" id="page-member-checkin">
        <div class="section-header">
          <div class="section-title">Gym Access</div>
          <div class="section-sub">Scan your QR code for quick check-in and check-out</div>
        </div>

        <div class="checkin-mode-toggle" role="tablist" aria-label="Access mode">
          <button class="checkin-mode-btn active" id="checkin-mode-in-btn" type="button"><i class="fas fa-door-open"></i> Check-In</button>
          <button class="checkin-mode-btn" id="checkin-mode-out-btn" type="button"><i class="fas fa-door-closed"></i> Check-Out</button>
        </div>

        <div class="checkin-grid" id="member-checkin-page">
          <div class="panel checkin-panel">
            <div class="panel-header">
              <div class="panel-title"><i class="fas fa-qrcode" style="margin-right:8px;color:var(--accent);"></i><span id="checkin-current-mode">Check-In</span> QR Scanner</div>
            </div>
            <div class="panel-body">
              <div id="checkin-reader" class="checkin-reader"></div>
              <div id="checkin-status" class="checkin-status info">Tap "Open Camera" to start scanning your check-in QR code.</div>
              <div class="checkin-actions">
                <button class="btn btn-primary" id="checkin-start-btn"><i class="fas fa-camera"></i> Open Camera (Check-In)</button>
                <button class="btn btn-secondary" id="checkin-stop-btn" disabled><i class="fas fa-stop"></i> Stop</button>
              </div>
            </div>
          </div>

          <div class="panel checkin-panel">
            <div class="panel-header">
              <div class="panel-title"><i class="fas fa-clipboard-check" style="margin-right:8px;color:var(--accent);"></i>Scan Result</div>
            </div>
            <div class="panel-body">
              <div id="checkin-result" class="checkin-result">No QR scanned yet</div>
              <div class="checkin-tips">
                <div class="checkin-tip"><i class="fas fa-lightbulb"></i> Keep the QR code centered in the frame.</div>
                <div class="checkin-tip"><i class="fas fa-lightbulb"></i> Improve lighting if scanning is slow.</div>
                <div class="checkin-tip"><i class="fas fa-lightbulb"></i> Use rear camera for better focus.</div>
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
<div class="modal-overlay" id="workout-modal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title" id="workout-modal-title">Workout</div>
      <button class="modal-close" onclick="closeModal('workout-modal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="workout-modal-body"></div>
  </div>
</div>

<div class="modal-overlay" id="exercise-modal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title" id="exercise-modal-title">Exercise</div>
      <button class="modal-close" onclick="closeModal('exercise-modal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="exercise-modal-body"></div>
  </div>
</div>

<div class="modal-overlay" id="client-modal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title" id="client-modal-title">Client</div>
      <button class="modal-close" onclick="closeModal('client-modal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body" id="client-modal-body"></div>
  </div>
</div>

<div id="toast" class="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg">Done!</span>
</div>

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script src="../assets/js/app.js"></script>
</body>
</html>
