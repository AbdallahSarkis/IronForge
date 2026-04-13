<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IRONFORGE — Gym Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
:root {
      --bg: #0a0a0b;
      --surface: #111114;
      --surface2: #18181d;
      --border: #222228;
      --border2: #2e2e38;
      --text: #f0f0f4;
      --muted: #6b6b7e;
      --accent: #e8ff47;
      --accent-dim: rgba(232,255,71,0.12);
      --accent-glow: rgba(232,255,71,0.25);
      --red: #ff4757;
      --blue: #4facfe;
      --purple: #a855f7;
      --green: #22c55e;
      --orange: #f97316;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ── SCROLLBAR ── */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }

    /* ════════════════════════════════
       LOGIN PAGE
    ════════════════════════════════ */
    #login-page {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .login-left {
      position: relative;
      background: linear-gradient(135deg, #0f0f12 0%, #1a1a24 100%);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 3rem;
      overflow: hidden;
    }

    .login-left::before {
      content: '';
      position: absolute;
      top: -120px; left: -120px;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(232,255,71,0.15) 0%, transparent 70%);
      pointer-events: none;
    }

    .login-left::after {
      content: '';
      position: absolute;
      bottom: -80px; right: -80px;
      width: 300px; height: 300px;
      background: radial-gradient(circle, rgba(168,85,247,0.1) 0%, transparent 70%);
      pointer-events: none;
    }

    .login-brand {
      position: relative;
      z-index: 1;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 1.5rem;
    }

    .brand-icon {
      width: 44px; height: 44px;
      background: var(--accent);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-size: 20px;
    }

    .brand-name {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2rem;
      letter-spacing: 3px;
      color: var(--text);
    }

    .login-tagline {
      font-size: 2.8rem;
      font-weight: 300;
      line-height: 1.2;
      color: var(--text);
      margin-bottom: 1rem;
    }

    .login-tagline span {
      color: var(--accent);
      font-weight: 600;
    }

    .login-sub {
      color: var(--muted);
      font-size: 1rem;
      line-height: 1.6;
      max-width: 380px;
    }

    .login-stats {
      position: relative;
      z-index: 1;
      display: flex;
      gap: 2.5rem;
    }

    .stat-item {}
    .stat-num {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2.2rem;
      color: var(--accent);
      letter-spacing: 2px;
      line-height: 1;
    }
    .stat-label {
      font-size: 0.75rem;
      color: var(--muted);
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-top: 2px;
    }

    /* Grid background */
    .login-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
      background-size: 60px 60px;
      pointer-events: none;
    }

    .login-right {
      background: var(--surface);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
    }

    .login-title {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
    }

    .login-hint {
      color: var(--muted);
      font-size: 0.9rem;
      margin-bottom: 2rem;
    }

    .role-tabs {
      display: flex;
      gap: 8px;
      margin-bottom: 2rem;
      background: var(--surface2);
      border-radius: 12px;
      padding: 6px;
      border: 1px solid var(--border);
    }

    .role-tab {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: transparent;
      color: var(--muted);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.85rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .role-tab.active {
      background: var(--accent);
      color: #000;
      font-weight: 600;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .form-label {
      display: block;
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 7px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .form-control {
      width: 100%;
      background: var(--surface2);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      padding: 12px 16px;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-dim);
    }

    .btn-login {
      width: 100%;
      padding: 14px;
      background: var(--accent);
      color: #000;
      border: none;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: transform 0.15s, box-shadow 0.15s;
      margin-top: 0.5rem;
      letter-spacing: 0.5px;
    }

    .btn-login:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 24px var(--accent-glow);
    }

    .demo-creds {
      margin-top: 1.5rem;
      padding: 14px 16px;
      background: var(--accent-dim);
      border: 1px solid rgba(232,255,71,0.2);
      border-radius: 10px;
    }

    .demo-creds-title {
      font-size: 0.75rem;
      color: var(--accent);
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .demo-cred-row {
      display: flex;
      justify-content: space-between;
      font-size: 0.82rem;
      color: var(--muted);
      margin-bottom: 3px;
    }

    /* ════════════════════════════════
       APP SHELL
    ════════════════════════════════ */
    #app { display: none; }
    #app.active { display: flex; min-height: 100vh; }

    /* SIDEBAR */
    .sidebar {
      width: 240px;
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      z-index: 100;
      transition: width 0.3s ease, transform 0.3s ease;
      overflow: hidden;
    }

    .sidebar.collapsed { width: 70px; }

    .sidebar-header {
      padding: 1.2rem 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--border);
      min-height: 65px;
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      overflow: hidden;
      white-space: nowrap;
    }

    .sidebar-logo .icon {
      width: 34px; height: 34px;
      background: var(--accent);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-size: 16px;
      flex-shrink: 0;
    }

    .sidebar-logo .name {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.3rem;
      letter-spacing: 2px;
      color: var(--text);
      transition: opacity 0.2s;
    }

    .sidebar.collapsed .sidebar-logo .name { opacity: 0; width: 0; }

    .collapse-btn {
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
      padding: 6px;
      border-radius: 6px;
      transition: color 0.2s, background 0.2s;
      flex-shrink: 0;
    }

    .collapse-btn:hover { color: var(--text); background: var(--surface2); }

    .sidebar-user {
      padding: 1rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 10px;
      overflow: hidden;
      white-space: nowrap;
    }

    .user-avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--purple), var(--blue));
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.85rem;
      flex-shrink: 0;
    }

    .user-info { overflow: hidden; }
    .user-name { font-weight: 600; font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .user-role {
      font-size: 0.72rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      font-weight: 600;
      padding: 2px 8px;
      border-radius: 20px;
      display: inline-block;
      margin-top: 2px;
    }
    .role-member { background: rgba(34,197,94,0.15); color: var(--green); }
    .role-coach { background: rgba(79,172,254,0.15); color: var(--blue); }
    .role-admin { background: rgba(249,115,22,0.15); color: var(--orange); }

    .sidebar.collapsed .user-info { display: none; }

    .sidebar-nav {
      flex: 1;
      padding: 0.8rem 0.7rem;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .nav-section-label {
      font-size: 0.65rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--muted);
      padding: 8px 10px 4px;
      white-space: nowrap;
      transition: opacity 0.2s;
    }

    .sidebar.collapsed .nav-section-label { opacity: 0; }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 10px;
      border-radius: 10px;
      color: var(--muted);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.15s;
      white-space: nowrap;
      margin-bottom: 2px;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
    }

    .nav-item i { width: 20px; text-align: center; flex-shrink: 0; font-size: 1rem; }
    .nav-item span { transition: opacity 0.2s; }
    .sidebar.collapsed .nav-item span { opacity: 0; width: 0; overflow: hidden; }

    .nav-item:hover { background: var(--surface2); color: var(--text); }
    .nav-item.active { background: var(--accent-dim); color: var(--accent); border: 1px solid rgba(232,255,71,0.15); }
    .nav-item.active i { color: var(--accent); }

    .sidebar-footer {
      padding: 0.8rem 0.7rem;
      border-top: 1px solid var(--border);
    }

    .logout-btn {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px;
      border-radius: 10px;
      color: var(--muted);
      cursor: pointer;
      font-size: 0.9rem;
      transition: all 0.15s;
      border: none;
      background: none;
      width: 100%;
    }

    .logout-btn:hover { background: rgba(255,71,87,0.1); color: var(--red); }
    .logout-btn i { width: 20px; text-align: center; flex-shrink: 0; }
    .sidebar.collapsed .logout-btn span { opacity: 0; width: 0; }

    /* MAIN CONTENT */
    .main {
      margin-left: 240px;
      flex: 1;
      transition: margin-left 0.3s;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .main.collapsed { margin-left: 70px; }

    /* TOPBAR */
    .topbar {
      height: 65px;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.5rem;
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .topbar-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.5rem;
      letter-spacing: 2px;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .topbar-badge {
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    /* PAGE CONTENT */
    .page-content {
      padding: 2rem;
      flex: 1;
    }

    .page { display: none; }
    .page.active { display: block; }

    /* ── SECTION HEADER ── */
    .section-header {
      margin-bottom: 2rem;
    }
    .section-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2rem;
      letter-spacing: 2px;
      line-height: 1;
      margin-bottom: 4px;
    }
    .section-sub { color: var(--muted); font-size: 0.9rem; }

    /* ── STAT CARDS ── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.2rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 1.4rem;
      transition: border-color 0.2s, transform 0.2s;
      position: relative;
      overflow: hidden;
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      right: 0; height: 2px;
    }

    .stat-card.accent::before { background: var(--accent); }
    .stat-card.blue::before { background: var(--blue); }
    .stat-card.purple::before { background: var(--purple); }
    .stat-card.red::before { background: var(--red); }
    .stat-card.green::before { background: var(--green); }
    .stat-card.orange::before { background: var(--orange); }

    .stat-card:hover { border-color: var(--border2); transform: translateY(-2px); }

    .stat-card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    .stat-card-icon {
      width: 40px; height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
    }

    .stat-card.accent .stat-card-icon { background: var(--accent-dim); color: var(--accent); }
    .stat-card.blue .stat-card-icon { background: rgba(79,172,254,0.12); color: var(--blue); }
    .stat-card.purple .stat-card-icon { background: rgba(168,85,247,0.12); color: var(--purple); }
    .stat-card.red .stat-card-icon { background: rgba(255,71,87,0.12); color: var(--red); }
    .stat-card.green .stat-card-icon { background: rgba(34,197,94,0.12); color: var(--green); }
    .stat-card.orange .stat-card-icon { background: rgba(249,115,22,0.12); color: var(--orange); }

    .stat-card-val {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2.2rem;
      letter-spacing: 1px;
      line-height: 1;
    }

    .stat-card-label {
      font-size: 0.8rem;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* ── CARDS / PANELS ── */
    .panel {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 1.5rem;
    }

    .panel-header {
      padding: 1.2rem 1.5rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .panel-title {
      font-weight: 600;
      font-size: 1rem;
    }

    .panel-body { padding: 1.5rem; }

    /* ── GRID LAYOUTS ── */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .grid-auto { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }

    /* ── LIST ITEMS ── */
    .list-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--border);
      transition: background 0.15s;
    }

    .list-item:last-child { border-bottom: none; }
    .list-item:hover { background: var(--surface2); }

    /* ── BADGES ── */
    .badge {
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .badge-accent { background: var(--accent-dim); color: var(--accent); }
    .badge-green { background: rgba(34,197,94,0.15); color: var(--green); }
    .badge-blue { background: rgba(79,172,254,0.15); color: var(--blue); }
    .badge-purple { background: rgba(168,85,247,0.15); color: var(--purple); }
    .badge-red { background: rgba(255,71,87,0.15); color: var(--red); }
    .badge-orange { background: rgba(249,115,22,0.15); color: var(--orange); }
    .badge-muted { background: var(--surface2); color: var(--muted); border: 1px solid var(--border); }

    /* ── BUTTONS ── */
    .btn {
      padding: 9px 18px;
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: all 0.15s;
      display: inline-flex;
      align-items: center;
      gap: 7px;
    }

    .btn-primary { background: var(--accent); color: #000; }
    .btn-primary:hover { box-shadow: 0 4px 16px var(--accent-glow); transform: translateY(-1px); }
    .btn-secondary { background: var(--surface2); color: var(--text); border: 1px solid var(--border2); }
    .btn-secondary:hover { border-color: var(--accent); color: var(--accent); }
    .btn-danger { background: rgba(255,71,87,0.1); color: var(--red); border: 1px solid rgba(255,71,87,0.2); }
    .btn-danger:hover { background: rgba(255,71,87,0.2); }
    .btn-sm { padding: 6px 12px; font-size: 0.8rem; }

    /* ── INPUTS ── */
    .input, .textarea, .select {
      width: 100%;
      background: var(--surface2);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      padding: 10px 14px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .input:focus, .textarea:focus, .select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-dim);
    }

    .textarea { resize: vertical; min-height: 100px; }

    .field { margin-bottom: 1.2rem; }
    .field-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 6px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    /* ── TABLE ── */
    .table { width: 100%; border-collapse: collapse; }
    .table th {
      padding: 12px 16px;
      text-align: left;
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--muted);
      letter-spacing: 1px;
      text-transform: uppercase;
      border-bottom: 1px solid var(--border);
    }
    .table td {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border);
      font-size: 0.9rem;
      vertical-align: middle;
    }
    .table tr:last-child td { border-bottom: none; }
    .table tr:hover td { background: var(--surface2); }

    /* ── PRODUCT CARD ── */
    .product-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      transition: border-color 0.2s, transform 0.2s;
    }

    .product-card:hover { border-color: var(--accent); transform: translateY(-3px); }

    .product-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .product-body { padding: 1rem; }
    .product-name { font-weight: 600; font-size: 0.95rem; margin-bottom: 4px; }
    .product-desc { font-size: 0.82rem; color: var(--muted); margin-bottom: 12px; line-height: 1.4; }
    .product-price { font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: var(--accent); letter-spacing: 1px; }
    .product-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 10px;
    }

    /* ── WORKOUT CARD ── */
    .workout-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 1.4rem;
      cursor: pointer;
      transition: border-color 0.2s, transform 0.2s;
      margin-bottom: 1rem;
    }

    .workout-card:hover { border-color: var(--accent); transform: translateY(-2px); }

    .workout-card-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 0.8rem;
    }

    .workout-name { font-weight: 700; font-size: 1.05rem; margin-bottom: 3px; }
    .workout-meta { font-size: 0.82rem; color: var(--muted); }

    .exercise-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      background: var(--surface2);
      border: 1px solid var(--border);
      border-radius: 20px;
      font-size: 0.78rem;
      color: var(--muted);
      margin: 3px 3px 3px 0;
    }

    /* ── COACH CARD ── */
    .coach-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 1.5rem;
      text-align: center;
      transition: border-color 0.2s, transform 0.2s;
    }

    .coach-card:hover { border-color: var(--blue); transform: translateY(-3px); }

    .coach-avatar {
      width: 72px; height: 72px;
      border-radius: 50%;
      margin: 0 auto 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.8rem;
      color: #000;
    }

    .coach-name { font-weight: 700; font-size: 1.05rem; margin-bottom: 4px; }
    .coach-specialty { font-size: 0.82rem; color: var(--muted); margin-bottom: 1rem; }

    /* ── MODAL ── */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      backdrop-filter: blur(4px);
      z-index: 999;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .modal-overlay.open { display: flex; }

    .modal-box {
      background: var(--surface);
      border: 1px solid var(--border2);
      border-radius: 20px;
      width: 100%;
      max-width: 600px;
      max-height: 85vh;
      overflow-y: auto;
      animation: modalIn 0.25s ease;
    }

    @keyframes modalIn {
      from { opacity: 0; transform: scale(0.95) translateY(20px); }
      to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .modal-header {
      padding: 1.5rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .modal-title { font-weight: 700; font-size: 1.1rem; }

    .modal-close {
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
      font-size: 1.2rem;
      padding: 4px 8px;
      border-radius: 6px;
      transition: color 0.15s, background 0.15s;
    }

    .modal-close:hover { color: var(--text); background: var(--surface2); }

    .modal-body { padding: 1.5rem; }

    /* ── PROGRESS BAR ── */
    .progress-bar {
      background: var(--surface2);
      border-radius: 20px;
      height: 8px;
      overflow: hidden;
      margin: 6px 0;
    }

    .progress-fill {
      height: 100%;
      border-radius: 20px;
      transition: width 0.5s ease;
    }

    /* ── MEMBERSHIP CARD ── */
    .membership-card {
      background: linear-gradient(135deg, #1a1a24, #0f0f14);
      border: 1px solid var(--accent);
      border-radius: 20px;
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    .membership-card::before {
      content: '';
      position: absolute;
      top: -60px; right: -60px;
      width: 200px; height: 200px;
      background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    }

    .membership-tier {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2.5rem;
      color: var(--accent);
      letter-spacing: 3px;
      line-height: 1;
    }

    .membership-plan { color: var(--muted); font-size: 0.85rem; letter-spacing: 1px; margin-bottom: 1.5rem; }

    /* ── CART ── */
    .cart-panel {
      position: fixed;
      top: 0; right: 0;
      height: 100vh;
      width: 380px;
      background: var(--surface);
      border-left: 1px solid var(--border2);
      z-index: 200;
      transform: translateX(100%);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
    }

    .cart-panel.open { transform: translateX(0); }

    .cart-header {
      padding: 1.5rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cart-body {
      flex: 1;
      overflow-y: auto;
      padding: 1rem;
    }

    .cart-footer { padding: 1.5rem; border-top: 1px solid var(--border); }

    .cart-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px;
      background: var(--surface2);
      border-radius: 12px;
      margin-bottom: 10px;
    }

    .cart-item-img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; }
    .cart-item-info { flex: 1; }
    .cart-item-name { font-weight: 600; font-size: 0.88rem; margin-bottom: 2px; }
    .cart-item-price { color: var(--accent); font-size: 0.85rem; font-weight: 600; }

    .cart-qty {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .qty-btn {
      width: 26px; height: 26px;
      background: var(--surface);
      border: 1px solid var(--border2);
      border-radius: 6px;
      color: var(--text);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      transition: all 0.15s;
    }

    .qty-btn:hover { border-color: var(--accent); color: var(--accent); }

    .qty-num { font-weight: 600; font-size: 0.9rem; min-width: 20px; text-align: center; }

    /* ── TOAST ── */
    .toast {
      position: fixed;
      bottom: 2rem; right: 2rem;
      background: var(--surface);
      border: 1px solid var(--border2);
      border-radius: 12px;
      padding: 14px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 0.9rem;
      font-weight: 500;
      z-index: 500;
      animation: toastIn 0.3s ease;
      box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    }

    @keyframes toastIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .toast i { color: var(--accent); }

    /* ── EMPTY STATE ── */
    .empty-state {
      text-align: center;
      padding: 3rem;
      color: var(--muted);
    }

    .empty-state i { font-size: 3rem; margin-bottom: 1rem; opacity: 0.3; }
    .empty-state p { font-size: 0.9rem; }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
      #login-page { grid-template-columns: 1fr; }
      .login-left { display: none; }
      .grid-2, .grid-3 { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.mobile-open { transform: translateX(0); width: 240px !important; }
      .main { margin-left: 0 !important; }
      .page-content { padding: 1rem; }
    }

    /* fade in animation */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .page.active { animation: fadeUp 0.3s ease; }

    /* separator */
    .sep { height: 1px; background: var(--border); margin: 1.5rem 0; }
  </style>
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

      <div class="role-tabs">
        <button class="role-tab active" onclick="selectRole('member',this)">
          <i class="fas fa-user"></i> Member
        </button>
        <button class="role-tab" onclick="selectRole('coach',this)">
          <i class="fas fa-user-tie"></i> Coach
        </button>
        <button class="role-tab" onclick="selectRole('admin',this)">
          <i class="fas fa-shield-alt"></i> Admin
        </button>
      </div>

      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="login-email" placeholder="you@example.com">
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="••••••••">
      </div>
      <button class="btn-login" onclick="doLogin()">Sign In →</button>

      <div class="demo-creds">
        <div class="demo-creds-title">⚡ Demo Credentials</div>
        <div class="demo-cred-row"><span>Member</span><span>john@example.com / any pass</span></div>
        <div class="demo-cred-row"><span>Coach</span><span>sarah@example.com / any pass</span></div>
        <div class="demo-cred-row"><span>Admin</span><span>admin@example.com / any pass</span></div>
      </div>
    </div>
  </div>
</div>
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
      <div class="topbar-title" id="topbar-title">Dashboard</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
        <button class="btn btn-secondary btn-sm" id="cart-btn" onclick="toggleCart()" style="display:none;">
          <i class="fas fa-shopping-bag"></i> Cart <span id="cart-count" style="background:var(--accent);color:#000;border-radius:20px;padding:1px 7px;font-size:0.75rem;margin-left:2px;"></span>
        </button>
      </div>
    </div>
    <div class="page-content">
<div class="page" id="page-member-dashboard">
        <div class="section-header">
          <div class="section-title">Dashboard</div>
          <div class="section-sub">Welcome back, John. Here's your overview.</div>
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
<div class="page" id="page-member-workouts">
        <div class="section-header">
          <div class="section-title">My Workouts</div>
          <div class="section-sub">Your assigned workout plans</div>
        </div>
        <div id="member-workouts-list"></div>
      </div>
<div class="page" id="page-member-coaches">
        <div class="section-header">
          <div class="section-title">Coaches</div>
          <div class="section-sub">Meet our expert trainers</div>
        </div>
        <div class="grid-auto" id="coaches-grid"></div>
      </div>
<div class="page" id="page-member-supplements">
        <div class="section-header">
          <div class="section-title">Shop</div>
          <div class="section-sub">Premium supplements and equipment</div>
        </div>
        <div class="grid-auto" id="supplements-grid"></div>
      </div>
<div class="page" id="page-coach-dashboard">
        <div class="section-header">
          <div class="section-title">Dashboard</div>
          <div class="section-sub">Welcome back, Sarah. Here's your overview.</div>
        </div>
        <div class="stats-grid">
          <div class="stat-card blue">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-card-val">2</div>
            <div class="stat-card-label">Active Clients</div>
          </div>
          <div class="stat-card purple">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-dumbbell"></i></div>
            </div>
            <div class="stat-card-val">8</div>
            <div class="stat-card-label">Workouts This Month</div>
          </div>
          <div class="stat-card green">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-star"></i></div>
            </div>
            <div class="stat-card-val">4.9</div>
            <div class="stat-card-label">Average Rating</div>
          </div>
          <div class="stat-card accent">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-calendar-alt"></i></div>
            </div>
            <div class="stat-card-val">48</div>
            <div class="stat-card-label">Sessions Completed</div>
          </div>
        </div>

        <div class="grid-2">
          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Quick Actions</div>
              </div>
              <div class="panel-body">
                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                  <button class="btn btn-primary" onclick="switchPage('coach-clients')">
                    <i class="fas fa-users"></i> View Clients
                  </button>
                  <button class="btn btn-secondary" onclick="switchPage('coach-workouts')">
                    <i class="fas fa-dumbbell"></i> Manage Workouts
                  </button>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Recent Sessions</div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">HIIT Training</div>
                  <div style="font-size:0.8rem;color:var(--muted);">John Doe</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">Apr 6</div>
                  <div style="font-size:0.78rem;color:var(--muted);">Completed</div>
                </div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">Strength & Conditioning</div>
                  <div style="font-size:0.8rem;color:var(--muted);">John Doe</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">Apr 8</div>
                  <div style="font-size:0.78rem;color:var(--muted);">Scheduled</div>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Client Progress</div>
              </div>
              <div class="panel-body">
                <div style="margin-bottom:1.5rem;">
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="font-weight:600;font-size:0.9rem;">John Doe</span>
                    <span style="font-size:0.78rem;color:var(--muted);">75% complete</span>
                  </div>
                  <div class="progress-bar">
                    <div class="progress-fill" style="width:75%;background:var(--accent);"></div>
                  </div>
                </div>
                <div>
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="font-weight:600;font-size:0.9rem;">Emma Wilson</span>
                    <span style="font-size:0.78rem;color:var(--muted);">60% complete</span>
                  </div>
                  <div class="progress-bar">
                    <div class="progress-fill" style="width:60%;background:var(--blue);"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="page" id="page-coach-clients">
        <div class="section-header">
          <div class="section-title">My Clients</div>
          <div class="section-sub">Manage your client relationships</div>
        </div>
        <div id="coach-clients-list"></div>
      </div>
<div class="page" id="page-coach-workouts">
        <div class="section-header">
          <div class="section-title">Workout Management</div>
          <div class="section-sub">Create and assign workout plans</div>
        </div>
        <div class="grid-2">
          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Create New Workout</div>
              </div>
              <div class="panel-body">
                <div class="field">
                  <label class="field-label">Workout Name</label>
                  <input type="text" class="input" id="new-workout-name" placeholder="e.g., Upper Body Blast">
                </div>
                <div class="field">
                  <label class="field-label">Assign to Client</label>
                  <select class="select" id="new-workout-client">
                    <option value="">Select client...</option>
                    <option value="1">John Doe</option>
                    <option value="4">Emma Wilson</option>
                  </select>
                </div>
                <div class="field">
                  <label class="field-label">Exercises</label>
                  <textarea class="textarea" id="new-workout-exercises" placeholder="List exercises, sets, reps..."></textarea>
                </div>
                <button class="btn btn-primary" onclick="createWorkout()">Create Workout</button>
              </div>
            </div>
          </div>
          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Assigned Workouts</div>
              </div>
              <div class="panel-body" id="coach-assigned-workouts"></div>
            </div>
          </div>
        </div>
      </div>
<div class="page" id="page-admin-dashboard">
        <div class="section-header">
          <div class="section-title">Dashboard</div>
          <div class="section-sub">Welcome back, Admin. System overview.</div>
        </div>
        <div class="stats-grid">
          <div class="stat-card green">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-card-val">1.2K</div>
            <div class="stat-card-label">Total Members</div>
          </div>
          <div class="stat-card blue">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-user-tie"></i></div>
            </div>
            <div class="stat-card-val">48</div>
            <div class="stat-card-label">Active Coaches</div>
          </div>
          <div class="stat-card purple">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-calendar-alt"></i></div>
            </div>
            <div class="stat-card-val">320</div>
            <div class="stat-card-label">Sessions This Month</div>
          </div>
          <div class="stat-card accent">
            <div class="stat-card-top">
              <div class="stat-card-icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
            <div class="stat-card-val">$24K</div>
            <div class="stat-card-label">Monthly Revenue</div>
          </div>
        </div>

        <div class="grid-2">
          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Quick Actions</div>
              </div>
              <div class="panel-body">
                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                  <button class="btn btn-primary" onclick="switchPage('admin-members')">
                    <i class="fas fa-users"></i> Manage Members
                  </button>
                  <button class="btn btn-secondary" onclick="switchPage('admin-coaches')">
                    <i class="fas fa-user-tie"></i> Manage Coaches
                  </button>
                  <button class="btn btn-secondary" onclick="switchPage('admin-inventory')">
                    <i class="fas fa-boxes"></i> Inventory
                  </button>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">Recent Activity</div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">New Member Registration</div>
                  <div style="font-size:0.8rem;color:var(--muted);">Jane Smith joined</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">2 hours ago</div>
                </div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">Workout Completed</div>
                  <div style="font-size:0.8rem;color:var(--muted);">John Doe - HIIT Training</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">4 hours ago</div>
                </div>
              </div>
              <div class="list-item">
                <div>
                  <div style="font-weight:600;font-size:0.9rem;">New Order</div>
                  <div style="font-size:0.8rem;color:var(--muted);">Order #o3 - $39.99</div>
                </div>
                <div style="text-align:right;">
                  <div style="color:var(--accent);font-size:0.85rem;font-weight:600;">6 hours ago</div>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="panel">
              <div class="panel-header">
                <div class="panel-title">System Health</div>
              </div>
              <div class="panel-body">
                <div style="margin-bottom:1.5rem;">
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="font-weight:600;font-size:0.9rem;">Server Uptime</span>
                    <span style="font-size:0.78rem;color:var(--muted);">99.9%</span>
                  </div>
                  <div class="progress-bar">
                    <div class="progress-fill" style="width:99.9%;background:var(--green);"></div>
                  </div>
                </div>
                <div style="margin-bottom:1.5rem;">
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="font-weight:600;font-size:0.9rem;">Database Performance</span>
                    <span style="font-size:0.78rem;color:var(--muted);">95%</span>
                  </div>
                  <div class="progress-bar">
                    <div class="progress-fill" style="width:95%;background:var(--accent);"></div>
                  </div>
                </div>
                <div>
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="font-weight:600;font-size:0.9rem;">API Response Time</span>
                    <span style="font-size:0.78rem;color:var(--muted);">120ms</span>
                  </div>
                  <div class="progress-bar">
                    <div class="progress-fill" style="width:85%;background:var(--blue);"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="page" id="page-admin-coaches">
        <div class="section-header">
          <div class="section-title">Coach Management</div>
          <div class="section-sub">Oversee all gym coaches</div>
        </div>
        <div class="grid-auto" id="coaches-grid"></div>
      </div>
<div class="page" id="page-admin-members">
        <div class="section-header">
          <div class="section-title">Member Management</div>
          <div class="section-sub">Manage gym memberships</div>
        </div>
        <div class="panel">
          <div class="panel-header">
            <div class="panel-title">All Members</div>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Membership</th>
                  <th>Join Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div style="display:flex;align-items:center;gap:12px;">
                      <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#22c55e,#16a34a);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;">JD</div>
                      <div>
                        <div style="font-weight:600;">John Doe</div>
                      </div>
                    </div>
                  </td>
                  <td>john@example.com</td>
                  <td><span class="badge badge-accent">Premium</span></td>
                  <td>2026-01-15</td>
                  <td><span class="badge badge-green">Active</span></td>
                </tr>
                <tr>
                  <td>
                    <div style="display:flex;align-items:center;gap:12px;">
                      <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#f97316);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;">EW</div>
                      <div>
                        <div style="font-weight:600;">Emma Wilson</div>
                      </div>
                    </div>
                  </td>
                  <td>emma@example.com</td>
                  <td><span class="badge badge-blue">Basic</span></td>
                  <td>2026-02-20</td>
                  <td><span class="badge badge-green">Active</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
<div class="page" id="page-admin-inventory">
        <div class="section-header">
          <div class="section-title">Inventory Management</div>
          <div class="section-sub">Track and manage gym products</div>
        </div>
        <div class="panel">
          <div class="panel-header">
            <div class="panel-title">Product Inventory</div>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="admin-inventory-body"></tbody>
            </table>
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
<div class="toast" id="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg"></span>
</div>
<script>
/* ═══════════════════════════════════════════════════════
   DATA
═══════════════════════════════════════════════════════ */
const USERS = {
  'john@example.com':  { name:'John Doe',   role:'member', initials:'JD', gradient:'135deg,#22c55e,#16a34a' },
  'sarah@example.com': { name:'Sarah Johnson', role:'coach', initials:'SJ', gradient:'135deg,#4facfe,#a855f7' },
  'admin@example.com': { name:'Admin User', role:'admin', initials:'AU', gradient:'135deg,#f97316,#ef4444' },
};

const PRODUCTS = [
  { id:'p1', name:'Whey Protein 5lb', category:'supplement', price:49.99, stock:50, image:'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=400', description:'Premium whey protein isolate for muscle recovery' },
  { id:'p2', name:'Pre-Workout Boost', category:'supplement', price:34.99, stock:30, image:'https://images.unsplash.com/photo-1579722821273-0f6c7d44362f?w=400', description:'Energy and focus enhancement formula' },
  { id:'p3', name:'Resistance Bands Set', category:'equipment', price:24.99, stock:75, image:'https://images.unsplash.com/photo-1598289431512-b97b0917affc?w=400', description:'Professional grade resistance bands - 5 levels' },
  { id:'p4', name:'Yoga Mat Premium', category:'equipment', price:39.99, stock:40, image:'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=400', description:'Non-slip eco-friendly yoga mat' },
  { id:'p5', name:'BCAA Recovery', category:'supplement', price:29.99, stock:60, image:'https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?w=400', description:'Branch chain amino acids for faster recovery' },
  { id:'p6', name:'Kettlebell 20kg', category:'equipment', price:79.99, stock:15, image:'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400', description:'Cast iron kettlebell with comfort grip' },
];

const COACHES = [
  { id:'c1', name:'Sarah Johnson', specialty:'HIIT & Strength', clients:2, gradient:'135deg,#4facfe,#a855f7', initials:'SJ', sessions:48, rating:4.9 },
  { id:'c2', name:'Mike Davis', specialty:'Yoga & Flexibility', clients:5, gradient:'135deg,#22c55e,#16a34a', initials:'MD', sessions:62, rating:4.8 },
  { id:'c3', name:'Alex Rivera', specialty:'Bodybuilding', clients:3, gradient:'135deg,#f97316,#ef4444', initials:'AR', sessions:35, rating:4.7 },
];

const WORKOUTS = [
  { id:1, name:'HIIT Training', coach:'Sarah Johnson', date:'2026-04-06', time:'10:00 AM', status:'Scheduled', exercises:[
    { name:'Burpees', sets:3, reps:10, intensity:'High', muscles:'Full body', description:'A powerful full-body plyometric movement.' },
    { name:'Mountain Climbers', sets:3, reps:20, intensity:'High', muscles:'Core, shoulders', description:'Explosive core and cardio exercise in plank.' },
    { name:'Jump Squats', sets:3, reps:15, intensity:'High', muscles:'Quads, glutes', description:'Dynamic lower-body move for power.' },
  ]},
  { id:2, name:'Strength & Conditioning', coach:'Sarah Johnson', date:'2026-04-08', time:'2:00 PM', status:'Scheduled', exercises:[
    { name:'Deadlifts', sets:4, reps:8, intensity:'High', muscles:'Hamstrings, glutes', description:'Major posterior-chain lift.' },
    { name:'Bench Press', sets:4, reps:10, intensity:'Medium', muscles:'Chest, triceps', description:'Classic upper-body press.' },
    { name:'Pull-ups', sets:3, reps:8, intensity:'High', muscles:'Lats, biceps', description:'Bodyweight pulling exercise.' },
  ]},
  { id:3, name:'Yoga Flow', coach:'Mike Davis', date:'2026-04-10', time:'6:00 PM', status:'Scheduled', exercises:[
    { name:'Sun Salutation', sets:5, reps:1, intensity:'Low', muscles:'Full body', description:'Flowing warm-up sequence.' },
    { name:'Warrior Pose', sets:3, reps:30, intensity:'Low', muscles:'Legs, core', description:'Grounding standing pose.' },
    { name:"Child's Pose", sets:3, reps:60, intensity:'Low', muscles:'Back, hips', description:'Restorative hip stretch.' },
  ]},
];

const CLIENTS = [
  { id:'1', name:'John Doe', email:'john@example.com', goal:'Build muscle mass and increase strength', initials:'JD', gradient:'135deg,#6366f1,#8b5cf6', workouts:[WORKOUTS[0], WORKOUTS[1]] },
  { id:'4', name:'Emma Wilson', email:'emma@example.com', goal:'Weight loss and cardio endurance', initials:'EW', gradient:'135deg,#ec4899,#f97316', workouts:[WORKOUTS[2]] },
];

/* ═══════════════════════════════════════════════════════
   STATE
═══════════════════════════════════════════════════════ */
let currentUser = null;
let currentRole = 'member';
let sidebarCollapsed = false;
let cart = [];

/* ═══════════════════════════════════════════════════════
   LOGIN
═══════════════════════════════════════════════════════ */
function selectRole(role, btn) {
  currentRole = role;
  document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  const presets = { member:'john@example.com', coach:'sarah@example.com', admin:'admin@example.com' };
  document.getElementById('login-email').value = presets[role];
}

function doLogin() {
  const email = document.getElementById('login-email').value.trim().toLowerCase();
  const user = USERS[email];
  if (!user) { showToast('Invalid credentials. Try demo emails.'); return; }
  currentUser = { ...user, email };
  initApp();
}

function doLogout() {
  currentUser = null;
  cart = [];
  document.getElementById('app').classList.remove('active');
  document.getElementById('login-page').style.display = 'grid';
}

/* ═══════════════════════════════════════════════════════
   APP INIT
═══════════════════════════════════════════════════════ */
function initApp() {
  document.getElementById('login-page').style.display = 'none';
  document.getElementById('app').classList.add('active');

  // User meta
  document.getElementById('user-name-label').textContent = currentUser.name;
  document.getElementById('user-avatar').textContent = currentUser.initials;
  document.getElementById('user-avatar').style.background = `linear-gradient(${currentUser.gradient})`;

  const roleEl = document.getElementById('user-role-badge');
  roleEl.textContent = currentUser.role.charAt(0).toUpperCase() + currentUser.role.slice(1);
  roleEl.className = `user-role role-${currentUser.role}`;

  const topBadge = document.getElementById('topbar-role-badge');
  const badgeCls = { member:'badge-green', coach:'badge-blue', admin:'badge-orange' };
  topBadge.textContent = currentUser.role.toUpperCase();
  topBadge.className = `badge topbar-badge ${badgeCls[currentUser.role]}`;

  // Cart button only for members
  document.getElementById('cart-btn').style.display = currentUser.role === 'member' ? 'flex' : 'none';

  buildNav();
  renderAllContent();
  switchPage(defaultPage());
}

function defaultPage() {
  return { member:'member-dashboard', coach:'coach-dashboard', admin:'admin-dashboard' }[currentUser.role];
}

const NAV_CONFIG = {
  member: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'member-dashboard' },
    { icon:'fas fa-dumbbell', label:'Workouts', page:'member-workouts' },
    { icon:'fas fa-user-tie', label:'Coaches', page:'member-coaches' },
    { icon:'fas fa-pills', label:'Shop', page:'member-supplements' },
  ],
  coach: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'coach-dashboard' },
    { icon:'fas fa-users', label:'Clients', page:'coach-clients' },
    { icon:'fas fa-dumbbell', label:'Workouts', page:'coach-workouts' },
  ],
  admin: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'admin-dashboard' },
    { icon:'fas fa-user-tie', label:'Coaches', page:'admin-coaches' },
    { icon:'fas fa-users', label:'Members', page:'admin-members' },
    { icon:'fas fa-boxes', label:'Inventory', page:'admin-inventory' },
  ],
};

function buildNav() {
  const nav = document.getElementById('sidebar-nav');
  nav.innerHTML = `<div class="nav-section-label">Navigation</div>`;
  NAV_CONFIG[currentUser.role].forEach(item => {
    const btn = document.createElement('button');
    btn.className = 'nav-item';
    btn.id = `nav-${item.page}`;
    btn.innerHTML = `<i class="${item.icon}"></i><span>${item.label}</span>`;
    btn.onclick = () => switchPage(item.page);
    nav.appendChild(btn);
  });
}

function switchPage(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const page = document.getElementById(`page-${pageId}`);
  if (page) page.classList.add('active');
  const navItem = document.getElementById(`nav-${pageId}`);
  if (navItem) navItem.classList.add('active');

  const titles = {
    'member-dashboard':'Dashboard','member-workouts':'Workouts','member-coaches':'Coaches','member-supplements':'Shop',
    'coach-dashboard':'Dashboard','coach-clients':'Clients','coach-workouts':'Workouts',
    'admin-dashboard':'Dashboard','admin-coaches':'Coaches','admin-members':'Members','admin-inventory':'Inventory',
  };
  document.getElementById('topbar-title').textContent = titles[pageId] || 'Page';
}

/* ═══════════════════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════════════════ */
function toggleSidebar() {
  sidebarCollapsed = !sidebarCollapsed;
  document.getElementById('sidebar').classList.toggle('collapsed', sidebarCollapsed);
  document.getElementById('main').classList.toggle('collapsed', sidebarCollapsed);
  document.getElementById('collapse-icon').className = sidebarCollapsed ? 'fas fa-chevron-right' : 'fas fa-chevron-left';
}

/* ═══════════════════════════════════════════════════════
   RENDER CONTENT
═══════════════════════════════════════════════════════ */
function renderAllContent() {
  renderMemberWorkouts();
  renderCoachesGrid();
  renderSupplements();
  renderCoachClients();
  renderCoachWorkouts();
  renderAdminInventory();
}

function renderMemberWorkouts() {
  const el = document.getElementById('member-workouts-list');
  el.innerHTML = WORKOUTS.map(w => `
    <div class="workout-card" onclick="openWorkoutModal(${w.id})">
      <div class="workout-card-top">
        <div>
          <div class="workout-name">${w.name}</div>
          <div class="workout-meta"><i class="fas fa-user-tie" style="color:var(--accent);margin-right:5px;"></i>${w.coach}</div>
        </div>
        <div style="text-align:right;">
          <div style="color:var(--accent);font-weight:700;font-size:0.9rem;">${w.date}</div>
          <div style="color:var(--muted);font-size:0.8rem;">${w.time}</div>
        </div>
      </div>
      <div style="margin-top:10px;">
        ${w.exercises.map(e => `<span class="exercise-pill"><i class="fas fa-circle" style="font-size:5px;color:var(--accent);"></i>${e.name}</span>`).join('')}
      </div>
      <div style="margin-top:12px;display:flex;align-items:center;justify-content:space-between;">
        <span class="badge badge-green">${w.status}</span>
        <span style="font-size:0.8rem;color:var(--muted);">${w.exercises.length} exercises <i class="fas fa-chevron-right" style="font-size:0.7rem;margin-left:4px;"></i></span>
      </div>
    </div>
  `).join('');
}

function renderCoachesGrid() {
  const el = document.getElementById('coaches-grid');
  const colors = ['#4facfe','#22c55e','#f97316','#a855f7','#e8ff47'];
  el.innerHTML = COACHES.map((c,i) => `
    <div class="coach-card">
      <div class="coach-avatar" style="background:linear-gradient(${c.gradient});">${c.initials}</div>
      <div class="coach-name">${c.name}</div>
      <div class="coach-specialty">${c.specialty}</div>
      <div style="display:flex;justify-content:center;gap:1.5rem;margin-bottom:1rem;">
        <div style="text-align:center;">
          <div style="font-family:'Bebas Neue';font-size:1.4rem;color:var(--accent);">${c.sessions}</div>
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;">Sessions</div>
        </div>
        <div style="text-align:center;">
          <div style="font-family:'Bebas Neue';font-size:1.4rem;color:var(--accent);">${c.rating}</div>
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;">Rating</div>
        </div>
        <div style="text-align:center;">
          <div style="font-family:'Bebas Neue';font-size:1.4rem;color:var(--accent);">${c.clients}</div>
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;">Clients</div>
        </div>
      </div>
      <button class="btn btn-secondary" style="width:100%;justify-content:center;"><i class="fas fa-envelope"></i> Message</button>
    </div>
  `).join('');
}

function renderSupplements() {
  const el = document.getElementById('supplements-grid');
  el.innerHTML = PRODUCTS.map(p => `
    <div class="product-card">
      <img class="product-img" src="${p.image}" alt="${p.name}" onerror="this.style.display='none'">
      <div class="product-body">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px;">
          <div class="product-name">${p.name}</div>
          <span class="badge ${p.category === 'supplement' ? 'badge-green' : 'badge-blue'}">${p.category}</span>
        </div>
        <div class="product-desc">${p.description}</div>
        <div class="product-footer">
          <div>
            <div class="product-price">$${p.price}</div>
            <div style="font-size:0.75rem;color:var(--muted);">Stock: ${p.stock}</div>
          </div>
          <button class="btn btn-primary btn-sm" onclick="addToCart('${p.id}')"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>
    </div>
  `).join('');
}

function renderCoachClients() {
  const el = document.getElementById('coach-clients-list');
  el.innerHTML = CLIENTS.map(c => `
    <div class="panel" style="cursor:pointer;" onclick="openClientModal('${c.id}')">
      <div class="panel-body">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:1rem;">
          <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(${c.gradient});display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;flex-shrink:0;">${c.initials}</div>
          <div>
            <div style="font-weight:700;font-size:1.05rem;">${c.name}</div>
            <div style="font-size:0.82rem;color:var(--muted);">${c.email}</div>
          </div>
        </div>
        <div style="background:var(--surface2);border-radius:10px;padding:12px;margin-bottom:12px;">
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;">Goal</div>
          <div style="font-size:0.88rem;">${c.goal}</div>
        </div>
        <div style="font-size:0.82rem;color:var(--muted);">${c.workouts.length} workout${c.workouts.length > 1 ? 's' : ''} assigned</div>
      </div>
    </div>
  `).join('');
}

function renderCoachWorkouts() {
  const el = document.getElementById('coach-assigned-workouts');
  el.innerHTML = CLIENTS.flatMap(c => c.workouts.map(w => `
    <div style="background:var(--surface2);border:1px solid var(--border);border-radius:12px;padding:1rem;margin-bottom:10px;">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
        <div style="font-weight:600;">${w.name}</div>
        <span style="font-size:0.78rem;color:var(--muted);">${c.name}</span>
      </div>
      <div style="display:flex;gap:6px;flex-wrap:wrap;">
        ${w.exercises.map(e => `<span class="exercise-pill">${e.name}</span>`).join('')}
      </div>
    </div>
  `)).join('');
}

function renderAdminInventory() {
  const tbody = document.getElementById('admin-inventory-body');
  tbody.innerHTML = PRODUCTS.map(p => `
    <tr>
      <td>
        <div style="display:flex;align-items:center;gap:12px;">
          <img src="${p.image}" style="width:40px;height:40px;border-radius:8px;object-fit:cover;" onerror="this.style.display='none'">
          <div>
            <div style="font-weight:600;">${p.name}</div>
            <div style="font-size:0.78rem;color:var(--muted);">${p.description.substring(0,40)}...</div>
          </div>
        </div>
      </td>
      <td><span class="badge ${p.category === 'supplement' ? 'badge-green' : 'badge-blue'}">${p.category}</span></td>
      <td style="color:var(--accent);font-weight:700;font-family:'Bebas Neue';font-size:1.1rem;">$${p.price}</td>
      <td>
        <input type="number" value="${p.stock}" onchange="updateStock('${p.id}',this.value)"
          style="width:70px;background:var(--surface2);border:1px solid var(--border2);border-radius:8px;color:var(--text);padding:6px 8px;font-size:0.85rem;outline:none;">
      </td>
      <td><button class="btn btn-danger btn-sm" onclick="confirmDelete('${p.id}')"><i class="fas fa-trash"></i></button></td>
    </tr>
  `).join('');
}

/* ═══════════════════════════════════════════════════════
   MODALS
═══════════════════════════════════════════════════════ */
function openWorkoutModal(id) {
  const w = WORKOUTS.find(x => x.id === id);
  if (!w) return;
  document.getElementById('workout-modal-title').textContent = w.name;
  document.getElementById('workout-modal-body').innerHTML = `
    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;flex-wrap:wrap;">
      <div style="flex:1;min-width:120px;background:var(--surface2);border-radius:10px;padding:12px;">
        <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:3px;">Coach</div>
        <div style="font-weight:600;">${w.coach}</div>
      </div>
      <div style="flex:1;min-width:120px;background:var(--surface2);border-radius:10px;padding:12px;">
        <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:3px;">Date</div>
        <div style="font-weight:600;">${w.date} · ${w.time}</div>
      </div>
      <div style="flex:1;min-width:120px;background:var(--surface2);border-radius:10px;padding:12px;">
        <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:3px;">Status</div>
        <span class="badge badge-green">${w.status}</span>
      </div>
    </div>
    <div style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Exercises</div>
    ${w.exercises.map(e => `
      <div style="background:var(--surface2);border:1px solid var(--border);border-radius:12px;padding:1rem;margin-bottom:10px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
          <div style="font-weight:700;">${e.name}</div>
          <div style="display:flex;gap:8px;align-items:center;">
            <span style="font-size:0.82rem;color:var(--muted);">${e.sets}×${e.reps}</span>
            <span class="badge badge-muted">${e.intensity}</span>
          </div>
        </div>
        <div style="font-size:0.83rem;color:var(--muted);margin-bottom:4px;">${e.description}</div>
        <div style="font-size:0.78rem;color:var(--accent);"><i class="fas fa-bullseye" style="margin-right:4px;"></i>${e.muscles}</div>
      </div>
    `).join('')}
  `;
  openModal('workout-modal');
}

function openClientModal(id) {
  const c = CLIENTS.find(x => x.id === id);
  if (!c) return;
  document.getElementById('client-modal-title').textContent = c.name;
  document.getElementById('client-modal-body').innerHTML = `
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:1.5rem;">
      <div style="width:56px;height:56px;border-radius:50%;background:linear-gradient(${c.gradient});display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.1rem;">${c.initials}</div>
      <div>
        <div style="font-weight:700;font-size:1.1rem;">${c.name}</div>
        <div style="color:var(--muted);font-size:0.85rem;">${c.email}</div>
      </div>
    </div>
    <div style="background:var(--accent-dim);border:1px solid rgba(232,255,71,0.2);border-radius:10px;padding:12px;margin-bottom:1.5rem;">
      <div style="font-size:0.72rem;color:var(--accent);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;">Fitness Goal</div>
      <div style="font-size:0.9rem;">${c.goal}</div>
    </div>
    <div style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Assigned Workouts</div>
    ${c.workouts.map(w => `
      <div style="background:var(--surface2);border:1px solid var(--border);border-radius:12px;padding:1rem;margin-bottom:10px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
          <div style="font-weight:600;">${w.name}</div>
          <span style="font-size:0.78rem;color:var(--muted);">${w.date}</span>
        </div>
        <div style="display:flex;gap:5px;flex-wrap:wrap;">
          ${w.exercises.map(e => `<span class="exercise-pill">${e.name} ${e.sets}×${e.reps}</span>`).join('')}
        </div>
      </div>
    `).join('')}
  `;
  openModal('client-modal');
}

function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(m => {
  m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
});

/* ═══════════════════════════════════════════════════════
   CART
═══════════════════════════════════════════════════════ */
function toggleCart() {
  document.getElementById('cart-panel').classList.toggle('open');
}

function addToCart(productId) {
  const product = PRODUCTS.find(p => p.id === productId);
  if (!product) return;
  const existing = cart.find(i => i.id === productId);
  if (existing) { existing.qty++; }
  else { cart.push({ ...product, qty: 1 }); }
  updateCartUI();
  showToast(`${product.name} added to cart`);
}

function removeFromCart(productId) {
  cart = cart.filter(i => i.id !== productId);
  updateCartUI();
}

function changeQty(productId, delta) {
  const item = cart.find(i => i.id === productId);
  if (!item) return;
  item.qty += delta;
  if (item.qty <= 0) removeFromCart(productId);
  else updateCartUI();
}

function updateCartUI() {
  const totalItems = cart.reduce((s, i) => s + i.qty, 0);
  const totalPrice = cart.reduce((s, i) => s + i.price * i.qty, 0);
  document.getElementById('cart-count').textContent = totalItems > 0 ? totalItems : '';
  document.getElementById('cart-total').textContent = `$${totalPrice.toFixed(2)}`;

  const cartBody = document.getElementById('cart-body');
  const cartFooter = document.getElementById('cart-footer');

  if (cart.length === 0) {
    cartBody.innerHTML = '<div class="empty-state"><i class="fas fa-shopping-bag"></i><p>Your cart is empty</p></div>';
    cartFooter.style.display = 'none';
  } else {
    cartFooter.style.display = 'block';
    cartBody.innerHTML = cart.map(item => `
      <div class="cart-item">
        <img class="cart-item-img" src="${item.image}" alt="${item.name}" onerror="this.style.display='none'">
        <div class="cart-item-info">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-price">$${(item.price * item.qty).toFixed(2)}</div>
        </div>
        <div class="cart-qty">
          <button class="qty-btn" onclick="changeQty('${item.id}',-1)">−</button>
          <span class="qty-num">${item.qty}</span>
          <button class="qty-btn" onclick="changeQty('${item.id}',1)">+</button>
        </div>
      </div>
    `).join('');
  }
}

function checkout() {
  cart = [];
  updateCartUI();
  toggleCart();
  showToast('Order placed successfully!');
}

/* ═══════════════════════════════════════════════════════
   ADMIN ACTIONS
═══════════════════════════════════════════════════════ */
function updateStock(id, val) {
  showToast(`Stock updated to ${val}`);
}

function confirmDelete(id) {
  if (confirm('Delete this product?')) showToast('Product removed (demo)');
}

/* ═══════════════════════════════════════════════════════
   COACH ACTIONS
═══════════════════════════════════════════════════════ */
function createWorkout() {
  const name = document.getElementById('new-workout-name').value.trim();
  const clientId = document.getElementById('new-workout-client').value;
  const exercises = document.getElementById('new-workout-exercises').value.trim();
  if (!name || !clientId || !exercises) { showToast('Please fill all fields'); return; }
  document.getElementById('new-workout-name').value = '';
  document.getElementById('new-workout-exercises').value = '';
  document.getElementById('new-workout-client').value = '';
  showToast(`Workout "${name}" assigned!`);
}

/* ═══════════════════════════════════════════════════════
   TOAST
═══════════════════════════════════════════════════════ */
let toastTimer;
function showToast(msg) {
  const t = document.getElementById('toast');
  document.getElementById('toast-msg').textContent = msg;
  t.style.display = 'flex';
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.style.display = 'none', 3000);
}
</script>
</body>
</html>