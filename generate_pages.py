from pathlib import Path

root = Path('.')
text = (root / 'login.html').read_text()

login_start = text.index('<div id="login-page">')
login_end = text.index('<!-- ══════════════════════════════════════\n     APP SHELL', login_start)
login_markup = text[login_start:login_end].strip()

sidebar_start = text.index('<nav class="sidebar"', login_end)
sidebar_end = text.index('</nav>', sidebar_start) + len('</nav>')
sidebar_markup = text[sidebar_start:sidebar_end].strip()

cart_start = text.index('<!-- ── CART PANEL ── -->', sidebar_end)
cart_end = text.index('<!-- ── MODALS ── -->', cart_start)
cart_markup = text[cart_start:cart_end].strip()
modals_start = cart_end
modals_end = text.index('<script>', modals_start)
modals_markup = text[modals_start:modals_end].strip()

pages = {}
pos = 0
while True:
    start = text.find('<div class="page" id="page-', pos)
    if start == -1:
        break
    id_start = text.find('id="', start) + len('id="')
    id_end = text.find('"', id_start)
    page_id = text[id_start:id_end]
    depth = 0
    idx = start
    while idx < len(text):
        next_open = text.find('<div', idx)
        next_close = text.find('</div>', idx)
        if next_open == -1:
            next_open = len(text) + 1
        if next_close == -1:
            next_close = len(text) + 1
        if next_open < next_close:
            depth += 1
            idx = next_open + 4
        else:
            depth -= 1
            idx = next_close + len('</div>')
            if depth == 0:
                end = idx
                break
    pages[page_id] = text[start:end].strip()
    pos = end

if len(pages) < 10:
    raise SystemExit(f'Found only {len(pages)} pages')

base_head = '''<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IRONFORGE — Gym Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{css_path}">
</head>
<body>
'''

for page_id, page_html in pages.items():
    page_key = page_id[len('page-'):]
    role, name = page_key.split('-', 1)
    css_path = '../assets/css/styles.css'
    js_path = '../assets/js/app.js'
    title = 'Dashboard'
    (root / role).mkdir(parents=True, exist_ok=True)
    if name == 'workouts':
        title = 'Workouts'
    elif name == 'coaches' and role == 'member':
        title = 'Coaches'
    elif name == 'supplements':
        title = 'Shop'
    elif name == 'clients':
        title = 'Clients'
    elif name == 'coaches' and role == 'admin':
        title = 'Coaches'
    elif name == 'members':
        title = 'Members'
    elif name == 'inventory':
        title = 'Inventory'
    head = base_head.format(css_path=css_path)
    html_out = head + f'''<div id="app">
{sidebar_markup}
  <div class="main" id="main">
    <div class="topbar">
      <div class="topbar-title" id="topbar-title">{title}</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
        <button class="btn btn-secondary btn-sm" id="cart-btn" onclick="toggleCart()" style="display:none;">
          <i class="fas fa-shopping-bag"></i> Cart <span id="cart-count" style="background:var(--accent);color:#000;border-radius:20px;padding:1px 7px;font-size:0.75rem;margin-left:2px;"></span>
        </button>
      </div>
    </div>
    <div class="page-content">
{page_html}
    </div>
  </div>
</div>
{cart_markup}
{modals_markup}
<script src="{js_path}"></script>
</body>
</html>'''
    out_path = root / role / f'{name}.html'
    out_path.write_text(html_out)

root.joinpath('login.html').write_text(base_head.format(css_path='assets/css/styles.css') + login_markup + '\n<script src="assets/js/app.js"></script>\n</body>\n</html>')
print('created', len(pages), 'page files')
