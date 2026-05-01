<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — New Password</title>
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
        <div class="brand-icon"><i class="fas fa-lock"></i></div>
        <div class="brand-name">IRONFORGE</div>
      </div>
      <div class="login-tagline">Create New Password<br><span>Secure Your Account.</span></div>
      <div class="login-sub">Choose a strong password with at least 8 characters.</div>
    </div>
  </div>

  <div class="login-right">
    <div class="login-card">
      <div class="login-title">Set new password</div>
      <div class="login-hint">Step 3 of 3: update your password</div>

      @if ($errors->any())
        <div class="alert" style="margin-bottom:14px;padding:10px 12px;border-radius:10px;background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.4);color:#fecaca;font-size:0.85rem;">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="/reset-password">
        @csrf

        <div class="form-group">
          <label class="form-label">New Password</label>
          <input type="password" class="form-control" name="password" placeholder="At least 8 characters" required>
        </div>

        <div class="form-group">
          <label class="form-label">Confirm New Password</label>
          <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat password" required>
        </div>

        <button type="submit" class="btn-login">Update Password →</button>
      </form>

      <div style="margin-top:12px;text-align:center;font-size:0.85rem;color:var(--muted);">
        Back to
        <a href="/login.html" style="color:var(--accent);font-weight:600;text-decoration:none;">Sign in</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
