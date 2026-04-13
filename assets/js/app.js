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

const EXERCISE_IMAGES = {
  deadlifts: 'Gemini_Generated_Image_xserv1xserv1xser-removebg-preview.png',
};

/* ═══════════════════════════════════════════════════════
   STATE
═══════════════════════════════════════════════════════ */
let currentUser = null;
let currentRole = 'member';
let sidebarCollapsed = false;
let cart = [];
let checkInScanner = null;
let checkInActive = false;
let checkInMode = 'checkin';

const LIVE_PRESENCE_STORAGE_KEY = 'gymapp_live_presence';

function getLivePresenceMap() {
  try {
    return JSON.parse(localStorage.getItem(LIVE_PRESENCE_STORAGE_KEY) || '{}');
  } catch (error) {
    return {};
  }
}

function saveLivePresenceMap(presenceMap) {
  localStorage.setItem(LIVE_PRESENCE_STORAGE_KEY, JSON.stringify(presenceMap));
}

function updateMemberPresence(mode, qrPayload) {
  if (!currentUser || !currentUser.email) return;

  const presenceMap = getLivePresenceMap();
  const memberKey = currentUser.email;

  if (mode === 'checkout') {
    delete presenceMap[memberKey];
  } else {
    presenceMap[memberKey] = {
      name: currentUser.name,
      email: currentUser.email,
      checkedInAt: new Date().toISOString(),
      qrPayload,
    };
  }

  saveLivePresenceMap(presenceMap);
  renderMemberLivePresence();
}

function renderMemberLivePresence() {
  const countEl = document.getElementById('live-members-count');
  const subEl = document.getElementById('live-members-sub');
  const updatedEl = document.getElementById('live-members-updated');
  if (!countEl || !subEl || !updatedEl) return;

  const activeMembers = Object.values(getLivePresenceMap());
  const count = activeMembers.length;
  countEl.textContent = String(count);
  subEl.textContent = `${count} member${count === 1 ? '' : 's'} currently checked in`;

  if (!count) {
    updatedEl.textContent = 'No active check-ins right now';
    return;
  }

  const lastCheckIn = activeMembers
    .map(member => member.checkedInAt)
    .filter(Boolean)
    .sort()
    .pop();

  const lastTime = lastCheckIn ? new Date(lastCheckIn).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' }) : 'just now';
  updatedEl.textContent = `Last check-in at ${lastTime}`;
}

const PAGE_URLS = {
  'member-dashboard':'dashboard.html',
  'member-schedule':'schedule.html',
  'member-checkin':'checkin.html',
  'member-workouts':'workouts.html',
  'member-coaches':'coaches.html',
  'member-supplements':'supplements.html',
  'coach-dashboard':'dashboard.html',
  'coach-clients':'clients.html',
  'coach-workouts':'workouts.html',
  'admin-dashboard':'dashboard.html',
  'admin-coaches':'coaches.html',
  'admin-members':'members.html',
  'admin-inventory':'inventory.html',
};

function getCurrentFolderPath() {
  return location.pathname.substring(0, location.pathname.lastIndexOf('/') + 1);
}

function getAssetRootPath() {
  return location.pathname.includes('/member/') || location.pathname.includes('/coach/') || location.pathname.includes('/admin/') ? '../' : '';
}

function getCurrentPageId() {
  const fileName = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);
  const pageName = fileName.replace('.html', '');
  return `${currentUser.role}-${pageName}`;
}

function getStoredUser() {
  try { return JSON.parse(localStorage.getItem('gymapp_user') || 'null'); } catch (e) { return null; }
}

function setStoredUser(user) {
  if (user) localStorage.setItem('gymapp_user', JSON.stringify(user));
  else localStorage.removeItem('gymapp_user');
}

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
  setStoredUser(currentUser);
  window.location.href = `${currentUser.role}/dashboard.html`;
}

function doLogout() {
  currentUser = null;
  cart = [];
  setStoredUser(null);
  const loginPath = location.pathname.includes('/member/') || location.pathname.includes('/coach/') || location.pathname.includes('/admin/') ? '../login.html' : 'login.html';
  window.location.href = loginPath;
}

/* ═══════════════════════════════════════════════════════
   APP INIT
═══════════════════════════════════════════════════════ */
function initApp() {
  const appEl = document.getElementById('app');
  if (!appEl) return; // not on an app page
  currentUser = getStoredUser();
  if (!currentUser) {
    const loginPath = location.pathname.includes('/member/') || location.pathname.includes('/coach/') || location.pathname.includes('/admin/') ? '../login.html' : 'login.html';
    window.location.href = loginPath;
    return;
  }

  appEl.classList.add('active');

  // User meta
  document.getElementById('user-name-label').textContent = currentUser.name;
  document.getElementById('user-avatar').textContent = currentUser.initials;
  document.getElementById('user-avatar').style.background = `linear-gradient(${currentUser.gradient})`;

  const roleEl = document.getElementById('user-role-badge');
  if (roleEl) {
    roleEl.textContent = currentUser.role.charAt(0).toUpperCase() + currentUser.role.slice(1);
    roleEl.className = `user-role role-${currentUser.role}`;
  }

  const topBadge = document.getElementById('topbar-role-badge');
  if (topBadge) {
    const badgeCls = { member:'badge-green', coach:'badge-blue', admin:'badge-orange' };
    topBadge.textContent = currentUser.role.toUpperCase();
    topBadge.className = `badge topbar-badge ${badgeCls[currentUser.role]}`;
  }

  // Cart button only for members
  const cartBtn = document.getElementById('cart-btn');
  if (cartBtn) cartBtn.style.display = currentUser.role === 'member' ? 'flex' : 'none';

  buildNav();
  setupResponsiveNavigation();
  const currentPageId = getCurrentPageId();
  if (document.getElementById(`page-${currentPageId}`) || PAGE_URLS[currentPageId]) {
    switchPage(currentPageId);
  } else {
    switchPage(defaultPage());
  }
  renderAllContent();
}

function defaultPage() {
  return { member:'member-dashboard', coach:'coach-dashboard', admin:'admin-dashboard' }[currentUser.role];
}

const NAV_CONFIG = {
  member: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'member-dashboard' },
    { icon:'fas fa-calendar-week', label:'Schedule', page:'member-schedule' },
    { icon:'fas fa-qrcode', label:'Check-In', page:'member-checkin' },
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
  if (pageId !== 'member-checkin') stopCheckInScanner();
  closeMobileSidebar();
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const navItem = document.getElementById(`nav-${pageId}`);
  if (navItem) navItem.classList.add('active');
  const page = document.getElementById(`page-${pageId}`);
  if (page) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    page.classList.add('active');
  } else {
    const url = PAGE_URLS[pageId];
    if (url) window.location.href = `${getCurrentFolderPath()}${url}`;
  }
  const titles = {
    'member-dashboard':'Dashboard','member-schedule':'Schedule','member-checkin':'Check-In','member-workouts':'Workouts','member-coaches':'Coaches','member-supplements':'Shop',
    'coach-dashboard':'Dashboard','coach-clients':'Clients','coach-workouts':'Workouts',
    'admin-dashboard':'Dashboard','admin-coaches':'Coaches','admin-members':'Members','admin-inventory':'Inventory',
  };
  const titleEl = document.getElementById('topbar-title');
  if (titleEl) titleEl.textContent = titles[pageId] || 'Page';
}

/* ═══════════════════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════════════════ */
function toggleSidebar() {
  if (window.matchMedia('(max-width: 600px)').matches) {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    if (!sidebar) return;

    const isOpen = sidebar.classList.toggle('mobile-open');
    if (overlay) overlay.classList.toggle('open', isOpen);
    document.body.classList.toggle('sidebar-open', isOpen);
    return;
  }

  sidebarCollapsed = !sidebarCollapsed;
  document.getElementById('sidebar').classList.toggle('collapsed', sidebarCollapsed);
  document.getElementById('main').classList.toggle('collapsed', sidebarCollapsed);
  document.getElementById('collapse-icon').className = sidebarCollapsed ? 'fas fa-chevron-right' : 'fas fa-chevron-left';
}

function closeMobileSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  if (!sidebar) return;

  sidebar.classList.remove('mobile-open');
  if (overlay) overlay.classList.remove('open');
  document.body.classList.remove('sidebar-open');
}

function setupResponsiveNavigation() {
  const topbar = document.querySelector('.topbar');
  const titleEl = document.getElementById('topbar-title');
  if (!topbar || !titleEl) return;

  let topbarLeft = topbar.querySelector('.topbar-left');
  if (!topbarLeft) {
    topbarLeft = document.createElement('div');
    topbarLeft.className = 'topbar-left';
    topbar.insertBefore(topbarLeft, topbar.firstChild);
  }

  let menuBtn = document.getElementById('topbar-menu-btn');
  if (!menuBtn) {
    menuBtn = document.createElement('button');
    menuBtn.id = 'topbar-menu-btn';
    menuBtn.className = 'topbar-menu-btn';
    menuBtn.type = 'button';
    menuBtn.setAttribute('aria-label', 'Open navigation menu');
    menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
    menuBtn.onclick = toggleSidebar;
    topbarLeft.appendChild(menuBtn);
  }

  if (titleEl.parentElement !== topbarLeft) topbarLeft.appendChild(titleEl);

  let overlay = document.getElementById('sidebar-overlay');
  if (!overlay) {
    overlay = document.createElement('button');
    overlay.id = 'sidebar-overlay';
    overlay.className = 'sidebar-overlay';
    overlay.type = 'button';
    overlay.setAttribute('aria-label', 'Close navigation menu');
    overlay.onclick = closeMobileSidebar;
    document.body.appendChild(overlay);
  }

  window.addEventListener('resize', () => {
    if (!window.matchMedia('(max-width: 600px)').matches) closeMobileSidebar();
  });
}

/* ═══════════════════════════════════════════════════════
   RENDER CONTENT
═══════════════════════════════════════════════════════ */
function renderAllContent() {
  initMemberCheckIn();
  renderMemberLivePresence();
  renderMemberSchedule();
  renderMemberWorkouts();
  renderCoachesGrid();
  renderSupplements();
  renderCoachClients();
  renderCoachWorkouts();
  renderAdminInventory();
}

function initMemberCheckIn() {
  const pageEl = document.getElementById('member-checkin-page');
  if (!pageEl) return;

  const statusEl = document.getElementById('checkin-status');
  const resultEl = document.getElementById('checkin-result');
  const startBtn = document.getElementById('checkin-start-btn');
  const stopBtn = document.getElementById('checkin-stop-btn');
  const modeInBtn = document.getElementById('checkin-mode-in-btn');
  const modeOutBtn = document.getElementById('checkin-mode-out-btn');
  const modeLabel = document.getElementById('checkin-current-mode');

  if (!statusEl || !resultEl || !startBtn || !stopBtn || !modeInBtn || !modeOutBtn || !modeLabel) return;

  const setRunningState = (isRunning) => {
    startBtn.disabled = isRunning;
    stopBtn.disabled = !isRunning;
  };

  const getModeLabel = () => checkInMode === 'checkout' ? 'Check-Out' : 'Check-In';

  const getIdleStatus = () => `Tap "Open Camera" to start scanning your ${getModeLabel().toLowerCase()} QR code.`;

  const setModeButtons = () => {
    modeInBtn.classList.toggle('active', checkInMode === 'checkin');
    modeOutBtn.classList.toggle('active', checkInMode === 'checkout');
    modeLabel.textContent = getModeLabel();
    startBtn.innerHTML = `<i class="fas fa-camera"></i> Open Camera (${getModeLabel()})`;
  };

  const setStatus = (message, tone) => {
    statusEl.textContent = message;
    statusEl.className = `checkin-status ${tone || ''}`.trim();
  };

  const startCheckInScanner = async () => {
    if (checkInActive) return;
    if (typeof Html5Qrcode === 'undefined') {
      setStatus('QR scanner library not available on this page.', 'error');
      return;
    }

    try {
      if (!checkInScanner) checkInScanner = new Html5Qrcode('checkin-reader');

      setStatus('Requesting camera access...', 'info');
      await checkInScanner.start(
        { facingMode: 'environment' },
        { fps: 10, qrbox: { width: 230, height: 230 }, aspectRatio: 1.0 },
        (decodedText) => {
          const modeText = getModeLabel();
          updateMemberPresence(checkInMode, decodedText);
          const timestamp = new Date().toLocaleString('en-US', { hour12: true });
          resultEl.innerHTML = `<div><strong>${modeText} Recorded</strong></div><div style="margin-top:6px;color:var(--muted);font-size:0.82rem;">${timestamp}</div><div style="margin-top:8px;">${decodedText}</div>`;
          setStatus(`${modeText} successful. QR code detected.`, 'success');
          showToast(`${modeText} successful`);
          stopCheckInScanner();
        },
        () => {}
      );

      checkInActive = true;
      setRunningState(true);
      setStatus('Camera ready. Point it at your gym QR code.', 'info');
    } catch (error) {
      setRunningState(false);
      setStatus('Unable to open camera. Please allow camera permission.', 'error');
    }
  };

  const setMode = async (mode) => {
    if (checkInMode === mode) return;
    if (checkInActive) await stopCheckInScanner();
    checkInMode = mode;
    setModeButtons();
    resultEl.textContent = 'No QR scanned yet';
    setStatus(getIdleStatus(), 'info');
  };

  if (!startBtn.dataset.bound) {
    startBtn.addEventListener('click', startCheckInScanner);
    stopBtn.addEventListener('click', () => stopCheckInScanner(true));
    modeInBtn.addEventListener('click', () => setMode('checkin'));
    modeOutBtn.addEventListener('click', () => setMode('checkout'));
    startBtn.dataset.bound = '1';
  }

  setModeButtons();
  setRunningState(checkInActive);
  if (!checkInActive) {
    setStatus(getIdleStatus(), 'info');
    resultEl.textContent = 'No QR scanned yet';
    startCheckInScanner();
  }
}

async function stopCheckInScanner(fromUserAction = false) {
  if (!checkInScanner) {
    checkInActive = false;
    return;
  }

  try {
    if (checkInActive) await checkInScanner.stop();
    await checkInScanner.clear();
  } catch (error) {
    // Ignore cleanup errors from scanner state transitions.
  }

  checkInScanner = null;
  checkInActive = false;

  const startBtn = document.getElementById('checkin-start-btn');
  const stopBtn = document.getElementById('checkin-stop-btn');
  const statusEl = document.getElementById('checkin-status');

  if (startBtn) startBtn.disabled = false;
  if (stopBtn) stopBtn.disabled = true;
  if (statusEl && fromUserAction) {
    const modeText = checkInMode === 'checkout' ? 'check-out' : 'check-in';
    statusEl.textContent = `Camera stopped. Tap "Open Camera" to scan ${modeText} again.`;
    statusEl.className = 'checkin-status info';
  }
}

function renderMemberSchedule() {
  const el = document.getElementById('member-schedule-grid');
  if (!el) return;

  const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
  const workoutsByDay = weekdays.reduce((accumulator, day) => {
    accumulator[day] = [];
    return accumulator;
  }, {});

  WORKOUTS.forEach(workout => {
    const dayName = new Date(`${workout.date}T12:00:00`).toLocaleDateString('en-US', { weekday: 'long' });
    if (workoutsByDay[dayName]) workoutsByDay[dayName].push(workout);
  });

  el.innerHTML = weekdays.map(day => `
    <section class="schedule-day-card">
      <header class="schedule-day-header">
        <div class="schedule-day-name">${day}</div>
      </header>
      <div class="schedule-day-body">
        ${workoutsByDay[day].length ? workoutsByDay[day].map(workout => `
          <button class="schedule-workout-item" onclick="openWorkoutModal(${workout.id})">
            <div class="schedule-workout-top">
              <div class="schedule-workout-name">${workout.name}</div>
              <span class="badge badge-green">${workout.status}</span>
            </div>
            <div class="schedule-workout-meta">
              <span><i class="fas fa-clock"></i>${workout.time}</span>
              <span><i class="fas fa-user-tie"></i>${workout.coach}</span>
            </div>
          </button>
        `).join('') : `
          <div class="schedule-empty">No workout scheduled</div>
        `}
      </div>
    </section>
  `).join('');
}

function renderMemberWorkouts() {
  const el = document.getElementById('member-workouts-list');
  if (!el) return;
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
        ${w.exercises.map((e,index) => `<span class="exercise-pill" onclick="event.stopPropagation(); openExerciseDetail(${w.id}, ${index});"><i class="fas fa-circle" style="font-size:5px;color:var(--accent);"></i>${e.name}</span>`).join('')}
      </div>
      <div style="margin-top:12px;display:flex;align-items:center;justify-content:space-between;">
        <span class="badge badge-green">${w.status}</span>
        <span style="font-size:0.8rem;color:var(--muted);">${w.exercises.length} exercises <i class="fas fa-chevron-right" style="font-size:0.7rem;margin-left:4px;"></i></span>
      </div>
    </div>
  `).join('');
}

function openExerciseDetail(workoutId, exerciseIndex) {
  const w = WORKOUTS.find(x => x.id === workoutId);
  if (!w || !w.exercises[exerciseIndex]) return;
  const e = w.exercises[exerciseIndex];
  const imageFile = EXERCISE_IMAGES[e.name.toLowerCase()];
  const imageMarkup = imageFile ? `
      <div class="exercise-modal-media">
        <img class="exercise-modal-image" src="${getAssetRootPath()}${imageFile}" alt="${e.name}" onerror="this.parentElement.style.display='none'">
      </div>
  ` : '';
  document.getElementById('exercise-modal-title').textContent = e.name;
  document.getElementById('exercise-modal-body').innerHTML = `
    <div style="display:grid;gap:1rem;">
      ${imageMarkup}
      <div style="font-weight:700;font-size:1rem;">${e.name}</div>
      <div style="color:var(--muted);font-size:0.95rem;line-height:1.6;">${e.description}</div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;">
        <div style="background:var(--surface2);border-radius:12px;padding:12px;">
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;">Sets</div>
          <div style="font-weight:700;font-size:1.1rem;">${e.sets}</div>
        </div>
        <div style="background:var(--surface2);border-radius:12px;padding:12px;">
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;">Reps</div>
          <div style="font-weight:700;font-size:1.1rem;">${e.reps}</div>
        </div>
        <div style="background:var(--surface2);border-radius:12px;padding:12px;">
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;">Intensity</div>
          <div style="font-weight:700;font-size:1.1rem;">${e.intensity}</div>
        </div>
        <div style="background:var(--surface2);border-radius:12px;padding:12px;">
          <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:4px;">Muscles</div>
          <div style="font-weight:700;font-size:1.1rem;">${e.muscles}</div>
        </div>
      </div>
    </div>
  `;
  openModal('exercise-modal');
}

function renderCoachesGrid() {
  const el = document.getElementById('coaches-grid');
  if (!el) return;
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
  if (!el) return;
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
  if (!el) return;
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
  if (!el) return;
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
  if (!tbody) return;
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
    ${w.exercises.map((e, index) => `
      <div onclick="openExerciseDetail(${w.id}, ${index})" style="background:var(--surface2);border:1px solid var(--border);border-radius:12px;padding:1rem;margin-bottom:10px;cursor:pointer;">
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

function openModal(id) {
  const nextModal = document.getElementById(id);
  if (!nextModal) return;

  document.querySelectorAll('.modal-overlay.open').forEach(modal => {
    if (modal !== nextModal) modal.classList.remove('open');
  });

  nextModal.classList.add('open');
}

function closeModal(id) {
  const modal = document.getElementById(id);
  if (!modal) return;
  modal.classList.remove('open');
}

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

/* ═══════════════════════════════════════════════════════
   PAGE INITIALIZATION
═══════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', initApp);
