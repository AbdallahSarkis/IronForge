/* ═══════════════════════════════════════════════════════
   DATA
═══════════════════════════════════════════════════════ */
const USERS = {
  'john@example.com':  { name:'John Doe',   role:'member', initials:'JD', gradient:'135deg,#22c55e,#16a34a' },
  'sarah@example.com': { name:'Sarah Johnson', role:'coach', initials:'SJ', gradient:'135deg,#4facfe,#a855f7' },
  'admin@example.com': { name:'Gym User', role:'admin', initials:'GU', gradient:'135deg,#f97316,#ef4444' },
};

let PRODUCTS = [
  { id:'p1', name:'Whey Protein 5lb', category:'supplement', price:49.99, stock:50, image:'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=400', description:'Premium whey protein isolate for muscle recovery' },
  { id:'p2', name:'Pre-Workout Boost', category:'supplement', price:34.99, stock:30, image:'https://images.unsplash.com/photo-1579722821273-0f6c7d44362f?w=400', description:'Energy and focus enhancement formula' },
  { id:'p3', name:'Resistance Bands Set', category:'equipment', price:24.99, stock:75, image:'https://images.unsplash.com/photo-1598289431512-b97b0917affc?w=400', description:'Professional grade resistance bands - 5 levels' },
  { id:'p4', name:'Yoga Mat Premium', category:'equipment', price:39.99, stock:40, image:'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=400', description:'Non-slip eco-friendly yoga mat' },
  { id:'p5', name:'BCAA Recovery', category:'supplement', price:29.99, stock:60, image:'https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?w=400', description:'Branch chain amino acids for faster recovery' },
  { id:'p6', name:'Kettlebell 20kg', category:'equipment', price:79.99, stock:15, image:'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400', description:'Cast iron kettlebell with comfort grip' },
];

let COACHES = [
  { id:'c1', name:'Sarah Johnson', specialty:'HIIT & Strength', clients:2, gradient:'135deg,#4facfe,#a855f7', initials:'SJ', sessions:48, rating:4.9 },
  { id:'c2', name:'Mike Davis', specialty:'Yoga & Flexibility', clients:5, gradient:'135deg,#22c55e,#16a34a', initials:'MD', sessions:62, rating:4.8 },
  { id:'c3', name:'Alex Rivera', specialty:'Bodybuilding', clients:3, gradient:'135deg,#f97316,#ef4444', initials:'AR', sessions:35, rating:4.7 },
];

let WORKOUTS = [
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

let CLIENTS = [
  { id:'1', name:'John Doe', email:'john@example.com', goal:'Build muscle mass and increase strength', initials:'JD', gradient:'135deg,#6366f1,#8b5cf6', workouts:[WORKOUTS[0], WORKOUTS[1]] },
  { id:'4', name:'Emma Wilson', email:'emma@example.com', goal:'Weight loss and cardio endurance', initials:'EW', gradient:'135deg,#ec4899,#f97316', workouts:[WORKOUTS[2]] },
];

let NEARBY_GYMS = [
  { id:'g1', name:'IronForge Downtown', distance:'0.8 km', location:'Central District', open:'Open until 11:00 PM', amenities:['Weights','Cardio','Sauna'], latitude:25.2048, longitude:55.2708 },
  { id:'g2', name:'FlexHub Riverside', distance:'2.1 km', location:'Riverside Avenue', open:'Open 24/7', amenities:['HIIT Zone','Pool','Lockers'], latitude:25.2190, longitude:55.2984 },
  { id:'g3', name:'Peak Performance West', distance:'3.4 km', location:'West End', open:'Open until 10:00 PM', amenities:['CrossFit','Stretch Studio','Parking'], latitude:25.1765, longitude:55.2362 },
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
let memberNutritionSummary = null;
let nutritionSpecialistMembers = [];

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
  'user-dashboard':'dashboard.html',
  'user-profile':'profile.html',
  'user-explore':'explore.html',
  'user-near-gyms':'near-gyms.html',
  'user-near-coaches':'near-coaches.html',
  'member-dashboard':'dashboard.html',
  'member-profile':'profile.html',
  'member-schedule':'schedule.html',
  'member-checkin':'checkin.html',
  'member-workouts':'workouts.html',
  'member-coaches':'coaches.html',
  'member-nutrition':'nutrition.html',
  'member-supplements':'supplements.html',
  'coach-dashboard':'dashboard.html',
  'coach-profile':'profile.html',
  'coach-clients':'clients.html',
  'coach-workouts':'workouts.html',
  'nutrition-specialist-dashboard':'dashboard.html',
  'nutrition-specialist-profile':'profile.html',
  'nutrition-specialist-members':'members.html',
  'admin-dashboard':'dashboard.html',
  'admin-profile':'profile.html',
  'admin-coaches':'coaches.html',
  'admin-members':'members.html',
  'admin-inventory':'inventory.html',
  'super-admin-dashboard':'dashboard.html',
  'super-admin-gyms':'gyms.html',
  'super-admin-users':'users.html',
  'super-admin-coaches':'reports.html',
  'super-admin-reports':'reports.html',
};

function getCurrentFolderPath() {
  return location.pathname.substring(0, location.pathname.lastIndexOf('/') + 1);
}

function getAssetRootPath() {
  return location.pathname.includes('/member/')
    || location.pathname.includes('/coach/')
    || location.pathname.includes('/admin/')
    || location.pathname.includes('/user/')
    || location.pathname.includes('/nutrition-specialist/')
    || location.pathname.includes('/super-admin/') ? '../' : '';
}

function getCurrentPageId() {
  const fileName = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);
  const pageName = fileName.replace('.html', '');
  return `${currentUser.role}-${pageName}`;
}

function getStoredUser() {
  return null;
}

function setStoredUser(user) {
  return user;
}

function formatRoleLabel(role) {
  return String(role)
    .split('-')
    .map(part => part.charAt(0).toUpperCase() + part.slice(1))
    .join(' ');
}

function getCsrfToken() {
  const token = document.querySelector('meta[name="csrf-token"]');
  return token ? token.getAttribute('content') : '';
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
  const form = document.getElementById('login-form');
  if (!form) return;
  form.submit();
}

function doLogout() {
  currentUser = null;
  cart = [];
  setStoredUser(null);
  window.location.href = '/logout';
}


async function getSessionUser() {
  try {
    const response = await fetch('/session-user', {
      headers: {
        Accept: 'application/json',
      },
      credentials: 'same-origin',
    });

    if (!response.ok) return null;
    return await response.json();
  } catch (error) {
    return null;
  }
}

async function loadAppData() {
  try {
    const response = await fetch('/app-data', {
      headers: {
        Accept: 'application/json',
      },
      credentials: 'same-origin',
    });

    if (!response.ok) return;

    const payload = await response.json();
    if (Array.isArray(payload.products)) PRODUCTS = payload.products;
    if (Array.isArray(payload.coaches)) COACHES = payload.coaches;
    if (Array.isArray(payload.workouts)) WORKOUTS = payload.workouts;
    if (Array.isArray(payload.clients)) CLIENTS = payload.clients;
    if (Array.isArray(payload.gyms)) NEARBY_GYMS = payload.gyms;
  } catch (error) {
    // Keep demo defaults if backend data is unavailable.
  }
}

/* ═══════════════════════════════════════════════════════
   APP INIT
═══════════════════════════════════════════════════════ */
async function initApp() {
  const appEl = document.getElementById('app');
  if (!appEl) return; // not on an app page
  currentUser = await getSessionUser();
  if (!currentUser) {
    window.location.href = '/login.html';
    return;
  }

  const currentSection = location.pathname.split('/')[1];
  if (['user', 'member', 'coach', 'nutrition-specialist', 'admin', 'super-admin'].includes(currentSection) && currentSection !== currentUser.role) {
    window.location.href = `/${currentUser.role}/dashboard.html`;
    return;
  }

  await loadAppData();

  appEl.classList.add('active');

  // User meta
  document.getElementById('user-name-label').textContent = currentUser.name;
  document.getElementById('user-avatar').textContent = currentUser.initials;
  document.getElementById('user-avatar').style.background = `linear-gradient(${currentUser.gradient})`;

  const roleEl = document.getElementById('user-role-badge');
  if (roleEl) {
    roleEl.textContent = formatRoleLabel(currentUser.role);
    roleEl.className = `user-role role-${currentUser.role}`;
  }

  const topBadge = document.getElementById('topbar-role-badge');
  if (topBadge) {
    const badgeCls = {
      user: 'badge-cyan',
      member: 'badge-green',
      coach: 'badge-blue',
      'nutrition-specialist': 'badge-accent',
      admin: 'badge-orange',
      'super-admin': 'badge-purple',
    };
    topBadge.textContent = currentUser.role === 'admin' ? 'GYM' : currentUser.role === 'super-admin' ? 'SUPER ADMIN' : currentUser.role.toUpperCase().replaceAll('-', ' ');
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
  return {
    user: 'user-dashboard',
    member: 'member-dashboard',
    coach: 'coach-dashboard',
    'nutrition-specialist': 'nutrition-specialist-dashboard',
    admin: 'admin-dashboard',
    'super-admin': 'super-admin-dashboard',
  }[currentUser.role];
}

const NAV_CONFIG = {
  user: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'user-dashboard' },
    { icon:'fas fa-user', label:'Profile', page:'user-profile' },
    { icon:'fas fa-compass', label:'Explore', page:'user-explore' },
    { icon:'fas fa-dumbbell', label:'Near Gyms', page:'user-near-gyms' },
    { icon:'fas fa-user-tie', label:'Near Coaches', page:'user-near-coaches' },
  ],
  member: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'member-dashboard' },
    { icon:'fas fa-user', label:'Profile', page:'member-profile' },
    { icon:'fas fa-calendar-week', label:'Schedule', page:'member-schedule' },
    { icon:'fas fa-qrcode', label:'Check-In', page:'member-checkin' },
    { icon:'fas fa-dumbbell', label:'Workouts', page:'member-workouts' },
    { icon:'fas fa-user-tie', label:'Coaches', page:'member-coaches' },
    { icon:'fas fa-apple-whole', label:'Nutrition', page:'member-nutrition' },
    { icon:'fas fa-pills', label:'Shop', page:'member-supplements' },
  ],
  coach: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'coach-dashboard' },
    { icon:'fas fa-user', label:'Profile', page:'coach-profile' },
    { icon:'fas fa-users', label:'Clients', page:'coach-clients' },
    { icon:'fas fa-dumbbell', label:'Workouts', page:'coach-workouts' },
  ],
  'nutrition-specialist': [
    { icon:'fas fa-gauge', label:'Dashboard', page:'nutrition-specialist-dashboard' },
    { icon:'fas fa-user', label:'Profile', page:'nutrition-specialist-profile' },
    { icon:'fas fa-users', label:'Members', page:'nutrition-specialist-members' },
  ],
  admin: [
    { icon:'fas fa-gauge', label:'Dashboard', page:'admin-dashboard' },
    { icon:'fas fa-user', label:'Profile', page:'admin-profile' },
    { icon:'fas fa-user-tie', label:'Coaches', page:'admin-coaches' },
    { icon:'fas fa-users', label:'Members', page:'admin-members' },
    { icon:'fas fa-boxes', label:'Inventory', page:'admin-inventory' },
  ],
  'super-admin': [
    { icon:'fas fa-gauge',       label:'Dashboard', page:'super-admin-dashboard' },
    { icon:'fas fa-dumbbell',    label:'Gyms',      page:'super-admin-gyms' },
    { icon:'fas fa-users',       label:'All Users', page:'super-admin-users' },
    { icon:'fas fa-chart-bar',   label:'Reports',   page:'super-admin-reports' },
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
    'user-dashboard':'Dashboard','user-profile':'Profile','user-explore':'Explore','user-near-gyms':'Near Gyms','user-near-coaches':'Near Coaches',
    'member-dashboard':'Dashboard','member-profile':'Profile','member-schedule':'Schedule','member-checkin':'Check-In','member-workouts':'Workouts','member-coaches':'Coaches','member-nutrition':'Nutrition','member-supplements':'Shop',
    'coach-dashboard':'Dashboard','coach-profile':'Profile','coach-clients':'Clients','coach-workouts':'Workouts',
    'nutrition-specialist-dashboard':'Dashboard','nutrition-specialist-profile':'Profile','nutrition-specialist-members':'Members',
    'admin-dashboard':'Dashboard','admin-profile':'Gym Profile','admin-coaches':'Coaches','admin-members':'Members','admin-inventory':'Inventory',
    'super-admin-dashboard':'Dashboard','super-admin-gyms':'Gyms','super-admin-users':'All Users','super-admin-reports':'Reports',
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
  renderNearbyGyms();
  initMemberCheckIn();
  renderMemberLivePresence();
  renderMemberSchedule();
  renderMemberWorkouts();
  initMemberNutrition();
  renderCoachesGrid();
  renderSupplements();
  renderCoachClients();
  renderCoachWorkouts();
  loadNutritionSpecialistMembers();
  renderAdminInventory();
  saInitDashboard();
  saInitGyms();
  saInitUsers();
  saInitReports();
}

function renderNearbyGyms() {
  const el = document.getElementById('user-near-gyms-list');
  if (!el) return;

  const gymsToRender = buildNearGymsForCurrentUser();

  if (!gymsToRender.length) {
    el.innerHTML = `
      <div class="panel">
        <div class="panel-body" style="color:var(--muted);">No gyms available yet. Ask the gym to complete gym profile details.</div>
      </div>
    `;
    return;
  }

  el.innerHTML = gymsToRender.map(gym => `
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">${gym.name}</div>
        <span class="badge badge-cyan">${gym.distanceLabel}</span>
      </div>
      <div class="panel-body">
        <div style="display:flex;justify-content:space-between;gap:0.75rem;flex-wrap:wrap;align-items:center;">
          <div>
            <div style="font-size:0.85rem;color:var(--muted);margin-bottom:6px;"><i class="fas fa-location-dot" style="margin-right:6px;color:var(--accent);"></i>${gym.location}</div>
            <div style="font-size:0.85rem;color:var(--muted);"><i class="fas fa-clock" style="margin-right:6px;color:var(--accent);"></i>${gym.open}</div>
          </div>
          <button class="btn btn-secondary btn-sm" onclick="openGymDirections('${gym.id}')"><i class="fas fa-route"></i> Directions</button>
        </div>
        <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
          ${gym.amenities.map(item => `<span class="badge badge-muted">${item}</span>`).join('')}
        </div>
      </div>
    </div>
  `).join('');
}

function getUserGeoOrigin() {
  if (!currentUser) return null;

  const latitude = Number(currentUser.location_latitude);
  const longitude = Number(currentUser.location_longitude);

  if (Number.isNaN(latitude) || Number.isNaN(longitude)) {
    return null;
  }

  return { latitude, longitude };
}

function haversineDistanceKm(fromLat, fromLng, toLat, toLng) {
  const toRad = (deg) => (deg * Math.PI) / 180;
  const earthRadiusKm = 6371;

  const deltaLat = toRad(toLat - fromLat);
  const deltaLng = toRad(toLng - fromLng);
  const a = Math.sin(deltaLat / 2) ** 2
    + Math.cos(toRad(fromLat)) * Math.cos(toRad(toLat)) * Math.sin(deltaLng / 2) ** 2;
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

  return earthRadiusKm * c;
}

function buildNearGymsForCurrentUser() {
  const origin = getUserGeoOrigin();

  return [...NEARBY_GYMS]
    .filter((gym) => gym && gym.name)
    .map((gym) => {
      const latitude = Number(gym.latitude);
      const longitude = Number(gym.longitude);
      const hasCoordinates = !Number.isNaN(latitude) && !Number.isNaN(longitude);

      if (!origin || !hasCoordinates) {
        return {
          ...gym,
          distanceKm: Number.POSITIVE_INFINITY,
          distanceLabel: gym.distance || 'Distance unavailable',
        };
      }

      const distanceKm = haversineDistanceKm(origin.latitude, origin.longitude, latitude, longitude);

      return {
        ...gym,
        distanceKm,
        distanceLabel: `${distanceKm.toFixed(1)} km`,
      };
    })
    .sort((a, b) => a.distanceKm - b.distanceKm);
}

function buildGymDestination(gym) {
  if (gym.latitude != null && gym.longitude != null) {
    return `${gym.latitude},${gym.longitude}`;
  }

  return `${gym.name}, ${gym.location}`;
}

function getSavedUserOrigin() {
  if (!currentUser) return null;
  const lat = Number(currentUser.location_latitude);
  const lng = Number(currentUser.location_longitude);
  if (Number.isNaN(lat) || Number.isNaN(lng)) return null;
  return { lat, lng };
}

function openMapsDirections(origin, destination) {
  const originParam = origin ? `${origin.lat},${origin.lng}` : '';
  const params = new URLSearchParams({
    api: '1',
    destination,
    travelmode: 'driving',
  });

  if (originParam) params.set('origin', originParam);

  window.location.href = `https://www.google.com/maps/dir/?${params.toString()}`;
}

function openGymDirections(gymId) {
  const gym = NEARBY_GYMS.find(item => item.id === gymId);
  if (!gym) {
    showToast('Gym location not found');
    return;
  }

  const destination = buildGymDestination(gym);
  const savedOrigin = getSavedUserOrigin();

  if (!navigator.geolocation) {
    openMapsDirections(savedOrigin, destination);
    return;
  }

  navigator.geolocation.getCurrentPosition((position) => {
    const liveOrigin = {
      lat: position.coords.latitude,
      lng: position.coords.longitude,
    };
    openMapsDirections(liveOrigin, destination);
  }, () => {
    if (savedOrigin) {
      showToast('Using saved profile location for directions');
      openMapsDirections(savedOrigin, destination);
      return;
    }

    showToast('Location permission denied, opening destination only');
    openMapsDirections(null, destination);
  }, {
    enableHighAccuracy: true,
    timeout: 8000,
    maximumAge: 0,
  });
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
      <button class="btn btn-secondary" style="width:100%;justify-content:center;" onclick="openCoachContactModal('${c.id}')"><i class="fas fa-envelope"></i> Message Coach</button>
    </div>
  `).join('');
}

function sanitizePhoneNumber(number) {
  return String(number || '').replace(/[^\d+]/g, '');
}

function openCoachContactModal(coachId) {
  const coach = COACHES.find(item => String(item.id) === String(coachId));
  if (!coach) {
    showToast('Coach contact not available');
    return;
  }

  const whatsappNumber = sanitizePhoneNumber(coach.whatsapp_number || coach.phone_number);
  const phoneNumber = sanitizePhoneNumber(coach.phone_number);
  const titleEl = document.getElementById('coach-contact-modal-title');
  const bodyEl = document.getElementById('coach-contact-modal-body');
  if (!titleEl || !bodyEl) return;

  titleEl.textContent = `Contact ${coach.name}`;
  bodyEl.innerHTML = `
    <div style="display:flex;flex-direction:column;gap:12px;">
      <div style="color:var(--muted);font-size:0.92rem;">Choose how you want to contact ${coach.name}.</div>
      <a class="btn btn-primary" style="justify-content:center;text-decoration:none;" href="https://wa.me/${encodeURIComponent(whatsappNumber)}?text=${encodeURIComponent(`Hi ${coach.name}, I would like to know more about your coaching services on IRONFORGE.`)}" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i> WhatsApp
      </a>
      <button class="btn btn-secondary" style="justify-content:center;" onclick="sendCoachInAppMessage('${String(coach.id)}')">
        <i class="fas fa-comments"></i> Via Application
      </button>
      <a class="btn btn-secondary" style="justify-content:center;text-decoration:none;" href="tel:${phoneNumber}">
        <i class="fas fa-phone"></i> Call ${coach.phone_number || 'Coach'}
      </a>
    </div>
  `;

  openModal('coach-contact-modal');
}

function sendCoachInAppMessage(coachId) {
  const coach = COACHES.find(item => String(item.id) === String(coachId));
  if (!coach) {
    showToast('Coach contact not available');
    return;
  }

  closeModal('coach-contact-modal');
  showToast(`Message request sent to ${coach.name} in app`);
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

async function initMemberNutrition() {
  const nutritionPage = document.getElementById('page-member-nutrition');
  if (!nutritionPage) return;

  const dateInput = document.getElementById('nutrition-date');
  const form = document.getElementById('nutrition-entry-form');

  if (!dateInput || !form) return;

  if (!dateInput.value) {
    dateInput.value = new Date().toISOString().slice(0, 10);
  }

  if (!dateInput.dataset.bound) {
    dateInput.addEventListener('change', () => {
      loadMemberNutritionSummary(dateInput.value);
    });
    dateInput.dataset.bound = '1';
  }

  if (!form.dataset.bound) {
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      await submitMemberNutritionEntry();
    });
    form.dataset.bound = '1';
  }

  await loadMemberNutritionSummary(dateInput.value);
  await loadBodyComposition();
}

async function loadMemberNutritionSummary(date) {
  const page = document.getElementById('page-member-nutrition');
  if (!page) return;

  try {
    const response = await fetch(`/member/nutrition/summary?date=${encodeURIComponent(date)}`, {
      headers: {
        Accept: 'application/json',
      },
      credentials: 'same-origin',
    });

    if (!response.ok) {
      showToast('Unable to load nutrition summary');
      return;
    }

    memberNutritionSummary = await response.json();
    renderMemberNutritionSummary();
  } catch (error) {
    showToast('Unable to load nutrition summary');
  }
}

function renderMemberNutritionSummary() {
  if (!memberNutritionSummary) return;

  const targets = memberNutritionSummary.targets || {};
  const consumed = memberNutritionSummary.consumed || {};
  const entries = Array.isArray(memberNutritionSummary.entries) ? memberNutritionSummary.entries : [];

  setText('nutrition-calories-consumed', consumed.calories || 0);
  setText('nutrition-calories-target', targets.target_calories || 0);
  setText('nutrition-calories-max', targets.max_calories || 0);

  setText('nutrition-carbs-consumed', consumed.carbs || 0);
  setText('nutrition-carbs-target', targets.target_carbs || 0);
  setText('nutrition-carbs-max', targets.max_carbs || 0);

  setText('nutrition-protein-consumed', consumed.protein || 0);
  setText('nutrition-protein-target', targets.target_protein || 0);
  setText('nutrition-protein-max', targets.max_protein || 0);

  updateNutritionProgress('nutrition-calories-progress', consumed.calories || 0, targets.target_calories || 0, targets.max_calories || 0, 'Calories');
  updateNutritionProgress('nutrition-carbs-progress', consumed.carbs || 0, targets.target_carbs || 0, targets.max_carbs || 0, 'Carbs');
  updateNutritionProgress('nutrition-protein-progress', consumed.protein || 0, targets.target_protein || 0, targets.max_protein || 0, 'Protein');

  const list = document.getElementById('nutrition-entries-list');
  if (!list) return;

  if (!entries.length) {
    list.innerHTML = '<div class="empty-state" style="padding:1.5rem;"><i class="fas fa-bowl-food"></i><p>No meals logged for this date yet</p></div>';
    return;
  }

  list.innerHTML = entries.map(entry => `
    <div class="nutrition-entry-card" data-entry-id="${entry.id}">
      <div class="nutrition-entry-top">
        <div class="nutrition-entry-name">${entry.meal_name}</div>
        <div style="display:flex;align-items:center;gap:0.5rem;">
          <span class="badge badge-muted">${entry.time || ''}</span>
          <button class="entry-action-btn" title="Edit" onclick="openEditMealModal(${entry.id})"><i class="fas fa-pen"></i></button>
          <button class="entry-action-btn entry-action-delete" title="Delete" onclick="deleteMealEntry(${entry.id})"><i class="fas fa-trash"></i></button>
        </div>
      </div>
      <div class="nutrition-entry-macros">
        <span><i class="fas fa-fire"></i>${entry.calories} kcal</span>
        <span><i class="fas fa-bread-slice"></i>${entry.carbs} g carbs</span>
        <span><i class="fas fa-drumstick-bite"></i>${entry.protein} g protein</span>
      </div>
      ${entry.notes ? `<div class="nutrition-entry-notes">${entry.notes}</div>` : ''}
    </div>
  `).join('');
}

async function submitMemberNutritionEntry() {
  const dateInput = document.getElementById('nutrition-date');
  const mealName = document.getElementById('nutrition-meal-name');
  const calories = document.getElementById('nutrition-calories-input');
  const carbs = document.getElementById('nutrition-carbs-input');
  const protein = document.getElementById('nutrition-protein-input');
  const notes = document.getElementById('nutrition-notes');

  if (!dateInput || !mealName || !calories || !carbs || !protein || !notes) return;

  try {
    const response = await fetch('/member/nutrition/entries', {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
      body: JSON.stringify({
        entry_date: dateInput.value,
        meal_name: mealName.value.trim(),
        calories: Number(calories.value),
        carbs: Number(carbs.value),
        protein: Number(protein.value),
        notes: notes.value.trim(),
      }),
    });

    if (!response.ok) {
      showToast('Unable to add meal entry');
      return;
    }

    const payload = await response.json();
    if (memberNutritionSummary) {
      memberNutritionSummary.entries = payload.entries || [];
      memberNutritionSummary.consumed = payload.consumed || { calories: 0, carbs: 0, protein: 0 };
    }

    renderMemberNutritionSummary();
    mealName.value = '';
    calories.value = '';
    carbs.value = '';
    protein.value = '';
    notes.value = '';
    showToast('Meal added successfully');
  } catch (error) {
    showToast('Unable to add meal entry');
  }
}

// ── BMI & Body Composition ───────────────────────────────────────────────────

const BMI_CATEGORIES = [
  { max: 18.5, label: 'Underweight', color: '#60a5fa', pct: 15 },
  { max: 25,   label: 'Normal',      color: '#4ade80', pct: 40 },
  { max: 30,   label: 'Overweight',  color: '#facc15', pct: 65 },
  { max: 999,  label: 'Obese',       color: '#f87171', pct: 90 },
];

function recalcBMI() {
  const h = parseFloat(document.getElementById('bmi-height')?.value);
  const w = parseFloat(document.getElementById('bmi-weight')?.value);

  const valEl  = document.getElementById('bmi-value');
  const catEl  = document.getElementById('bmi-category');
  const fill   = document.getElementById('bmi-scale-fill');
  const ptr    = document.getElementById('bmi-scale-pointer');
  const card   = document.getElementById('bmi-result-card');

  if (!valEl) return;

  if (!h || !w || h <= 0 || w <= 0) {
    valEl.textContent  = '--';
    catEl.textContent  = 'Enter height & weight';
    if (fill) fill.style.width = '0%';
    if (ptr)  ptr.style.display = 'none';
    return;
  }

  const bmi = w / ((h / 100) ** 2);
  const cat = BMI_CATEGORIES.find(c => bmi < c.max) || BMI_CATEGORIES.at(-1);

  valEl.textContent  = bmi.toFixed(1);
  catEl.textContent  = cat.label;
  catEl.style.color  = cat.color;
  valEl.style.color  = cat.color;

  if (card) { card.style.borderColor = cat.color + '55'; card.style.boxShadow = `0 0 0 2px ${cat.color}22`; }
  if (fill) { fill.style.width = `${cat.pct}%`; fill.style.background = cat.color; }
  if (ptr)  { ptr.style.left = `${cat.pct}%`; ptr.style.display = 'block'; }

  recalcBodyComp();
}

function recalcBodyComp() {
  const w   = parseFloat(document.getElementById('bmi-weight')?.value);
  const bf  = parseFloat(document.getElementById('bmi-body-fat')?.value);
  const mm  = parseFloat(document.getElementById('bmi-muscle-mass')?.value);

  const fatEl    = document.getElementById('decomp-fat-mass');
  const leanEl   = document.getElementById('decomp-lean-mass');
  const muscleEl = document.getElementById('decomp-muscle-mass');

  if (fatEl && w && bf) {
    const fatMass  = (w * bf) / 100;
    const leanMass = w - fatMass;
    fatEl.textContent  = `${fatMass.toFixed(1)} kg`;
    leanEl.textContent = `${leanMass.toFixed(1)} kg`;
  } else {
    if (fatEl)  fatEl.textContent  = '--';
    if (leanEl) leanEl.textContent = '--';
  }

  if (muscleEl) muscleEl.textContent = mm ? `${mm.toFixed(1)} kg` : '--';
}

// ── Meal Edit / Delete ───────────────────────────────────────────────────────

function applyNutritionUpdate(data) {
  if (!memberNutritionSummary) return;
  memberNutritionSummary.entries  = data.entries;
  memberNutritionSummary.consumed = data.consumed;
  renderMemberNutritionSummary();
}

function openEditMealModal(entryId) {
  const entry = memberNutritionSummary?.entries?.find(e => e.id === entryId);
  if (!entry) return;

  // Remove existing modal if any
  document.getElementById('meal-edit-modal')?.remove();

  const modal = document.createElement('div');
  modal.id = 'meal-edit-modal';
  modal.className = 'meal-edit-overlay';
  modal.innerHTML = `
    <div class="meal-edit-dialog" role="dialog" aria-modal="true">
      <div class="meal-edit-header">
        <span><i class="fas fa-pen" style="color:var(--accent);margin-right:8px;"></i>Edit Meal</span>
        <button class="modal-close" onclick="document.getElementById('meal-edit-modal').remove()"><i class="fas fa-times"></i></button>
      </div>
      <div class="meal-edit-body">
        <div class="field">
          <label class="field-label">Meal Name</label>
          <input class="input" id="edit-meal-name" value="${entry.meal_name}" maxlength="255" required>
        </div>
        <div class="nutrition-input-grid">
          <div class="field">
            <label class="field-label">Calories</label>
            <input class="input" type="number" min="0" max="9999" id="edit-meal-calories" value="${entry.calories}">
          </div>
          <div class="field">
            <label class="field-label">Carbs (g)</label>
            <input class="input" type="number" min="0" max="999" id="edit-meal-carbs" value="${entry.carbs}">
          </div>
          <div class="field">
            <label class="field-label">Protein (g)</label>
            <input class="input" type="number" min="0" max="999" id="edit-meal-protein" value="${entry.protein}">
          </div>
        </div>
        <div class="field">
          <label class="field-label">Notes</label>
          <input class="input" id="edit-meal-notes" value="${entry.notes || ''}" maxlength="255">
        </div>
        <div style="display:flex;gap:0.75rem;margin-top:0.5rem;">
          <button class="btn btn-primary" style="flex:1;" onclick="saveEditMealEntry(${entryId})"><i class="fas fa-floppy-disk"></i> Save Changes</button>
          <button class="btn btn-secondary" onclick="document.getElementById('meal-edit-modal').remove()">Cancel</button>
        </div>
      </div>
    </div>`;

  // Close on backdrop click
  modal.addEventListener('click', e => { if (e.target === modal) modal.remove(); });
  document.body.appendChild(modal);
  requestAnimationFrame(() => modal.classList.add('meal-edit-overlay-show'));
  document.getElementById('edit-meal-name')?.focus();
}

async function saveEditMealEntry(entryId) {
  const name     = document.getElementById('edit-meal-name')?.value?.trim();
  const calories = parseInt(document.getElementById('edit-meal-calories')?.value);
  const carbs    = parseInt(document.getElementById('edit-meal-carbs')?.value);
  const protein  = parseInt(document.getElementById('edit-meal-protein')?.value);
  const notes    = document.getElementById('edit-meal-notes')?.value?.trim();

  if (!name || isNaN(calories) || isNaN(carbs) || isNaN(protein)) {
    showNutritionToast('⚠️ Please fill in all required fields.', 'max');
    return;
  }

  try {
    const res = await fetch(`/member/nutrition/entries/${entryId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrfToken(), 'X-Requested-With': 'XMLHttpRequest' },
      body: JSON.stringify({ meal_name: name, calories, carbs, protein, notes }),
    });
    const data = await res.json();
    if (res.ok) {
      document.getElementById('meal-edit-modal')?.remove();
      applyNutritionUpdate(data);
      showNutritionToast('✅ Meal updated!', 'target');
    } else {
      showNutritionToast('⚠️ ' + (data.message || 'Update failed.'), 'max');
    }
  } catch (_) {
    showNutritionToast('⚠️ Network error.', 'max');
  }
}

async function deleteMealEntry(entryId) {
  if (!confirm('Delete this meal entry?')) return;

  try {
    const res = await fetch(`/member/nutrition/entries/${entryId}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': getCsrfToken(), 'X-Requested-With': 'XMLHttpRequest' },
    });
    const data = await res.json();
    if (res.ok) {
      applyNutritionUpdate(data);
      showNutritionToast('🗑️ Meal deleted.', 'target');
    } else {
      showNutritionToast('⚠️ ' + (data.message || 'Delete failed.'), 'max');
    }
  } catch (_) {
    showNutritionToast('⚠️ Network error.', 'max');
  }
}

async function loadBodyComposition() {
  if (!document.getElementById('bmi-height')) return;
  try {
    const res  = await fetch('/member/nutrition/body-composition', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
    if (!res.ok) return;
    const data = await res.json();

    const set = (id, val) => { if (val !== null && document.getElementById(id)) document.getElementById(id).value = val; };
    set('bmi-height',     data.height_cm);
    set('bmi-weight',     data.weight_kg);
    set('bmi-body-fat',   data.body_fat_percent);
    set('bmi-muscle-mass',data.muscle_mass_kg);
    set('bmi-waist',      data.waist_cm);

    recalcBMI();
    setBmiLastSaved(data.saved_at);
    renderBmiHistory(data.history || []);
  } catch (_) {}
}

async function saveBodyComposition() {
  const getValue = id => { const v = parseFloat(document.getElementById(id)?.value); return isNaN(v) ? null : v; };

  const height = getValue('bmi-height');
  const weight = getValue('bmi-weight');

  if (!height || !weight) {
    showNutritionToast('⚠️ Height and weight are required.', 'max');
    return;
  }

  const payload = {
    height_cm:        height,
    weight_kg:        weight,
    body_fat_percent: getValue('bmi-body-fat'),
    muscle_mass_kg:   getValue('bmi-muscle-mass'),
    waist_cm:         getValue('bmi-waist'),
  };

  try {
    const res = await fetch('/member/nutrition/body-composition', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrfToken(), 'X-Requested-With': 'XMLHttpRequest' },
      body: JSON.stringify(payload),
    });
    const data = await res.json();
    if (res.ok) {
      showNutritionToast('✅ Body composition saved!', 'target');
      setBmiLastSaved(data.saved_at);
      renderBmiHistory(data.history || []);
    } else {
      showNutritionToast('⚠️ ' + (data.message || 'Save failed.'), 'max');
    }
  } catch (_) {
    showNutritionToast('⚠️ Network error. Please try again.', 'max');
  }
}

function setBmiLastSaved(savedAt) {
  const wrap = document.getElementById('bmi-last-saved');
  const text = document.getElementById('bmi-last-saved-text');
  if (!wrap || !text || !savedAt) return;
  const d = new Date(savedAt);
  text.textContent = `Last saved: ${d.toLocaleDateString(undefined, { month:'short', day:'numeric', year:'numeric' })} ${d.toLocaleTimeString(undefined, { hour:'2-digit', minute:'2-digit' })}`;
  wrap.style.display = 'inline-flex';
}

function renderBmiHistory(history) {
  const container = document.getElementById('bmi-history-list');
  if (!container) return;

  if (!history.length) {
    container.innerHTML = '<div class="empty-state" style="padding:1.2rem;"><i class="fas fa-chart-line"></i><p>No history yet. Save your first measurement!</p></div>';
    return;
  }

  // Compute trend arrows vs previous entry
  const rows = history.map((row, i) => {
    const prev = history[i + 1];
    const weightDiff = prev ? (row.weight_kg - prev.weight_kg) : null;
    const bmiDiff    = prev ? (row.bmi - prev.bmi) : null;
    const weightArrow = weightDiff === null ? '' : weightDiff < 0 ? '<span class="trend-down">▼ ' + Math.abs(weightDiff).toFixed(1) + ' kg</span>' : weightDiff > 0 ? '<span class="trend-up">▲ ' + weightDiff.toFixed(1) + ' kg</span>' : '<span class="trend-flat">— same</span>';
    const bmiArrow    = bmiDiff === null ? '' : bmiDiff < 0 ? '<span class="trend-down">▼ ' + Math.abs(bmiDiff).toFixed(1) + '</span>' : bmiDiff > 0 ? '<span class="trend-up">▲ ' + bmiDiff.toFixed(1) + '</span>' : '';

    const date = new Date(row.date).toLocaleDateString(undefined, { month: 'short', day: 'numeric', year: 'numeric' });
    const bmiCat = BMI_CATEGORIES.find(c => row.bmi < c.max) || BMI_CATEGORIES.at(-1);

    return `<div class="bmi-history-row">
      <div class="bmi-history-date"><i class="fas fa-calendar-day"></i> ${date}</div>
      <div class="bmi-history-metrics">
        <div class="bmi-history-metric">
          <span class="bmi-history-metric-label">Weight</span>
          <span class="bmi-history-metric-val">${row.weight_kg} kg</span>
          ${weightArrow}
        </div>
        <div class="bmi-history-metric">
          <span class="bmi-history-metric-label">BMI</span>
          <span class="bmi-history-metric-val" style="color:${bmiCat.color}">${row.bmi}</span>
          ${bmiArrow}
        </div>
        ${row.body_fat_percent ? `<div class="bmi-history-metric"><span class="bmi-history-metric-label">Body Fat</span><span class="bmi-history-metric-val">${row.body_fat_percent}%</span></div>` : ''}
        ${row.muscle_mass_kg ? `<div class="bmi-history-metric"><span class="bmi-history-metric-label">Muscle</span><span class="bmi-history-metric-val">${row.muscle_mass_kg} kg</span></div>` : ''}
        ${row.waist_cm ? `<div class="bmi-history-metric"><span class="bmi-history-metric-label">Waist</span><span class="bmi-history-metric-val">${row.waist_cm} cm</span></div>` : ''}
      </div>
    </div>`;
  });

  container.innerHTML = rows.join('');
}

function toggleBmiHistory() {
  const content  = document.getElementById('bmi-history-content');
  const chevron  = document.getElementById('bmi-history-chevron');
  if (!content) return;
  const open = content.style.display === 'none' || content.style.display === '';
  content.style.display = open ? 'block' : 'none';
  if (chevron) chevron.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
}


async function loadNutritionSpecialistMembers() {
  if (currentUser?.role !== 'nutrition-specialist') return;

  const dashboardContainer = document.getElementById('nutrition-specialist-dashboard-list');
  const membersContainer = document.getElementById('nutrition-specialist-members-list');
  if (!dashboardContainer && !membersContainer) return;

  try {
    const response = await fetch('/nutrition-specialist/members/data', {
      headers: {
        Accept: 'application/json',
      },
      credentials: 'same-origin',
    });

    if (!response.ok) {
      showToast('Unable to load members nutrition data');
      return;
    }

    const payload = await response.json();
    nutritionSpecialistMembers = Array.isArray(payload.members) ? payload.members : [];
    renderNutritionSpecialistDashboard();
    renderNutritionSpecialistMembersPage();
  } catch (error) {
    showToast('Unable to load members nutrition data');
  }
}

function renderNutritionSpecialistDashboard() {
  const dashboardContainer = document.getElementById('nutrition-specialist-dashboard-list');
  if (!dashboardContainer) return;

  const totalMembers = nutritionSpecialistMembers.length;
  const membersOnTrack = nutritionSpecialistMembers.filter(member => {
    return Number(member.today?.calories || 0) <= Number(member.targets?.max_calories || 0);
  }).length;
  const totalMeals = nutritionSpecialistMembers.reduce((sum, member) => sum + Number(member.today?.meals || 0), 0);

  setText('ns-total-members', totalMembers);
  setText('ns-members-on-track', membersOnTrack);
  setText('ns-total-meals-logged', totalMeals);

  if (!totalMembers) {
    dashboardContainer.innerHTML = '<div class="empty-state" style="padding:1.5rem;"><i class="fas fa-users"></i><p>No members available</p></div>';
    return;
  }

  dashboardContainer.innerHTML = nutritionSpecialistMembers.map(member => `
    <div class="nutrition-specialist-snapshot">
      <div>
        <div class="nutrition-entry-name">${member.name}</div>
        <div style="font-size:0.8rem;color:var(--muted);">${member.email}</div>
      </div>
      <div style="display:flex;gap:0.5rem;flex-wrap:wrap;justify-content:flex-end;">
        <span class="badge badge-muted">${member.today.calories} / ${member.targets.max_calories} kcal</span>
        <span class="badge badge-blue">${member.today.meals} meal${member.today.meals === 1 ? '' : 's'}</span>
      </div>
    </div>
  `).join('');
}

function renderNutritionSpecialistMembersPage() {
  const membersContainer = document.getElementById('nutrition-specialist-members-list');
  if (!membersContainer) return;

  if (!nutritionSpecialistMembers.length) {
    membersContainer.innerHTML = '<div class="empty-state" style="padding:1.5rem;"><i class="fas fa-users"></i><p>No members available</p></div>';
    return;
  }

  membersContainer.innerHTML = nutritionSpecialistMembers.map(member => `
    <div class="panel">
      <div class="panel-header">
        <div>
          <div class="panel-title">${member.name}</div>
          <div style="font-size:0.8rem;color:var(--muted);margin-top:4px;">${member.email}</div>
        </div>
        <span class="badge badge-muted">${member.today.calories} kcal today</span>
      </div>
      <div class="panel-body">
        <div class="nutrition-entry-macros" style="margin-bottom:1rem;">
          <span><i class="fas fa-bread-slice"></i>${member.today.carbs} g carbs</span>
          <span><i class="fas fa-drumstick-bite"></i>${member.today.protein} g protein</span>
          <span><i class="fas fa-utensils"></i>${member.today.meals} meals</span>
        </div>

        <form onsubmit="saveNutritionTargets(event, ${member.id})">
          <div class="nutrition-targets-grid">
            <div class="field">
              <label class="field-label">Target Calories</label>
              <input class="input" type="number" name="target_calories" min="500" value="${member.targets.target_calories}" required>
            </div>
            <div class="field">
              <label class="field-label">Max Calories</label>
              <input class="input" type="number" name="max_calories" min="500" value="${member.targets.max_calories}" required>
            </div>
            <div class="field">
              <label class="field-label">Target Carbs (g)</label>
              <input class="input" type="number" name="target_carbs" min="20" value="${member.targets.target_carbs}" required>
            </div>
            <div class="field">
              <label class="field-label">Max Carbs (g)</label>
              <input class="input" type="number" name="max_carbs" min="20" value="${member.targets.max_carbs}" required>
            </div>
            <div class="field">
              <label class="field-label">Target Protein (g)</label>
              <input class="input" type="number" name="target_protein" min="20" value="${member.targets.target_protein}" required>
            </div>
            <div class="field">
              <label class="field-label">Max Protein (g)</label>
              <input class="input" type="number" name="max_protein" min="20" value="${member.targets.max_protein}" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>Save Targets</button>
        </form>
      </div>
    </div>
  `).join('');
}

async function saveNutritionTargets(event, memberId) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);

  const payload = {
    target_calories: Number(formData.get('target_calories')),
    max_calories: Number(formData.get('max_calories')),
    target_carbs: Number(formData.get('target_carbs')),
    max_carbs: Number(formData.get('max_carbs')),
    target_protein: Number(formData.get('target_protein')),
    max_protein: Number(formData.get('max_protein')),
  };

  try {
    const response = await fetch(`/nutrition-specialist/members/${memberId}/targets`, {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
      body: JSON.stringify(payload),
    });

    if (!response.ok) {
      showToast('Unable to save nutrition targets');
      return;
    }

    showToast('Nutrition targets updated');
    await loadNutritionSpecialistMembers();
  } catch (error) {
    showToast('Unable to save nutrition targets');
  }
}

function updateNutritionProgress(id, consumed, target, max, label) {
  const bar = document.getElementById(id);
  if (!bar) return;

  const card = bar.closest('.nutrition-goal-card');
  const msgEl = card ? card.querySelector('.nutrition-goal-msg') : null;

  if (!max || max <= 0) {
    bar.style.width = '0%';
    return;
  }

  const percent = Math.min((consumed / max) * 100, 100);
  bar.style.width = `${percent}%`;

  // Remove previous state classes
  if (card) card.classList.remove('nutrition-state-target', 'nutrition-state-max');
  if (msgEl) { msgEl.textContent = ''; msgEl.className = 'nutrition-goal-msg'; }

  if (consumed >= max) {
    if (card) card.classList.add('nutrition-state-max');
    if (msgEl) {
      msgEl.textContent = `⚠️ ${label} limit exceeded!`;
      msgEl.classList.add('nutrition-msg-max');
    }
    showNutritionToast(`⚠️ You've exceeded your ${label} limit!`, 'max');
  } else if (target && consumed >= target) {
    if (card) card.classList.add('nutrition-state-target');
    if (msgEl) {
      msgEl.textContent = `🎯 ${label} target reached!`;
      msgEl.classList.add('nutrition-msg-target');
    }
    showNutritionToast(`🎯 ${label} target reached! Great work!`, 'target');
  }
}

const _shownNutritionToasts = new Set();
function showNutritionToast(message, type) {
  const key = message;
  if (_shownNutritionToasts.has(key)) return;
  _shownNutritionToasts.add(key);
  setTimeout(() => _shownNutritionToasts.delete(key), 4000);

  let container = document.getElementById('nutrition-toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'nutrition-toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = `nutrition-toast nutrition-toast-${type}`;
  toast.textContent = message;
  container.appendChild(toast);

  requestAnimationFrame(() => toast.classList.add('nutrition-toast-show'));
  setTimeout(() => {
    toast.classList.remove('nutrition-toast-show');
    setTimeout(() => toast.remove(), 400);
  }, 3500);
}

function setText(id, value) {
  const el = document.getElementById(id);
  if (el) el.textContent = String(value);
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
  const key = String(id);
  const c = CLIENTS.find(x => String(x.id) === key);
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
  const key = String(productId);
  const product = PRODUCTS.find(p => String(p.id) === key);
  if (!product) return;
  const existing = cart.find(i => String(i.id) === key);
  if (existing) { existing.qty++; }
  else { cart.push({ ...product, id: key, qty: 1 }); }
  updateCartUI();
  showToast(`${product.name} added to cart`);
}

function removeFromCart(productId) {
  const key = String(productId);
  cart = cart.filter(i => String(i.id) !== key);
  updateCartUI();
}

function changeQty(productId, delta) {
  const key = String(productId);
  const item = cart.find(i => String(i.id) === key);
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
   SUPER ADMIN
═══════════════════════════════════════════════════════ */

/* ── Dashboard ── */
function saInitDashboard() {
  if (!document.getElementById('sa-stat-total-users')) return;
  fetch('../super-admin/stats', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json()).then(data => {
      const stats = data.stats || {};
      const setVal = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v ?? '—'; };
      setVal('sa-stat-total-users',  stats.total_users);
      setVal('sa-stat-members',      stats.total_members);
      setVal('sa-stat-coaches',      stats.total_coaches);
      setVal('sa-stat-gyms',         stats.total_admins);
      setVal('sa-stat-revenue',      '$' + (stats.total_revenue ?? 0).toLocaleString());
      setVal('sa-stat-checkins-today', stats.today_check_ins);
      setVal('sa-stat-nutrition',    stats.total_nutrition_logs);
      setVal('sa-stat-orders',       stats.total_orders);

      // Role distribution
      const rd = document.getElementById('sa-role-distribution-list');
      if (rd) {
        const dist = [
          { label: 'Members',              count: stats.total_members },
          { label: 'Coaches',              count: stats.total_coaches },
          { label: 'Gyms (Admin)',         count: stats.total_admins },
          { label: 'Nutrition Specialists',count: stats.total_nutrition_specialists },
          { label: 'Regular Users',        count: (stats.total_users - stats.total_members - stats.total_coaches - stats.total_admins - stats.total_nutrition_specialists) },
        ];
        rd.innerHTML = dist.map(d => `<div class="sa-dist-row"><span>${d.label}</span><strong>${d.count ?? 0}</strong></div>`).join('');
      }
    }).catch(() => {});

  fetch('../super-admin/coaches/data', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json()).then(data => {
      const list = document.getElementById('sa-top-coaches-list');
      if (!list) return;
      const coaches = (data.coaches || []).slice(0, 5);
      list.innerHTML = coaches.length
        ? coaches.map(c => `<div class="sa-coach-row"><span>${escHtml(c.name)}</span><span class="muted">${c.clients_count ?? 0} clients</span></div>`).join('')
        : '<div class="muted" style="padding:1rem;text-align:center">No coaches yet</div>';
    }).catch(() => {});
}

/* ── Gyms ── */
function saInitGyms() {
  if (!document.getElementById('sa-gyms-list')) return;
  fetch('../super-admin/gyms/data', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json()).then(data => {
      const list = document.getElementById('sa-gyms-list');
      const gyms = data.gyms || [];
      list.innerHTML = gyms.length
        ? gyms.map(g => `
            <div class="sa-gym-card">
              <div class="sa-gym-name">${escHtml(g.name)}</div>
              <div class="sa-gym-meta"><i class="fas fa-envelope"></i> ${escHtml(g.email)}</div>
              ${g.gym_name ? `<div class="sa-gym-meta"><i class="fas fa-dumbbell"></i> ${escHtml(g.gym_name)}</div>` : ''}
              ${g.gym_location ? `<div class="sa-gym-meta"><i class="fas fa-map-marker-alt"></i> ${escHtml(g.gym_location)}</div>` : ''}
              <div class="sa-gym-meta"><i class="fas fa-calendar"></i> Joined ${new Date(g.created_at).toLocaleDateString()}</div>
            </div>`).join('')
        : '<div class="muted" style="padding:2rem;text-align:center">No gyms yet</div>';
    }).catch(() => {});
}

/* ── Users ── */
let saUserDebounce;
function saInitUsers() {
  if (!document.getElementById('sa-users-table-wrap')) return;
  saLoadUsers();
  const searchEl = document.getElementById('sa-user-search');
  const roleEl   = document.getElementById('sa-user-role-filter');
  if (searchEl) searchEl.addEventListener('input', () => { clearTimeout(saUserDebounce); saUserDebounce = setTimeout(saLoadUsers, 300); });
  if (roleEl)   roleEl.addEventListener('change', saLoadUsers);
}

function saLoadUsers() {
  const search = (document.getElementById('sa-user-search')?.value || '').trim();
  const role   = (document.getElementById('sa-user-role-filter')?.value || '');
  const wrap   = document.getElementById('sa-users-table-wrap');
  if (!wrap) return;
  wrap.innerHTML = '<div class="muted" style="padding:2rem;text-align:center"><i class="fas fa-spinner fa-spin"></i> Loading…</div>';
  fetch(`../super-admin/users/data?search=${encodeURIComponent(search)}&role=${encodeURIComponent(role)}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json()).then(data => {
      const users = data.users || [];
      const badge = document.getElementById('sa-user-count');
      if (badge) badge.textContent = users.length;
      saRenderUsersTable(users);
    }).catch(() => { wrap.innerHTML = '<div class="muted" style="padding:2rem;text-align:center">Failed to load users</div>'; });
}

function saRenderUsersTable(users) {
  const wrap = document.getElementById('sa-users-table-wrap');
  if (!wrap) return;
  const roles = ['user','member','coach','nutrition-specialist','admin'];
  if (!users.length) { wrap.innerHTML = '<div class="muted" style="padding:2rem;text-align:center">No users found</div>'; return; }
  wrap.innerHTML = `<div class="sa-users-scroll"><table class="sa-user-table">
    <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th>Actions</th></tr></thead>
    <tbody>
      ${users.map(u => `<tr>
        <td>${escHtml(u.name)}</td>
        <td>${escHtml(u.email)}</td>
        <td><select class="sa-role-select" onchange="saChangeUserRole(${u.id},this.value)">
          ${roles.map(r => `<option value="${r}" ${u.role===r?'selected':''}>${r}</option>`).join('')}
        </select></td>
        <td>${new Date(u.created_at).toLocaleDateString()}</td>
        <td><button class="btn-danger-sm" onclick="saDeleteUser(${u.id},'${escHtml(u.name).replace(/'/g,"\\'")}')"><i class="fas fa-trash"></i></button></td>
      </tr>`).join('')}
    </tbody>
  </table></div>`;
}

function saChangeUserRole(userId, newRole) {
  const token = document.querySelector('meta[name="csrf-token"]')?.content || window._csrfToken || '';
  fetch(`../super-admin/users/${userId}/role`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
    body: JSON.stringify({ role: newRole })
  }).then(r => r.json()).then(d => { showToast(d.message || 'Role updated'); }).catch(() => showToast('Failed to update role'));
}

function saDeleteUser(userId, name) {
  if (!confirm(`Delete user "${name}"? This cannot be undone.`)) return;
  const token = document.querySelector('meta[name="csrf-token"]')?.content || window._csrfToken || '';
  fetch(`../super-admin/users/${userId}`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' }
  }).then(r => r.json()).then(d => { showToast(d.message || 'User deleted'); saLoadUsers(); }).catch(() => showToast('Failed to delete user'));
}

/* ── Reports ── */
function saInitReports() {
  if (!document.getElementById('sa-orders-by-status')) return;
  fetch('../super-admin/reports/data', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json()).then(data => {
      // Orders by status
      const obs = document.getElementById('sa-orders-by-status');
      if (obs) {
        const orders = data.orders_by_status || [];
        obs.innerHTML = orders.length
          ? orders.map(o => `<div class="sa-dist-row"><span>${escHtml(o.status)}</span><strong>${o.count}</strong></div>`).join('')
          : '<div class="muted">No orders yet</div>';
      }
      // Top products
      const tp = document.getElementById('sa-top-products');
      if (tp) {
        const products = data.top_products || [];
        tp.innerHTML = products.length
          ? products.map(p => `<div class="sa-dist-row"><span>${escHtml(p.product_name)}</span><strong>${p.total_sold} sold</strong></div>`).join('')
          : '<div class="muted">No product sales yet</div>';
      }
      // Check-in chart (simple bar)
      const cc = document.getElementById('sa-checkin-chart');
      if (cc) {
        const checkins = data.checkins_last_30_days || [];
        const max = Math.max(1, ...checkins.map(c => c.count));
        cc.innerHTML = `<div class="sa-bar-chart">${checkins.map(c => `
          <div class="sa-bar-col">
            <div class="sa-bar" style="height:${Math.round((c.count/max)*80)}px" title="${c.date}: ${c.count}"></div>
            <div class="sa-bar-label">${c.date?.slice(5)}</div>
          </div>`).join('')}</div>`;
      }
      // Coaches table
      const ct = document.getElementById('sa-coaches-table');
      if (ct) {
        const coaches = data.coaches || [];
        ct.innerHTML = coaches.length
          ? `<table class="sa-user-table"><thead><tr><th>Coach</th><th>Email</th><th>Clients</th></tr></thead><tbody>
              ${coaches.map(c => `<tr><td>${escHtml(c.name)}</td><td>${escHtml(c.email)}</td><td>${c.clients_count ?? 0}</td></tr>`).join('')}
            </tbody></table>`
          : '<div class="muted">No coaches yet</div>';
      }
    }).catch(() => {});
}

/* helper (idempotent with existing escHtml if present) */
if (typeof escHtml !== 'function') {
  function escHtml(s) { return String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
}

/* ═══════════════════════════════════════════════════════
   PAGE INITIALIZATION
═══════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', initApp);
