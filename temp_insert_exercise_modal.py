from pathlib import Path

files = [
    'admin/members.html',
    'coach/workouts.html',
    'coach/clients.html',
    'member/workouts.html',
    'admin/inventory.html',
    'coach/dashboard.html',
    'member/supplements.html',
    'member/dashboard.html',
    'admin/coaches.html',
    'admin/dashboard.html',
    'member/coaches.html',
]

insert = "\n".join([
    chr(60) + chr(33) + "-- Exercise Detail Modal -->",
    '<div class="modal-overlay" id="exercise-modal">',
    '  <div class="modal-box">',
    '    <div class="modal-header">',
    '      <div class="modal-title" id="exercise-modal-title">Exercise</div>',
    '      <button class="modal-close" onclick="closeModal(\'exercise-modal\')"><i class="fas fa-times"></i></button>',
    '    </div>',
    '    <div class="modal-body" id="exercise-modal-body"></div>',
    '  </div>',
    '</div>',
])
marker = chr(60) + chr(33) + "-- Client Detail Modal -->"

for fp in files:
    path = Path(fp)
    text = path.read_text()
    if 'id="exercise-modal"' in text:
        print('already has modal', fp)
        continue
    if marker not in text:
        print('missing marker', fp)
        continue
    path.write_text(text.replace(marker, insert + '\n' + marker, 1))
    print('updated', fp)
