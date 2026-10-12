
<?php
$name = "Mohamed Yacine";
$role = "Full Stack Web Developer";
$email = "elmessarimohamedyacine@gmail.com";

$skills = [
    ["PHP", "php"],
    ["MySQL", "database"],
    ["HTML5", "code"],
    ["CSS3", "palette"],
    ["JavaScript", "javascript"],
    ["Git", "git"],
    ["GitHub", "github"]
];

$projects = [
    [
        "title" => "Personal Portfolio",
        "description" => "A modern portfolio to showcase my skills and experience.",
        "tag" => "PHP • HTML • CSS",
        "link" => "#contact"
    ],
    [
        "title" => "Task Manager",
        "description" => "A clean and responsive task management application.",
        "tag" => "PHP • MySQL",
        "link" => "#contact"
    ],
    [
        "title" => "E-commerce Website",
        "description" => "An online shopping experience with a modern interface.",
        "tag" => "PHP • MySQL • CSS",
        "link" => "#contact"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Official portfolio of Mohamed Yacine, Full Stack Web Developer.">
<title><?= htmlspecialchars($name) ?> | Developer</title>

<style>
:root {
    --bg: #050b18;
    --panel: #0a1528;
    --blue: #079cff;
    --cyan: #20d5ff;
    --text: #f4f8ff;
    --muted: #9bacc6;
    --border: rgba(55, 155, 255, .20);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    scroll-padding-top: 85px;
}

body {
    background: var(--bg);
    color: var(--text);
    font-family: Inter, "Segoe UI", Arial, sans-serif;
    line-height: 1.7;
}

a {
    color: inherit;
    text-decoration: none;
}

.container {
    width: min(1080px, 90%);
    margin: auto;
}

header {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(5, 11, 24, .92);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--border);
}

nav {
    min-height: 76px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.logo {
    font-size: 25px;
    font-weight: 800;
    letter-spacing: -.8px;
}

.logo span {
    color: var(--blue);
}

nav ul {
    display: flex;
    align-items: center;
    gap: 28px;
    list-style: none;
}

nav ul a {
    font-size: 14px;
    color: #d6e3f7;
    transition: color .2s;
}

nav ul a:hover,
.project-link:hover {
    color: var(--cyan);
}

.hero {
    min-height: 490px;
    display: grid;
    grid-template-columns: 1.15fr .85fr;
    align-items: center;
    gap: 45px;
    padding-top: 65px;
    padding-bottom: 65px;
}

.eyebrow {
    color: var(--cyan);
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 18px;
}

h1 {
    font-size: clamp(39px, 5.5vw, 66px);
    line-height: 1.12;
    letter-spacing: -2px;
    margin-bottom: 15px;
}

h1 span,
.section-title span {
    color: var(--blue);
}

.role {
    font-size: clamp(19px, 2.4vw, 25px);
    font-weight: 700;
    margin-bottom: 18px;
}

.hero-description,
.muted {
    color: var(--muted);
}

.hero-description {
    max-width: 490px;
    margin-bottom: 28px;
}

.actions {
    display: flex;
    flex-wrap: wrap;
    gap: 13px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 12px 20px;
    border: 1px solid var(--blue);
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
    transition: .25s;
}

.btn-primary {
    background: var(--blue);
    color: white;
    box-shadow: 0 0 25px rgba(7, 156, 255, .15);
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(7, 156, 255, .20);
}

.btn-outline {
    color: var(--text);
}

.profile {
    position: relative;
    display: grid;
    place-items: center;
    min-height: 310px;
}

.profile-ring {
    width: 255px;
    height: 255px;
    border: 2px solid var(--blue);
    border-radius: 50%;
    position: absolute;
    box-shadow: 0 0 35px rgba(0, 145, 255, .25),
                inset 0 0 35px rgba(0, 145, 255, .08);
    animation: glow 3s ease-in-out infinite alternate;
}

.profile-inner {
    width: 220px;
    height: 220px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: linear-gradient(145deg, #102c51, #07101f);
    border: 1px solid #1b8bff;
    z-index: 1;
}

.profile-initials {
    font-size: 76px;
    font-weight: 900;
    color: var(--cyan);
    text-shadow: 0 0 35px rgba(0, 156, 255, .55);
}

.code-note {
    position: absolute;
    right: -5px;
    top: 28px;
    color: var(--cyan);
    background: var(--panel);
    border: 1px solid var(--border);
    padding: 12px;
    border-radius: 8px;
    font: 12px monospace;
}

section {
    border-top: 1px solid rgba(55, 155, 255, .13);
    padding: 55px 0;
}

.section-title {
    font-size: 29px;
    line-height: 1.3;
    margin-bottom: 12px;
}

.section-subtitle {
    color: var(--muted);
    font-size: 14px;
    margin-bottom: 25px;
}

.about-grid {
    display: grid;
    grid-template-columns: 1.1fr .9fr;
    gap: 50px;
    align-items: center;
}

.about-copy {
    color: #b4c4dc;
}

.traits {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-top: 22px;
    color: var(--cyan);
    font-size: 13px;
}

.info-card,
.skill-card,
.project-card,
.contact-card {
    background: linear-gradient(145deg, #0a172b, #07101e);
    border: 1px solid var(--border);
    border-radius: 12px;
}

.info-card {
    padding: 22px;
}

.info-row {
    display: grid;
    grid-template-columns: 100px 1fr;
    gap: 12px;
    padding: 8px 0;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.info-row span:first-child {
    color: var(--cyan);
}

.skills-grid {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 13px;
}

.skill-card {
    min-height: 108px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: .25s;
}

.skill-card:hover,
.project-card:hover {
    transform: translateY(-4px);
    border-color: var(--blue);
}

.skill-icon {
    font-size: 27px;
    color: var(--cyan);
    font-weight: 800;
}

.skill-name {
    font-size: 12px;
    font-weight: 700;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
}

.project-card {
    padding: 23px;
    transition: .25s;
}

.project-number {
    color: var(--blue);
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 17px;
}

.project-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.project-card p {
    color: var(--muted);
    font-size: 13px;
    min-height: 65px;
    margin-bottom: 15px;
}

.project-tag {
    display: inline-block;
    color: var(--cyan);
    font-size: 11px;
    margin-bottom: 17px;
}

.project-link {
    display: block;
    color: var(--blue);
    font-size: 13px;
    font-weight: 700;
}

.contact-card {
    padding: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
}

.contact-card p {
    color: var(--muted);
    font-size: 14px;
}

footer {
    border-top: 1px solid var(--border);
    padding: 22px 0;
    color: var(--muted);
    font-size: 12px;
}

.footer-inner {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap;
}

footer span {
    color: var(--cyan);
}

@keyframes glow {
    from { box-shadow: 0 0 20px rgba(0,145,255,.18); }
    to { box-shadow: 0 0 45px rgba(0,145,255,.38); }
}

@media (max-width: 850px) {
    nav ul { gap: 15px; }
    .hero { gap: 15px; }
    .skills-grid { grid-template-columns: repeat(4, 1fr); }
    .projects-grid { grid-template-columns: repeat(2, 1fr); }
    .about-grid { gap: 25px; }
}

@media (max-width: 600px) {
    nav {
        padding: 15px 0;
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    nav ul {
        gap: 15px;
        flex-wrap: wrap;
    }

    nav ul a { font-size: 12px; }

    .hero {
        grid-template-columns: 1fr;
        padding-top: 50px;
    }

    .profile {
        min-height: 280px;
        grid-row: 1;
    }

    .profile-ring {
        width: 215px;
        height: 215px;
    }

    .profile-inner {
        width: 185px;
        height: 185px;
    }

    .profile-initials { font-size: 62px; }
    .code-note { right: 0; top: 0; }

    .about-grid,
    .projects-grid {
        grid-template-columns: 1fr;
    }

    .skills-grid { grid-template-columns: repeat(3, 1fr); }
    .section-title { font-size: 26px; }

    .contact-card {
        align-items: flex-start;
        flex-direction: column;
    }
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        scroll-behavior: auto !important;
        animation: none !important;
        transition: none !important;
    }
}
</style>
</head>

<body>
<header>
    <nav class="container">
        <a class="logo" href="#home"><span>MY</span></a>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="container hero" id="home">
        <div>
            <div class="eyebrow">Hello, I'm</div>
            <h1><?= htmlspecialchars($name) ?></h1>
            <div class="role"><?= htmlspecialchars($role) ?></div>

            <p class="hero-description">
                I build modern and responsive web applications using PHP,
                MySQL, HTML, CSS and JavaScript. I turn ideas into real solutions.
            </p>

            <div class="actions">
                <a class="btn btn-primary" href="#projects">View My Projects ↗</a>
                <a class="btn btn-outline" href="#contact">✉ Contact Me</a>
            </div>
        </div>

        <div class="profile">
            <div class="profile-ring"></div>
            <div class="profile-inner">
                <div class="profile-initials">MY</div>
            </div>
            <div class="code-note">&lt;?php<br>echo "Hello World!";</div>
        </div>
    </div>

    <section id="about">
        <div class="container about-grid">
            <div>
                <h2 class="section-title">About <span>Me</span></h2>
                <p class="about-copy">
                    I'm a passionate web developer interested in creating
                    efficient, attractive and user-friendly web applications.
                    I enjoy solving problems, learning new technologies and
                    improving my skills every day.
                </p>
                <div class="traits">
                    <span>✦ Problem Solver</span>
                    <span>✦ Fast Learner</span>
                    <span>✦ Team Player</span>
                </div>
            </div>

            <div class="info-card">
                <div class="info-row">
                    <span>Name</span>
                    <span><?= htmlspecialchars($name) ?></span>
                </div>
                <div class="info-row">
                    <span>Email</span>
                    <span><?= htmlspecialchars($email) ?></span>
                </div>
                <div class="info-row">
                    <span>Location</span>
                    <span>Morocco</span>
                </div>
                <div class="info-row">
                    <span>Freelance</span>
                    <span>Available for opportunities</span>
                </div>
            </div>
        </div>
    </section>

    <section id="skills">
        <div class="container">
            <h2 class="section-title">My <span>Skills</span></h2>
            <p class="section-subtitle">Technologies and tools I work with.</p>

            <div class="skills-grid">
                <?php foreach ($skills as $index => $skill): ?>
                    <div class="skill-card">
                        <div class="skill-icon">
                            <?php
                            $icons = ["PHP", "DB", "5", "3", "JS", "Git", "GH"];
                            echo htmlspecialchars($icons[$index]);
                            ?>
                        </div>
                        <div class="skill-name">
                            <?= htmlspecialchars($skill[0]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="projects">
        <div class="container">
            <h2 class="section-title">My <span>Projects</span></h2>
            <p class="section-subtitle">Some of my recent work.</p>

            <div class="projects-grid">
                <?php foreach ($projects as $index => $project): ?>
                    <article class="project-card">
                        <div class="project-number">
                            PROJECT 0<?= $index + 1 ?>
                        </div>
                        <h3><?= htmlspecialchars($project["title"]) ?></h3>
                        <p><?= htmlspecialchars($project["description"]) ?></p>
                        <div class="project-tag">
                            <?= htmlspecialchars($project["tag"]) ?>
                        </div>
                        <a class="project-link"
                           href="<?= htmlspecialchars($project["link"]) ?>">
                            View Project ↗
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container contact-card">
            <div>
                <h2 class="section-title">Get In <span>Touch</span></h2>
                <p>Have a project or opportunity? Let's talk.</p>
            </div>

            <a class="btn btn-primary"
               href="mailto:<?= htmlspecialchars($email) ?>">
                ✉ Send Me an Email
            </a>
        </div>
    </section>
</main>

<footer>
    <div class="container footer-inner">
        <div>© <?= date("Y") ?> <span><?= htmlspecialchars($name) ?></span>. All rights reserved.</div>
        <div>Designed with <span>♥</span> and PHP</div>
    </div>
</footer>
</body>
</html>
