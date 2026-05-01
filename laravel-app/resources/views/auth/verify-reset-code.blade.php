<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Verify Code</title>
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
        <div class="brand-icon"><i class="fas fa-shield-check"></i></div>
        <div class="brand-name">IRONFORGE</div>
      </div>
      <div class="login-tagline">Check Your Email<br><span>Enter Verification Code.</span></div>
      <div class="login-sub">We sent a 6-digit code to your email. It will expire in 10 minutes.</div>
    </div>
  </div>

  <div class="login-right">
    <div class="login-card">
      <div class="login-title">Verify code</div>
      <div class="login-hint">Step 2 of 3: confirm your code</div>

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

      <form method="POST" action="/verify-reset-code">
        @csrf
        <div class="form-group">
          <label class="form-label">Verification Code</label>
          <input type="text" class="form-control" name="code" inputmode="numeric" maxlength="6" placeholder="123456" required>
        </div>

        <button type="submit" class="btn-login">Verify Code →</button>
      </form>

      <div style="margin-top:12px;text-align:center;font-size:0.85rem;color:var(--muted);">
        Need another code?
        <a href="/forgot-password.html" style="color:var(--accent);font-weight:600;text-decoration:none;">Request again</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
