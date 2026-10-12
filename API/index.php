
<?php
$name = "Yassin";
$role = "Web Developer";
$description = "I build modern, responsive and user-friendly websites.";
$email = "elmessarimohamedyacine@gmail.com";

$skills = ["HTML", "CSS", "JavaScript", "PHP", "Git", "GitHub"];

$projects = [
    [
        "title" => "My Portfolio",
        "description" => "A personal website to showcase my skills and projects.",
        "link" => "#"
    ],
    [
        "title" => "Project Two",
        "description" => "A responsive website built with modern web technologies.",
        "link" => "#"
    ],
    [
        "title" => "Project Three",
        "description" => "Another project I'm working on. Coming soon!",
        "link" => "#"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($name) ?> | Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b1120;
            color: #f1f5f9;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1100px, 90%);
            margin: auto;
        }

        header {
            padding: 22px 0;
            border-bottom: 1px solid #243047;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            color: #38bdf8;
        }

        nav ul {
            display: flex;
            gap: 24px;
            list-style: none;
        }

        nav a:hover {
            color: #38bdf8;
        }

        .hero {
            min-height: 75vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 80px 0;
        }

        .tag {
            color: #38bdf8;
            font-weight: bold;
            margin-bottom: 15px;
        }

        h1 {
            font-size: clamp(38px, 7vw, 68px);
            line-height: 1.15;
            margin-bottom: 20px;
        }

        h1 span {
            color: #38bdf8;
        }

        .hero p {
            color: #a9b7cc;
            max-width: 600px;
            font-size: 18px;
            margin-bottom: 28px;
        }

        .btn {
            display: inline-block;
            background: #38bdf8;
            color: #08111f;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            background: #7dd3fc;
            transform: translateY(-2px);
        }

        section {
            padding: 65px 0;
        }

        .section-title {
            font-size: 32px;
            margin-bottom: 25px;
        }

        .section-title span {
            color: #38bdf8;
        }

        .muted {
            color: #a9b7cc;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 25px;
        }

        .skill {
            background: #172238;
            border: 1px solid #2a3b56;
            padding: 10px 17px;
            border-radius: 8px;
        }

        .projects {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .project {
            background: #121c30;
            border: 1px solid #243047;
            border-radius: 12px;
            padding: 24px;
            transition: 0.2s;
        }

        .project:hover {
            border-color: #38bdf8;
            transform: translateY(-4px);
        }

        .project h3 {
            margin-bottom: 12px;
        }

        .project p {
            color: #a9b7cc;
            margin-bottom: 18px;
        }

        .project a {
            color: #38bdf8;
            font-weight: bold;
        }

        .contact-box {
            background: #121c30;
            border: 1px solid #243047;
            border-radius: 12px;
            padding: 30px;
        }

        footer {
            text-align: center;
            padding: 25px 0;
            border-top: 1px solid #243047;
            color: #a9b7cc;
        }

        @media (max-width: 700px) {
            nav {
                align-items: flex-start;
                flex-direction: column;
            }

            nav ul {
                flex-wrap: wrap;
                gap: 15px;
            }

            .projects {
                grid-template-columns: 1fr;
            }

            .hero {
                min-height: 65vh;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <nav>
            <a href="#home" class="logo"><?= htmlspecialchars($name) ?>.</a>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="container hero" id="home">
        <div class="tag">WELCOME TO MY PORTFOLIO</div>
        <h1>Hi, I'm <span><?= htmlspecialchars($name) ?></span><br>
            <?= htmlspecialchars($role) ?>.</h1>
        <p><?= htmlspecialchars($description) ?></p>
        <a class="btn" href="#projects">Explore My Work →</a>
    </section>

    <section id="about">
        <div class="container">
            <h2 class="section-title">About <span>Me</span></h2>
            <p class="muted">
                I'm a passionate web developer who enjoys creating websites
                and learning new technologies. I focus on clean design,
                responsive layouts and great user experiences.
            </p>
        </div>
    </section>

    <section id="skills">
        <div class="container">
            <h2 class="section-title">My <span>Skills</span></h2>
            <p class="muted">Technologies and tools I work with:</p>
            <div class="skills">
                <?php foreach ($skills as $skill): ?>
                    <div class="skill">
                        <?= htmlspecialchars($skill) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="projects">
        <div class="container">
            <h2 class="section-title">My <span>Projects</span></h2>
            <div class="projects">
                <?php foreach ($projects as $project): ?>
                    <article class="project">
                        <h3><?= htmlspecialchars($project["title"]) ?></h3>
                        <p><?= htmlspecialchars($project["description"]) ?></p>
                        <a href="<?= htmlspecialchars($project["link"]) ?>">
                            View Project →
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <h2 class="section-title">Contact <span>Me</span></h2>
            <div class="contact-box">
                <p class="muted">
                    Have a project or an opportunity? Feel free to contact me.
                </p>
                <br>
                <a class="btn"
                   href="mailto:<?= htmlspecialchars($email) ?>">
                    Send Me an Email
                </a>
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="container">
        © <?= date("Y") ?> <?= htmlspecialchars($name) ?>. All rights reserved.
    </div>
</footer>

</body>
</html>
