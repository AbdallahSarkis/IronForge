<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE — Create Account</title>
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
        Join the Forge.<br><span>Start Strong Today.</span>
      </div>
      <div class="login-sub">
        Create your member account in seconds and access your workouts, schedule, and check-ins.
      </div>
    </div>
  </div>

  <div class="login-right">
    <div class="login-card">
      <div class="login-title">Create account</div>
      <div class="login-hint">Sign up as a user and start exploring nearby gyms and coaches</div>

      @if ($errors->any())
        <div class="alert" style="margin-bottom:14px;padding:10px 12px;border-radius:10px;background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.4);color:#fecaca;font-size:0.85rem;">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="/signup">
        @csrf

        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="At least 8 characters" required>
        </div>

        <div class="form-group">
          <label class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat password" required>
        </div>

        <div class="form-group">
          <label class="form-label">Gender</label>
          <select class="form-control" name="gender" required>
            <option value="">Select gender</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Date of Birth</label>
          <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
        </div>

        <button type="submit" class="btn-login">Create Account →</button>

        <a href="/auth/google" class="btn btn-secondary" style="width:100%;justify-content:center;margin-top:10px;text-decoration:none;">
          <i class="fab fa-google"></i> Sign up with Google
        </a>
      </form>

      <div style="margin-top:12px;text-align:center;font-size:0.85rem;color:var(--muted);">
        Already have an account?
        <a href="/login.html" style="color:var(--accent);font-weight:600;text-decoration:none;">Sign in</a>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>
