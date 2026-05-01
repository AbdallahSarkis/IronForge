<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Forgot Password</title>
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
      <div class="login-tagline">Forgot Password?<br><span>Reset It Securely.</span></div>
      <div class="login-sub">Enter your account email and we will send you a 6-digit verification code.</div>
    </div>
  </div>

  <div class="login-right">
    <div class="login-card">
      <div class="login-title">Reset password</div>
      <div class="login-hint">Step 1 of 3: request verification code</div>

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

      <form method="POST" action="/forgot-password">
        @csrf
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="btn-login">Send Verification Code →</button>
      </form>

      <div style="margin-top:12px;text-align:center;font-size:0.85rem;color:var(--muted);">
        Remembered your password?
        <a href="/login.html" style="color:var(--accent);font-weight:600;text-decoration:none;">Back to sign in</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
