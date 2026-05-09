<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Gym Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div id="login-page">
  <div class="login-left">
    <div class="login-grid"></div>
    <div class="login-brand">
      <div class="brand-logo">
        <div class="brand-icon"><i class="fas fa-dumbbell"></i></div>
        <div class="brand-name">IRONFORGE</div>
      </div>
      <div class="login-tagline">
        Train Harder.<br><span>Manage Smarter.</span>
      </div>
      <div class="login-sub">
        The complete gym management platform for members, coaches, and administrators.
      </div>
    </div>
    <div class="login-stats">
      <div class="stat-item">
        <div class="stat-num">1.2K</div>
        <div class="stat-label">Members</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">48</div>
        <div class="stat-label">Coaches</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">320</div>
        <div class="stat-label">Sessions/mo</div>
      </div>
    </div>
  </div>

  <div class="login-right">
    <div class="login-card">
      <div class="login-title">Welcome back</div>
      <div class="login-hint">Sign in to your portal</div>

      @if ($errors->any())
        <div class="alert" style="margin-bottom:14px;padding:10px 12px;border-radius:10px;background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.4);color:#fecaca;font-size:0.85rem;">
          {{ $errors->first() }}
        </div>
      @endif

      @if (session('status'))
        <div class="alert" style="margin-bottom:14px;padding:10px 12px;border-radius:10px;background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.4);color:#bbf7d0;font-size:0.85rem;">
          {{ session('status') }}
        </div>
      @endif

      <form id="login-form" method="POST" action="/login">
        @csrf

        <div class="role-tabs">
          <button type="button" class="role-tab active" onclick="selectRole('member',this)">
            <i class="fas fa-user"></i> Member
          </button>
          <button type="button" class="role-tab" onclick="selectRole('coach',this)">
            <i class="fas fa-user-tie"></i> Coach
          </button>
          <button type="button" class="role-tab" onclick="selectRole('admin',this)">
            <i class="fas fa-dumbbell"></i> Gym
          </button>
          <button type="button" class="role-tab" onclick="selectRole('super-admin',this)">
            <i class="fas fa-crown"></i> Super Admin
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="login-email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="••••••••" required>
          <div style="margin-top:8px;text-align:right;">
            <a href="/forgot-password.html" style="font-size:0.8rem;color:var(--accent);text-decoration:none;">Forgot your password?</a>
          </div>
        </div>
        <button type="button" class="btn-login" onclick="doLogin()">Sign In →</button>

        <a href="/auth/google" class="btn btn-secondary" style="width:100%;justify-content:center;margin-top:10px;text-decoration:none;">
          <i class="fab fa-google"></i> Continue with Google
        </a>
      </form>

      <div style="margin-top:12px;text-align:center;font-size:0.85rem;color:var(--muted);">
        New here?
        <a href="/signup.html" style="color:var(--accent);font-weight:600;text-decoration:none;">Create an account</a>
      </div>

      <div class="demo-creds">
        <div class="demo-creds-title">⚡ Demo Credentials</div>
        <div class="demo-cred-row"><span>Member</span><span>john@example.com / password</span></div>
        <div class="demo-cred-row"><span>Coach</span><span>sarah@example.com / password</span></div>
        <div class="demo-cred-row"><span>Nutrition Specialist</span><span>nutrition@example.com / password</span></div>
        <div class="demo-cred-row"><span>Gym</span><span>admin@example.com / password</span></div>
        <div class="demo-cred-row"><span>Super Admin</span><span>superadmin@example.com / password</span></div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>