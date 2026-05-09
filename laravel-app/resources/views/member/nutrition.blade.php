<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IRONFORGE - Nutrition</title>
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

    <div class="sidebar-nav" id="sidebar-nav"></div>

    <div class="sidebar-footer">
      <button class="logout-btn" onclick="doLogout()">
        <i class="fas fa-sign-out-alt"></i>
        <span>Log Out</span>
      </button>
    </div>
  </nav>

  <div class="main" id="main">
    <div class="topbar">
      <div class="topbar-title" id="topbar-title">Nutrition</div>
      <div class="topbar-right">
        <span class="topbar-badge badge-muted badge" id="topbar-role-badge">DEMO</span>
        <button class="btn btn-secondary btn-sm" id="cart-btn" onclick="toggleCart()" style="display:none;">
          <i class="fas fa-shopping-bag"></i> Cart <span id="cart-count" style="background:var(--accent);color:#000;border-radius:20px;padding:1px 7px;font-size:0.75rem;margin-left:2px;"></span>
        </button>
      </div>
    </div>

    <div class="page-content">
      <div class="page" id="page-member-nutrition">
        <div class="section-header">
          <div class="section-title">Daily Nutrition</div>
          <div class="section-sub">Track meals against your calorie and macro targets</div>
        </div>

        <div class="panel">
          <div class="panel-header">
            <div class="panel-title"><i class="fas fa-calendar-day" style="margin-right:8px;color:var(--accent);"></i>Day Summary</div>
            <input type="date" class="input" id="nutrition-date" style="max-width:180px;">
          </div>
          <div class="panel-body">
            <div class="nutrition-goals-grid">
              <div class="nutrition-goal-card">
                <div class="nutrition-goal-top">
                  <div class="nutrition-goal-label">Calories</div>
                  <div class="nutrition-goal-values"><span id="nutrition-calories-consumed">0</span> / <span id="nutrition-calories-target">0</span> target · max <span id="nutrition-calories-max">0</span></div>
                </div>
                <div class="progress-bar"><div id="nutrition-calories-progress" class="progress-fill nutrition-progress-calories" style="width:0%;"></div></div>
                <div class="nutrition-goal-msg"></div>
              </div>

              <div class="nutrition-goal-card">
                <div class="nutrition-goal-top">
                  <div class="nutrition-goal-label">Carbs (g)</div>
                  <div class="nutrition-goal-values"><span id="nutrition-carbs-consumed">0</span> / <span id="nutrition-carbs-target">0</span> target · max <span id="nutrition-carbs-max">0</span></div>
                </div>
                <div class="progress-bar"><div id="nutrition-carbs-progress" class="progress-fill nutrition-progress-carbs" style="width:0%;"></div></div>
                <div class="nutrition-goal-msg"></div>
              </div>

              <div class="nutrition-goal-card">
                <div class="nutrition-goal-top">
                  <div class="nutrition-goal-label">Protein (g)</div>
                  <div class="nutrition-goal-values"><span id="nutrition-protein-consumed">0</span> / <span id="nutrition-protein-target">0</span> target · max <span id="nutrition-protein-max">0</span></div>
                </div>
                <div class="progress-bar"><div id="nutrition-protein-progress" class="progress-fill nutrition-progress-protein" style="width:0%;"></div></div>
                <div class="nutrition-goal-msg"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- BMI & Body Composition Panel -->
        <div class="panel" style="margin-bottom:1.5rem;">
          <div class="panel-header">
            <div class="panel-title"><i class="fas fa-weight-scale" style="margin-right:8px;color:var(--accent);"></i>BMI &amp; Body Composition</div>
            <div style="display:flex;align-items:center;gap:0.75rem;">
              <span id="bmi-last-saved" class="bmi-last-saved" style="display:none;"><i class="fas fa-clock"></i> <span id="bmi-last-saved-text"></span></span>
              <button class="btn btn-sm btn-secondary" id="bmi-save-btn" onclick="saveBodyComposition()"><i class="fas fa-floppy-disk"></i> Save</button>
            </div>
          </div>
          <div class="panel-body">
            <div class="bmi-body-grid">

              <!-- Left: inputs -->
              <div class="bmi-inputs-col">
                <div class="bmi-inputs-grid">
                  <div class="field">
                    <label class="field-label">Height (cm)</label>
                    <input class="input" type="number" min="50" max="280" step="0.1" id="bmi-height" placeholder="175" oninput="recalcBMI()">
                  </div>
                  <div class="field">
                    <label class="field-label">Weight (kg)</label>
                    <input class="input" type="number" min="20" max="500" step="0.1" id="bmi-weight" placeholder="75" oninput="recalcBMI()">
                  </div>
                  <div class="field">
                    <label class="field-label">Body Fat (%)</label>
                    <input class="input" type="number" min="1" max="70" step="0.1" id="bmi-body-fat" placeholder="18" oninput="recalcBodyComp()">
                  </div>
                  <div class="field">
                    <label class="field-label">Muscle Mass (kg)</label>
                    <input class="input" type="number" min="5" max="200" step="0.1" id="bmi-muscle-mass" placeholder="35">
                  </div>
                  <div class="field">
                    <label class="field-label">Waist (cm)</label>
                    <input class="input" type="number" min="30" max="300" step="0.1" id="bmi-waist" placeholder="82">
                  </div>
                </div>
              </div>

              <!-- Right: results -->
              <div class="bmi-results-col">
                <div class="bmi-card" id="bmi-result-card">
                  <div class="bmi-label">BMI</div>
                  <div class="bmi-value" id="bmi-value">--</div>
                  <div class="bmi-category" id="bmi-category">Enter height &amp; weight</div>
                  <div class="bmi-scale">
                    <div class="bmi-scale-bar">
                      <div class="bmi-scale-fill" id="bmi-scale-fill" style="width:0%;"></div>
                      <div class="bmi-scale-pointer" id="bmi-scale-pointer" style="left:0%;display:none;"></div>
                    </div>
                    <div class="bmi-scale-labels">
                      <span>Underweight</span><span>Normal</span><span>Overweight</span><span>Obese</span>
                    </div>
                  </div>
                </div>

                <div class="bmi-decomp-grid">
                  <div class="bmi-decomp-card">
                    <div class="bmi-decomp-icon"><i class="fas fa-fire-flame-curved"></i></div>
                    <div class="bmi-decomp-label">Fat Mass</div>
                    <div class="bmi-decomp-value" id="decomp-fat-mass">--</div>
                  </div>
                  <div class="bmi-decomp-card">
                    <div class="bmi-decomp-icon" style="color:#4ade80;"><i class="fas fa-person"></i></div>
                    <div class="bmi-decomp-label">Lean Mass</div>
                    <div class="bmi-decomp-value" id="decomp-lean-mass">--</div>
                  </div>
                  <div class="bmi-decomp-card">
                    <div class="bmi-decomp-icon" style="color:#60a5fa;"><i class="fas fa-dumbbell"></i></div>
                    <div class="bmi-decomp-label">Muscle Mass</div>
                    <div class="bmi-decomp-value" id="decomp-muscle-mass">--</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Progress History -->
          <div class="bmi-history-section">
            <button class="bmi-history-toggle" onclick="toggleBmiHistory()" id="bmi-history-toggle">
              <i class="fas fa-chart-line"></i> Progress History
              <i class="fas fa-chevron-down" id="bmi-history-chevron" style="margin-left:auto;transition:transform 0.25s;"></i>
            </button>
            <div id="bmi-history-content" class="bmi-history-content" style="display:none;">
              <div id="bmi-history-list">
                <div class="empty-state" style="padding:1.2rem;"><i class="fas fa-chart-line"></i><p>No history yet. Save your first measurement!</p></div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid-2">
          <div class="panel">
            <div class="panel-header"><div class="panel-title">Add Meal</div></div>
            <div class="panel-body">
              <form id="nutrition-entry-form">
                <div class="field">
                  <label class="field-label">Meal Name</label>
                  <input class="input" name="meal_name" id="nutrition-meal-name" placeholder="e.g. Chicken Salad" required>
                </div>
                <div class="nutrition-input-grid">
                  <div class="field">
                    <label class="field-label">Calories</label>
                    <input class="input" type="number" min="0" name="calories" id="nutrition-calories-input" placeholder="500" required>
                  </div>
                  <div class="field">
                    <label class="field-label">Carbs (g)</label>
                    <input class="input" type="number" min="0" name="carbs" id="nutrition-carbs-input" placeholder="40" required>
                  </div>
                  <div class="field">
                    <label class="field-label">Protein (g)</label>
                    <input class="input" type="number" min="0" name="protein" id="nutrition-protein-input" placeholder="35" required>
                  </div>
                </div>
                <div class="field">
                  <label class="field-label">Notes (Optional)</label>
                  <input class="input" name="notes" id="nutrition-notes" placeholder="Any extra details">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>Add Meal</button>
              </form>
            </div>
          </div>

          <div class="panel">
            <div class="panel-header"><div class="panel-title">Logged Meals</div></div>
            <div class="panel-body">
              <div id="nutrition-entries-list"></div>
            </div>
          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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

<div id="toast" class="toast" style="display:none;">
  <i class="fas fa-check-circle"></i>
  <span id="toast-msg">Done!</span>
</div>

<script src="../assets/js/app.js"></script>
</body>
</html>
