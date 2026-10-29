<?php
/*
|--------------------------------------------------------------------------
| PORTFOLIO DATA — the only part you need to edit to update the site
|--------------------------------------------------------------------------
| Save this file, refresh the browser. No database, no build step.
*/

// ---- Personal info -------------------------------------------------------
$site = [
    'name'     => 'Mohamed Yacine',
    'email'    => 'elmessarimohamedyacine@gmail.com',
    'github'   => '',   // e.g. 'https://github.com/your-username'  (empty = hidden)
    'linkedin' => '',   // e.g. 'https://www.linkedin.com/in/your-profile' (empty = hidden)
    'cv'       => '',   // e.g. 'files/cv.pdf' — put the PDF next to index.php (empty = button hidden)
];

// ---- Workshop categories (the 'category' value of each workshop must be one of these keys)
$categories = [
    'html-css'   => 'HTML/CSS',
    'javascript' => 'JavaScript',
    'php'        => 'PHP',
    'sql'        => 'MySQL / SQL',
    'git'        => 'Git & GitHub',
    'other'      => 'Other',
];

/*
|--------------------------------------------------------------------------
| HOW TO ADD A WORKSHOP / TP
|--------------------------------------------------------------------------
| 1. Copy the commented example block below (from "[" to "],").
| 2. Paste it inside the $workshops array, remove the leading "// ".
| 3. Edit the values and save. Fields marked (optional) can be left as ''.
|
| Keys:
|   'ref'      Workshop number or reference, e.g. 'Atelier 01' or 'TP 03'
|   'title'    Workshop title
|   'module'   School subject / module
|   'category' One of: html-css, javascript, php, sql, git, other
|   'desc'     Short description (1–2 sentences)
|   'tech'     List of technologies, e.g. ['HTML5', 'CSS3']
|   'date'     (optional) e.g. '2026-11-05' (YYYY-MM-DD) — newest are shown first
|   'image'    (optional) path to screenshot, e.g. 'images/atelier-01.png'
|   'demo'     (optional) link or path to the finished work, e.g. 'workshops/atelier-01/index.html'
|   'github'   (optional) GitHub repository URL
|   'pdf'      (optional) path to PDF report/assignment, e.g. 'docs/atelier-01.pdf'
*/
$workshops = [
    // [
    //     'ref'      => 'Atelier 01',
    //     'title'    => 'Title of the workshop',
    //     'module'   => 'Module name',
    //     'category' => 'html-css',
    //     'desc'     => 'What the assignment was and what I built.',
    //     'tech'     => ['HTML5', 'CSS3'],
    //     'date'     => '2026-11-05',
    //     'image'    => '',
    //     'demo'     => '',
    //     'github'   => '',
    //     'pdf'      => '',
    // ],
];

/*
|--------------------------------------------------------------------------
| HOW TO ADD A PERSONAL PROJECT
|--------------------------------------------------------------------------
| Same idea: copy the commented block, paste it inside $projects, edit, save.
| Keys: title, desc, tech (list), image (optional), demo (optional live URL),
|       github (optional repository URL).
*/
$projects = [
    // [
    //     'title'  => 'Project name',
    //     'desc'   => 'What it does and why I built it.',
    //     'tech'   => ['PHP', 'MySQL'],
    //     'image'  => '',
    //     'demo'   => '',
    //     'github' => '',
    // ],
];

/*
|--------------------------------------------------------------------------
| HOW TO ADD A LEARNING MILESTONE
|--------------------------------------------------------------------------
| Copy one entry, edit it, save. 'when' is free text (e.g. 'Year 1' or 'Nov 2026').
| Newest entries go at the bottom.
*/
$milestones = [
    [
        'when'  => 'Year 1',
        'title' => 'Started Digital Development at OFPPT',
        'text'  => 'Beginning my training in web development through workshops and practical assignments.',
    ],
    // [
    //     'when'  => 'Nov 2026',
    //     'title' => 'Milestone title',
    //     'text'  => 'What I learned or completed.',
    // ],
];

// ---- Skills (labels only — no invented percentages) ----------------------
$skills = [
    ['HTML5',      'fa-brands fa-html5'],
    ['CSS3',       'fa-brands fa-css3-alt'],
    ['JavaScript', 'fa-brands fa-js'],
    ['PHP',        'fa-brands fa-php'],
    ['MySQL',      'fa-solid fa-database'],
    ['Git',        'fa-brands fa-git-alt'],
    ['GitHub',     'fa-brands fa-github'],
    ['Bootstrap',  'fa-brands fa-bootstrap'],
];

/*
|--------------------------------------------------------------------------
| Helpers (escaping + safe URLs)
|--------------------------------------------------------------------------
*/
function e(?string $s): string { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

/** Allow only http(s) links or relative paths; blocks javascript:, data:, etc. */
function safe_url(?string $u): string {
    $u = trim((string)$u);
    if ($u === '') return '';
    if (preg_match('#^https?://#i', $u)) return $u;
    if (preg_match('#^[a-z][a-z0-9+.-]*:#i', $u)) return '';   // any other scheme → rejected
    return $u;
}
function is_external(string $u): bool { return (bool)preg_match('#^https?://#i', $u); }

function link_attrs(string $u): string {
    return 'href="' . e($u) . '"' . (is_external($u) ? ' target="_blank" rel="noopener noreferrer"' : '');
}

/** Renders one workshop or project card. */
function render_card(array $it, array $categories, bool $isWorkshop): void {
    $tech   = array_filter(array_map('strval', $it['tech'] ?? []));
    $cat    = $isWorkshop ? ($it['category'] ?? 'other') : '';
    if ($isWorkshop && !isset($categories[$cat])) $cat = 'other';
    $image  = safe_url($it['image'] ?? '');
    $demo   = safe_url($it['demo'] ?? '');
    $github = safe_url($it['github'] ?? '');
    $pdf    = $isWorkshop ? safe_url($it['pdf'] ?? '') : '';
    $date   = $isWorkshop ? trim((string)($it['date'] ?? '')) : '';
    $ts     = $date !== '' ? strtotime($date) : false;
    $search = strtolower(implode(' ', [$it['title'] ?? '', $it['desc'] ?? '', $it['module'] ?? '', $it['ref'] ?? '', implode(' ', $tech)]));
    ?>
    <article class="card" <?= $isWorkshop ? 'data-cat="' . e($cat) . '"' : '' ?> data-search="<?= e($search) ?>">
        <div class="card-media">
            <?php if ($image !== ''): ?>
                <img src="<?= e($image) ?>" alt="Screenshot of <?= e($it['title'] ?? '') ?>" loading="lazy" width="640" height="400">
            <?php else: ?>
                <span class="card-ph" aria-hidden="true"><?= e($isWorkshop ? ($it['ref'] ?? '') : '</>') ?></span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="card-meta">
                <?php if ($isWorkshop): ?>
                    <span class="ref"><?= e($it['ref'] ?? '') ?></span>
                    <?php if ($ts): ?><time datetime="<?= e(date('Y-m-d', $ts)) ?>"><?= e(date('M j, Y', $ts)) ?></time><?php endif; ?>
                <?php endif; ?>
            </div>
            <h3><?= e($it['title'] ?? '') ?></h3>
            <?php if ($isWorkshop && !empty($it['module'])): ?><p class="module"><i class="fa-solid fa-book-open" aria-hidden="true"></i> <?= e($it['module']) ?></p><?php endif; ?>
            <p class="desc"><?= e($it['desc'] ?? '') ?></p>
            <ul class="tags" aria-label="Technologies">
                <?php foreach ($tech as $t): ?><li><?= e($t) ?></li><?php endforeach; ?>
            </ul>
            <div class="actions">
                <?php if ($demo !== ''): ?><a class="btn btn-sm btn-primary" <?= link_attrs($demo) ?>><?= $isWorkshop ? 'Open work' : 'Live demo' ?></a><?php endif; ?>
                <?php if ($github !== ''): ?><a class="btn btn-sm btn-ghost" <?= link_attrs($github) ?>><i class="fa-brands fa-github" aria-hidden="true"></i> GitHub</a><?php endif; ?>
                <?php if ($pdf !== ''): ?><a class="btn btn-sm btn-ghost" <?= link_attrs($pdf) ?>><i class="fa-solid fa-file-pdf" aria-hidden="true"></i> PDF</a><?php endif; ?>
            </div>
        </div>
    </article>
    <?php
}

// Newest workshops first (entries without a date keep their order, placed after dated ones)
usort($workshops, function ($a, $b) {
    $ta = !empty($a['date']) ? (int)strtotime($a['date']) : 0;
    $tb = !empty($b['date']) ? (int)strtotime($b['date']) : 0;
    return $tb <=> $ta;
});

$github   = safe_url($site['github']);
$linkedin = safe_url($site['linkedin']);
$cv       = safe_url($site['cv']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($site['name']) ?> — Digital Development Student</title>
<meta name="description" content="Portfolio of <?= e($site['name']) ?>, Digital Development student at OFPPT, Morocco: workshops, practical assignments and personal projects.">
<meta name="theme-color" content="#0d0d12">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230d0d12'/%3E%3Ctext x='32' y='43' font-size='30' font-family='monospace' font-weight='700' fill='%238b5cf6' text-anchor='middle'%3EM.%3C/text%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

<style>
/* ===== Design tokens ===== */
:root{
  --bg:#0d0d12; --surface:#15151d; --surface-2:#1c1c27; --line:#2a2a38;
  --text:#ececf4; --muted:#9d9db4;
  --purple:#8b5cf6; --blue:#3b82f6; --grad:linear-gradient(115deg,#8b5cf6,#3b82f6);
  --font:'Space Grotesk',system-ui,sans-serif; --mono:'JetBrains Mono',ui-monospace,monospace;
  --r:12px; --wrap:1160px; --nav-h:68px;
}
*,*::before,*::after{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:calc(var(--nav-h) + 12px);-webkit-text-size-adjust:100%}
body{margin:0;background:var(--bg);color:var(--text);font-family:var(--font);line-height:1.65;font-size:1.0625rem;overflow-x:hidden}
body::before{content:"";position:fixed;inset:0;z-index:-1;pointer-events:none;
  background:radial-gradient(900px 500px at 85% -10%,rgba(139,92,246,.16),transparent 60%),
             radial-gradient(700px 500px at -10% 40%,rgba(59,130,246,.10),transparent 60%)}
img{max-width:100%;display:block}
a{color:inherit}
h1,h2,h3{line-height:1.1;margin:0;letter-spacing:-.02em}
p{margin:0}
ul{margin:0;padding:0;list-style:none}
:focus-visible{outline:2px solid var(--blue);outline-offset:3px;border-radius:6px}
.skip{position:absolute;left:-999px;top:8px;background:var(--purple);color:#fff;padding:.5rem 1rem;border-radius:8px;z-index:200}
.skip:focus{left:8px}
.wrap{width:min(100% - 2.5rem,var(--wrap));margin-inline:auto}
section{padding:clamp(4.5rem,10vw,8rem) 0}

/* ===== Section heads ===== */
.sec-head{display:grid;gap:1rem;margin-bottom:3rem;max-width:44rem}
.sec-head h2{font-size:clamp(2.2rem,5.5vw,3.8rem);font-weight:700}
.sec-head p{color:var(--muted)}

/* ===== Buttons ===== */
.btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.5rem;border-radius:10px;font:600 1rem var(--font);text-decoration:none;border:1px solid transparent;cursor:pointer;transition:transform .2s,box-shadow .2s,border-color .2s,background .2s}
.btn-primary{background:var(--grad);color:#fff;box-shadow:0 8px 28px -10px rgba(139,92,246,.7)}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 32px -8px rgba(139,92,246,.85)}
.btn-ghost{border-color:var(--line);background:rgba(255,255,255,.02);color:var(--text)}
.btn-ghost:hover{border-color:var(--purple);background:rgba(139,92,246,.1)}
.btn-sm{padding:.5rem .95rem;font-size:.9rem;border-radius:8px}

/* ===== Navigation ===== */
.nav{position:fixed;inset:0 0 auto 0;height:var(--nav-h);z-index:100;transition:background .3s,border-color .3s;border-bottom:1px solid transparent}
.nav.scrolled{background:rgba(13,13,18,.78);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-color:var(--line)}
.nav .wrap{height:100%;display:flex;align-items:center;justify-content:space-between}
.brand{font:700 1.5rem var(--mono);text-decoration:none;letter-spacing:-.04em}
.brand span{color:var(--purple)}
.nav-links{display:flex;align-items:center;gap:.25rem}
.nav-links a{text-decoration:none;color:var(--muted);padding:.5rem .85rem;border-radius:8px;font-weight:500;font-size:.97rem;transition:color .2s,background .2s}
.nav-links a:hover{color:var(--text)}
.nav-links a.active{color:var(--text);background:rgba(139,92,246,.14)}
.nav-links .btn{margin-left:.5rem;color:var(--text)}
.burger{display:none;width:44px;height:44px;border-radius:10px;border:1px solid var(--line);background:var(--surface);color:var(--text);cursor:pointer;align-items:center;justify-content:center}
.burger span,.burger span::before,.burger span::after{display:block;width:18px;height:2px;background:currentColor;border-radius:2px;position:relative;transition:transform .25s,background .25s}
.burger span::before,.burger span::after{content:"";position:absolute;left:0}
.burger span::before{top:-6px}.burger span::after{top:6px}
.burger[aria-expanded="true"] span{background:transparent}
.burger[aria-expanded="true"] span::before{transform:translateY(6px) rotate(45deg)}
.burger[aria-expanded="true"] span::after{transform:translateY(-6px) rotate(-45deg)}

/* ===== Hero ===== */
.hero{min-height:100svh;display:flex;align-items:center;padding:calc(var(--nav-h) + 2rem) 0 5rem;position:relative}
.hero-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:3.5rem;align-items:center}
.hello{font:500 1.05rem var(--mono);color:var(--muted);margin-bottom:1.25rem}
.hero h1{font-size:clamp(2.8rem,7.4vw,5.6rem);font-weight:700;letter-spacing:-.045em}
.hero h1 .grad{background:var(--grad);-webkit-background-clip:text;background-clip:text;color:transparent}
.role{font-size:clamp(1.15rem,2.4vw,1.45rem);margin-top:1.4rem;font-weight:500}
.intro{color:var(--muted);max-width:34rem;margin-top:1.1rem}
.hero-cta{display:flex;flex-wrap:wrap;gap:.9rem;margin-top:2.2rem}

/* Code window (the memorable element) */
.editor{background:rgba(21,21,29,.8);border:1px solid var(--line);border-radius:14px;box-shadow:0 30px 80px -30px rgba(139,92,246,.45);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);overflow:hidden}
.editor-bar{display:flex;align-items:center;gap:.5rem;padding:.8rem 1rem;border-bottom:1px solid var(--line);background:rgba(255,255,255,.02)}
.dot{width:11px;height:11px;border-radius:50%;background:#3a3a4a}
.editor-tabs{display:flex;gap:.25rem;margin-left:.75rem;font:.8rem var(--mono)}
.editor-tabs button{background:none;border:0;color:var(--muted);padding:.3rem .7rem;border-radius:6px;cursor:pointer;font:inherit}
.editor-tabs button[aria-selected="true"]{color:var(--text);background:rgba(139,92,246,.18)}
.code{margin:0;padding:1.3rem 1.3rem 1.5rem;font:.88rem/1.75 var(--mono);min-height:19.5rem;white-space:pre;overflow-x:auto;color:#c9c9dc;tab-size:2}
.code .k{color:#a78bfa}.code .s{color:#7dd3a8}.code .f{color:#60a5fa}.code .c{color:#6b6b82;font-style:italic}.code .t{color:#f0abfc}
.caret{display:inline-block;width:8px;height:1.05em;background:var(--blue);vertical-align:text-bottom;animation:blink 1s steps(2) infinite}
@keyframes blink{50%{opacity:0}}
.scroll-hint{position:absolute;left:50%;bottom:1.8rem;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:.5rem;color:var(--muted);font-size:.8rem;text-decoration:none}
.scroll-hint i{width:22px;height:36px;border:1.5px solid var(--line);border-radius:12px;position:relative}
.scroll-hint i::after{content:"";position:absolute;left:50%;top:7px;width:3px;height:7px;margin-left:-1.5px;border-radius:2px;background:var(--purple);animation:wheel 1.8s infinite}
@keyframes wheel{0%{opacity:1;transform:translateY(0)}100%{opacity:0;transform:translateY(12px)}}

/* ===== About ===== */
.about-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:3rem;align-items:start}
.about-text{display:grid;gap:1.2rem;color:#c4c4d6}
.facts{border:1px solid var(--line);border-radius:var(--r);background:var(--surface);padding:1.6rem;display:grid;gap:1.15rem}
.facts div{display:grid;gap:.15rem}
.facts dt{font:.82rem var(--mono);color:var(--muted)}
.facts dd{margin:0;font-weight:600}
.facts{margin:0}

/* ===== Skills ===== */
.skills{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:1rem}
.skill{display:flex;flex-direction:column;align-items:flex-start;gap:1.2rem;padding:1.3rem;border:1px solid var(--line);border-radius:var(--r);background:var(--surface);transition:border-color .25s,transform .25s}
.skill i{font-size:2rem;color:var(--muted);transition:color .25s}
.skill span{font-weight:600}
.skill:hover{border-color:var(--purple);transform:translateY(-4px)}
.skill:hover i{color:var(--purple)}

/* ===== Gallery (Workshops / Projects) ===== */
.toolbar{display:flex;flex-wrap:wrap;gap:1rem;align-items:center;justify-content:space-between;margin-bottom:2rem}
.chips{display:flex;flex-wrap:wrap;gap:.5rem}
.chip{font:500 .92rem var(--font);color:var(--muted);background:var(--surface);border:1px solid var(--line);padding:.5rem 1rem;border-radius:999px;cursor:pointer;transition:all .2s}
.chip:hover{color:var(--text);border-color:#43435a}
.chip[aria-pressed="true"]{color:#fff;background:var(--grad);border-color:transparent}
.chip small{opacity:.7;margin-left:.3rem;font-family:var(--mono)}
.search{position:relative;flex:0 1 20rem;min-width:min(100%,14rem)}
.search i{position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:var(--muted);pointer-events:none}
.search input{width:100%;padding:.75rem 1rem .75rem 2.6rem;border-radius:10px;border:1px solid var(--line);background:var(--surface);color:var(--text);font:1rem var(--font)}
.search input::placeholder{color:#6e6e86}
.search input:focus{border-color:var(--purple);outline:none;box-shadow:0 0 0 3px rgba(139,92,246,.25)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(min(100%,19rem),1fr));gap:1.4rem}
.card{display:flex;flex-direction:column;background:var(--surface);border:1px solid var(--line);border-radius:var(--r);overflow:hidden;position:relative;transition:transform .3s,border-color .3s,box-shadow .3s}
.card:hover{transform:translateY(-6px);border-color:rgba(139,92,246,.6);box-shadow:0 24px 50px -24px rgba(139,92,246,.5)}
.card[hidden]{display:none}
.card-media{aspect-ratio:16/10;background:var(--surface-2);overflow:hidden;position:relative}
.card-media img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.card:hover .card-media img{transform:scale(1.05)}
.card-ph{position:absolute;inset:0;display:grid;place-items:center;font:700 2.2rem var(--mono);letter-spacing:-.04em;color:rgba(139,92,246,.55);
  background:repeating-linear-gradient(135deg,transparent 0 14px,rgba(255,255,255,.025) 14px 15px),linear-gradient(135deg,rgba(139,92,246,.14),rgba(59,130,246,.1))}
.card-body{display:flex;flex-direction:column;gap:.75rem;padding:1.4rem;flex:1}
.card-meta{display:flex;justify-content:space-between;gap:.5rem;font:.8rem var(--mono);color:var(--muted)}
.card-meta:empty{display:none}
.card-meta .ref{color:#b9a2fb}
.card h3{font-size:1.35rem;font-weight:600}
.module{font-size:.88rem;color:var(--muted)}
.module i{margin-right:.35rem;color:var(--blue)}
.desc{color:#b4b4c8;font-size:.97rem}
.tags{display:flex;flex-wrap:wrap;gap:.4rem}
.tags li{font:.76rem var(--mono);padding:.22rem .6rem;border-radius:6px;background:rgba(59,130,246,.12);color:#8fb8fb;border:1px solid rgba(59,130,246,.22)}
.actions{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:auto;padding-top:.6rem}
.empty{border:1px dashed #3a3a50;border-radius:var(--r);padding:3.5rem 1.5rem;text-align:center;display:grid;gap:.6rem;justify-items:center;background:rgba(255,255,255,.015)}
.empty i{font-size:1.8rem;color:var(--purple)}
.empty h3{font-size:1.4rem}
.empty p{color:var(--muted);max-width:30rem}
.empty[hidden]{display:none}
.live{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)}

/* ===== Timeline ===== */
.timeline{position:relative;display:grid;gap:2rem;padding-left:2.2rem;max-width:44rem}
.timeline::before{content:"";position:absolute;left:7px;top:6px;bottom:6px;width:2px;background:linear-gradient(var(--purple),var(--blue) 70%,transparent)}
.tl-item{position:relative}
.tl-item::before{content:"";position:absolute;left:-2.2rem;top:.45rem;width:16px;height:16px;border-radius:50%;background:var(--bg);border:3px solid var(--purple)}
.tl-item time,.tl-item .when{font:.85rem var(--mono);color:#b9a2fb}
.tl-item h3{font-size:1.35rem;margin:.25rem 0 .4rem}
.tl-item p{color:var(--muted)}

/* ===== Contact ===== */
.contact-box{border:1px solid var(--line);border-radius:18px;background:linear-gradient(135deg,rgba(139,92,246,.14),rgba(59,130,246,.07)) ,var(--surface);padding:clamp(2rem,6vw,4.5rem);display:grid;gap:1.6rem;justify-items:start}
.contact-box h2{font-size:clamp(2.2rem,6vw,4rem);max-width:15ch}
.contact-box p{color:#c0c0d4;max-width:36rem}
.contact-row{display:flex;flex-wrap:wrap;gap:.8rem}
.mail-txt{font:.9rem var(--mono);color:var(--muted);word-break:break-all}

/* ===== Footer ===== */
footer{border-top:1px solid var(--line);padding:2.5rem 0;position:relative}
footer::before{content:"";position:absolute;top:-1px;left:0;width:min(220px,40%);height:1px;background:var(--grad)}
.foot{display:flex;flex-wrap:wrap;gap:1.2rem 2rem;align-items:center;justify-content:space-between;color:var(--muted);font-size:.95rem}
.foot nav{display:flex;flex-wrap:wrap;gap:.3rem 1.2rem}
.foot a{text-decoration:none}.foot a:hover{color:var(--text)}
.foot code{font-family:var(--mono);color:var(--purple)}

/* ===== Reveal (single, restrained) ===== */
.js .reveal{opacity:0;transform:translateY(18px);transition:opacity .7s ease,transform .7s ease}
.js .reveal.in{opacity:1;transform:none}

/* ===== Responsive ===== */
@media (max-width:900px){
  .hero-grid,.about-grid{grid-template-columns:1fr}
  .hero{align-items:flex-start;padding-bottom:6rem}
  .burger{display:inline-flex}
  .nav-links{position:fixed;inset:var(--nav-h) 0 auto 0;flex-direction:column;align-items:stretch;gap:.25rem;padding:1rem 1.25rem 1.5rem;
    background:rgba(13,13,18,.96);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border-bottom:1px solid var(--line);
    transform:translateY(-8px);opacity:0;visibility:hidden;transition:opacity .25s,transform .25s,visibility .25s}
  .nav-links.open{opacity:1;transform:none;visibility:visible}
  .nav-links a{padding:.9rem 1rem;font-size:1.05rem}
  .nav-links .btn{margin:.5rem 0 0;justify-content:center}
  .nav{background:rgba(13,13,18,.78);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
}
@media (max-width:520px){
  body{font-size:1rem}
  .code{font-size:.78rem;min-height:17rem}
  .hero-cta .btn{flex:1 1 100%;justify-content:center}
  .scroll-hint{display:none}
}

/* ===== Reduced motion ===== */
@media (prefers-reduced-motion:reduce){
  html{scroll-behavior:auto}
  *,*::before,*::after{animation:none!important;transition-duration:.01ms!important}
  .js .reveal{opacity:1;transform:none}
}
</style>
</head>

<body>
<a class="skip" href="#main">Skip to content</a>

<!-- ============ NAVIGATION ============ -->
<header class="nav" id="nav">
  <div class="wrap">
    <a class="brand" href="#home" aria-label="Home">MY<span>.</span></a>
    <button class="burger" id="burger" aria-expanded="false" aria-controls="menu" aria-label="Open menu"><span></span></button>
    <nav class="nav-links" id="menu" aria-label="Main">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#skills">Skills</a>
      <a href="#workshops">Workshops</a>
      <a href="#projects">Projects</a>
      <a href="#contact">Contact</a>
      <?php if ($cv !== ''): ?><a class="btn btn-sm btn-ghost" <?= link_attrs($cv) ?> download><i class="fa-solid fa-download" aria-hidden="true"></i> CV</a><?php endif; ?>
    </nav>
  </div>
</header>

<main id="main">

<!-- ============ HERO ============ -->
<section class="hero" id="home" data-nav>
  <div class="wrap hero-grid">
    <div>
      <p class="hello">Hello, I'm</p>
      <h1>Mohamed <span class="grad">Yacine</span></h1>
      <p class="role">Digital Development Student &amp; Aspiring Full-Stack Developer</p>
      <p class="intro">I'm learning to transform ideas into functional, modern, and user-friendly web experiences through hands-on projects and continuous practice.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#workshops">Explore My Work</a>
        <a class="btn btn-ghost" href="#contact">Contact Me</a>
      </div>
    </div>

    <div class="editor" aria-label="Code editor showing code snippets">
      <div class="editor-bar">
        <span class="dot"></span><span class="dot"></span><span class="dot"></span>
        <div class="editor-tabs" role="tablist" aria-label="Code samples">
          <button role="tab" aria-selected="true" data-tab="0">student.php</button>
          <button role="tab" aria-selected="false" data-tab="1">card.css</button>
          <button role="tab" aria-selected="false" data-tab="2">app.js</button>
        </div>
      </div>
      <pre class="code" id="code" aria-live="off"></pre>
    </div>
  </div>
  <a class="scroll-hint" href="#about" aria-label="Scroll to About"><i></i>Scroll</a>
</section>

<!-- ============ ABOUT ============ -->
<section id="about" data-nav>
  <div class="wrap">
    <div class="sec-head reveal"><h2>About me</h2></div>
    <div class="about-grid">
      <div class="about-text reveal">
        <p>I'm a first-year Digital Development student at OFPPT in Morocco. My training is built around practical work: every workshop and TP is a chance to turn a concept into something that runs in the browser.</p>
        <p>I enjoy the problem-solving side of web development: breaking an assignment into small steps, testing, fixing, and improving until it works as intended. I'm building my foundations in HTML, CSS, JavaScript and PHP, and I want to grow into a full-stack developer.</p>
        <p>This portfolio is where I document that progress, one workshop at a time.</p>
      </div>
      <dl class="facts reveal">
        <div><dt>Studying</dt><dd>Digital Development</dd></div>
        <div><dt>School</dt><dd>OFPPT, Morocco</dd></div>
        <div><dt>Level</dt><dd>First year</dd></div>
        <div><dt>Focus</dt><dd>Web development, full-stack path</dd></div>
      </dl>
    </div>
  </div>
</section>

<!-- ============ SKILLS ============ -->
<section id="skills" data-nav>
  <div class="wrap">
    <div class="sec-head reveal">
      <h2>Skills</h2>
      <p>The technologies I'm studying and using in my workshops.</p>
    </div>
    <ul class="skills reveal">
      <?php foreach ($skills as [$label, $icon]): ?>
        <li class="skill"><i class="<?= e($icon) ?>" aria-hidden="true"></i><span><?= e($label) ?></span></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ============ WORKSHOPS & TP ============ -->
<section id="workshops" data-nav>
  <div class="wrap">
    <div class="sec-head reveal">
      <h2>Workshops &amp; TP</h2>
      <p>Every practical assignment from my training, with the finished work, code and documents when available.</p>
    </div>

    <?php
      $counts = array_fill_keys(array_keys($categories), 0);
      foreach ($workshops as $w) { $c = $w['category'] ?? 'other'; $counts[isset($categories[$c]) ? $c : 'other']++; }
    ?>
    <div class="toolbar reveal">
      <div class="chips" role="group" aria-label="Filter workshops by category">
        <button class="chip" type="button" data-filter="all" aria-pressed="true">All<small><?= count($workshops) ?></small></button>
        <?php foreach ($categories as $key => $label): ?>
          <button class="chip" type="button" data-filter="<?= e($key) ?>" aria-pressed="false"><?= e($label) ?><small><?= (int)$counts[$key] ?></small></button>
        <?php endforeach; ?>
      </div>
      <div class="search">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <input type="search" id="search" placeholder="Search title, module, technology…" aria-label="Search workshops" autocomplete="off">
      </div>
    </div>

    <div class="grid" id="ws-grid">
      <?php foreach ($workshops as $w) render_card($w, $categories, true); ?>
    </div>

    <div class="empty" id="ws-empty" <?= $workshops ? 'hidden' : '' ?>>
      <i class="fa-solid fa-flask" aria-hidden="true"></i>
      <?php if (!$workshops): ?>
        <h3>More workshops coming soon</h3>
        <p>Workshops and TP will appear here as I complete them during the year.</p>
      <?php else: ?>
        <h3>No workshops match</h3>
        <p>Try another keyword or select a different category.</p>
        <button class="btn btn-sm btn-ghost" type="button" id="reset">Clear filters</button>
      <?php endif; ?>
    </div>
    <p class="live" id="live" role="status" aria-live="polite"></p>
  </div>
</section>

<!-- ============ PROJECTS ============ -->
<section id="projects" data-nav>
  <div class="wrap">
    <div class="sec-head reveal">
      <h2>Personal projects</h2>
      <p>Things I build on my own, beyond the classroom.</p>
    </div>
    <?php if ($projects): ?>
      <div class="grid reveal"><?php foreach ($projects as $p) render_card($p, $categories, false); ?></div>
    <?php else: ?>
      <div class="empty reveal">
        <i class="fa-solid fa-code-branch" aria-hidden="true"></i>
        <h3>First project in progress</h3>
        <p>My personal projects will be listed here with their code and live demos once they're ready.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ============ LEARNING JOURNEY ============ -->
<section id="journey">
  <div class="wrap">
    <div class="sec-head reveal"><h2>Learning journey</h2></div>
    <ol class="timeline reveal" style="list-style:none;margin:0">
      <?php foreach ($milestones as $m): ?>
        <li class="tl-item">
          <span class="when"><?= e($m['when'] ?? '') ?></span>
          <h3><?= e($m['title'] ?? '') ?></h3>
          <p><?= e($m['text'] ?? '') ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ============ CONTACT ============ -->
<section id="contact" data-nav>
  <div class="wrap">
    <div class="contact-box reveal">
      <h2>Let's connect</h2>
      <p>I'm open to talking about projects, internships and opportunities. Send me an email and I'll get back to you.</p>
      <div class="contact-row">
        <a class="btn btn-primary" href="mailto:<?= e($site['email']) ?>"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Send an email</a>
        <?php if ($github !== ''): ?><a class="btn btn-ghost" <?= link_attrs($github) ?>><i class="fa-brands fa-github" aria-hidden="true"></i> GitHub</a><?php endif; ?>
        <?php if ($linkedin !== ''): ?><a class="btn btn-ghost" <?= link_attrs($linkedin) ?>><i class="fa-brands fa-linkedin" aria-hidden="true"></i> LinkedIn</a><?php endif; ?>
      </div>
      <span class="mail-txt"><?= e($site['email']) ?></span>
    </div>
  </div>
</section>

</main>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="wrap foot">
    <span>&copy; <?= date('Y') ?> <?= e($site['name']) ?></span>
    <nav aria-label="Footer">
      <a href="#home">Home</a><a href="#about">About</a><a href="#workshops">Workshops</a><a href="#projects">Projects</a><a href="#contact">Contact</a>
    </nav>
    <span>Built with <code>PHP</code> + vanilla JS</span>
  </div>
</footer>

<script>
(function () {
  'use strict';
  var doc = document.documentElement;
  doc.classList.add('js');
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Nav: scrolled state + mobile menu ---------- */
  var nav = document.getElementById('nav'), burger = document.getElementById('burger'), menu = document.getElementById('menu');
  function onScroll() { nav.classList.toggle('scrolled', window.scrollY > 10); }
  onScroll(); window.addEventListener('scroll', onScroll, { passive: true });

  function setMenu(open) {
    menu.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open);
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  }
  burger.addEventListener('click', function () { setMenu(!menu.classList.contains('open')); });
  menu.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && menu.classList.contains('open')) { setMenu(false); burger.focus(); } });
  window.addEventListener('resize', function () { if (window.innerWidth > 900) setMenu(false); });

  /* ---------- Active nav link on scroll ---------- */
  var links = menu.querySelectorAll('a[href^="#"]');
  var sections = document.querySelectorAll('section[data-nav]');
  function setActive() {
    var y = window.scrollY + window.innerHeight * 0.35, current = '';
    sections.forEach(function (s) { if (s.offsetTop <= y) current = s.id; });
    links.forEach(function (a) { a.classList.toggle('active', a.getAttribute('href') === '#' + current); });
  }
  setActive(); window.addEventListener('scroll', setActive, { passive: true });

  /* ---------- Scroll reveal ---------- */
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && !reduce) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
    }, { threshold: 0.12 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else { revealEls.forEach(function (el) { el.classList.add('in'); }); }

  /* ---------- Hero editor: real snippets, typed once ---------- */
  var snippets = [
    '<span class="k">&lt;?php</span>\n\n<span class="c">// student.php</span>\n<span class="t">$student</span> = [\n  <span class="s">\'name\'</span>   =&gt; <span class="s">\'Mohamed Yacine\'</span>,\n  <span class="s">\'school\'</span> =&gt; <span class="s">\'OFPPT, Morocco\'</span>,\n  <span class="s">\'track\'</span>  =&gt; <span class="s">\'Digital Development\'</span>,\n  <span class="s">\'goal\'</span>   =&gt; <span class="s">\'Full-Stack Developer\'</span>,\n];\n\n<span class="k">echo</span> <span class="f">htmlspecialchars</span>(<span class="t">$student</span>[<span class="s">\'name\'</span>]);',
    '<span class="c">/* card.css */</span>\n<span class="f">.card</span> {\n  <span class="t">border</span>: 1px solid <span class="s">#2a2a38</span>;\n  <span class="t">border-radius</span>: 12px;\n  <span class="t">transition</span>: transform .3s;\n}\n\n<span class="f">.card:hover</span> {\n  <span class="t">transform</span>: <span class="f">translateY</span>(-6px);\n  <span class="t">border-color</span>: <span class="s">#8b5cf6</span>;\n}',
    '<span class="c">// app.js</span>\n<span class="k">const</span> <span class="t">input</span> = document.<span class="f">querySelector</span>(<span class="s">\'#search\'</span>);\n\ninput.<span class="f">addEventListener</span>(<span class="s">\'input\'</span>, () =&gt; {\n  <span class="k">const</span> <span class="t">q</span> = input.value.<span class="f">toLowerCase</span>();\n  cards.<span class="f">forEach</span>(card =&gt; {\n    card.hidden = !card.dataset.search.<span class="f">includes</span>(q);\n  });\n});'
  ];
  var codeEl = document.getElementById('code'), tabs = document.querySelectorAll('.editor-tabs button'), typer = null;

  function strip(html) { var d = document.createElement('div'); d.innerHTML = html; return d.textContent.length; }
  function showTab(i, animate) {
    clearInterval(typer);
    tabs.forEach(function (t, n) { t.setAttribute('aria-selected', n === i); });
    var html = snippets[i];
    if (!animate || reduce) { codeEl.innerHTML = html; return; }
    // reveal progressively without breaking the highlighting tags
    var total = strip(html), shown = 0, tmp = document.createElement('div');
    typer = setInterval(function () {
      shown += 3;
      if (shown >= total) { clearInterval(typer); codeEl.innerHTML = html + '<span class="caret"></span>'; return; }
      codeEl.innerHTML = truncateHtml(html, shown) + '<span class="caret"></span>';
    }, 16);
  }
  function truncateHtml(html, n) {
    var out = '', count = 0, i = 0, open = [];
    while (i < html.length && count < n) {
      if (html[i] === '<') {
        var end = html.indexOf('>', i), tag = html.slice(i, end + 1);
        if (tag.indexOf('</') === 0) open.pop(); else open.push(tag);
        out += tag; i = end + 1;
      } else if (html[i] === '&') {
        var semi = html.indexOf(';', i); out += html.slice(i, semi + 1); i = semi + 1; count++;
      } else { out += html[i]; i++; count++; }
    }
    return out + open.map(function () { return '</span>'; }).join('');
  }
  tabs.forEach(function (t, n) { t.addEventListener('click', function () { showTab(n, true); }); });
  showTab(0, true);

  /* ---------- Workshops: filter + search (no reload) ---------- */
  var grid = document.getElementById('ws-grid');
  if (grid) {
    var cards = Array.prototype.slice.call(grid.querySelectorAll('.card'));
    var chips = document.querySelectorAll('.chip');
    var search = document.getElementById('search');
    var empty = document.getElementById('ws-empty');
    var live = document.getElementById('live');
    var resetBtn = document.getElementById('reset');
    var state = { cat: 'all', q: '' };

    function apply() {
      var visible = 0;
      cards.forEach(function (c) {
        var ok = (state.cat === 'all' || c.dataset.cat === state.cat) && (state.q === '' || c.dataset.search.indexOf(state.q) !== -1);
        c.hidden = !ok; if (ok) visible++;
      });
      if (cards.length) empty.hidden = visible > 0;
      live.textContent = cards.length ? visible + (visible === 1 ? ' workshop shown' : ' workshops shown') : '';
    }
    chips.forEach(function (chip) {
      chip.addEventListener('click', function () {
        state.cat = chip.dataset.filter;
        chips.forEach(function (c) { c.setAttribute('aria-pressed', c === chip); });
        apply();
      });
    });
    search.addEventListener('input', function () { state.q = search.value.trim().toLowerCase(); apply(); });
    if (resetBtn) resetBtn.addEventListener('click', function () {
      state = { cat: 'all', q: '' }; search.value = '';
      chips.forEach(function (c) { c.setAttribute('aria-pressed', c.dataset.filter === 'all'); });
      apply(); search.focus();
    });
  }
})();
</script>
</body>
</html>