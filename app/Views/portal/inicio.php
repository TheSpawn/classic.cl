<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Eventos — Productora de Eventos Deportivos</title>
    <meta name="description" content="Classic Eventos Limitada - 20 años liderando eventos de primer nivel en Chile.">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#0d0d0d">
    <meta name="msapplication-TileImage" content="/assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#0d0d0d">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #D4A017;
            --gold-light: #E8B730;
            --gold-dark: #B8860B;
            --gold-gradient: linear-gradient(135deg, #D4A017 0%, #E8B730 50%, #D4A017 100%);
            --black: #0d0d0d;
            --black-light: #1a1a1a;
            --black-card: #141414;
            --gray-dark: #2a2a2a;
            --gray: #888;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--white);
            background: var(--black);
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        .navbar-classic {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 1rem 0;
            background: transparent;
            transition: background .3s, padding .3s, box-shadow .3s;
        }
        .navbar-classic.scrolled {
            background: rgba(13,13,13,.95);
            backdrop-filter: blur(20px);
            padding: .6rem 0;
            box-shadow: 0 2px 30px rgba(0,0,0,.5);
        }
        .navbar-classic .nav-link {
            color: rgba(255,255,255,.7);
            font-size: .85rem;
            font-weight: 500;
            letter-spacing: .03em;
            padding: .5rem 1rem;
            transition: color .2s;
        }
        .navbar-classic .nav-link:hover { color: var(--gold-light); }
        .nav-logo { height: 40px; }
        .navbar-classic.scrolled .nav-logo { height: 34px; }

        /* ── Hero ── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: var(--black);
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 900px; height: 900px;
            background: radial-gradient(circle, rgba(212,160,23,.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: heroPulse 8s ease-in-out infinite;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -20%; left: -15%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(212,160,23,.05) 0%, transparent 60%);
            border-radius: 50%;
        }
        @keyframes heroPulse {
            0%, 100% { transform: scale(1); opacity: .6; }
            50% { transform: scale(1.1); opacity: 1; }
        }
        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(212,160,23,.1);
            border: 1px solid rgba(212,160,23,.25);
            border-radius: 100px;
            padding: .4rem 1.2rem;
            font-size: .8rem;
            font-weight: 600;
            color: var(--gold-light);
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        .hero-tag i { font-size: .7rem; }
        .hero h1 {
            font-size: clamp(2.8rem, 5.5vw, 4.5rem);
            font-weight: 900;
            line-height: 1.05;
            margin-bottom: 1.5rem;
        }
        .hero h1 .gold {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero .lead {
            font-size: 1.15rem;
            color: var(--gray);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 2rem;
        }
        .hero-logo {
            max-width: 420px;
            filter: drop-shadow(0 20px 60px rgba(212,160,23,.15));
        }

        /* ── Buttons ── */
        .btn-gold {
            background: var(--gold-gradient);
            color: var(--black);
            font-weight: 700;
            padding: .8rem 2rem;
            border-radius: 8px;
            border: none;
            font-size: .9rem;
            letter-spacing: .02em;
            transition: transform .2s, box-shadow .2s;
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(212,160,23,.3);
            color: var(--black);
        }
        .btn-outline-gold {
            border: 1.5px solid rgba(212,160,23,.4);
            color: var(--gold-light);
            font-weight: 600;
            padding: .8rem 2rem;
            border-radius: 8px;
            background: transparent;
            font-size: .9rem;
            transition: all .2s;
        }
        .btn-outline-gold:hover {
            background: rgba(212,160,23,.1);
            border-color: var(--gold);
            color: var(--gold-light);
        }

        /* ── Gold divider ── */
        .gold-divider {
            height: 3px;
            background: var(--gold-gradient);
            border: none;
            opacity: 1;
        }

        /* ── Stats ── */
        .stats-section {
            background: var(--black-light);
            border-top: 1px solid rgba(212,160,23,.1);
            border-bottom: 1px solid rgba(212,160,23,.1);
        }
        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--gray);
            margin-top: .25rem;
        }
        .stat-divider {
            width: 1px;
            height: 50px;
            background: rgba(255,255,255,.08);
            align-self: center;
        }

        /* ── Sections ── */
        section { padding: 6rem 0; }
        .section-tag {
            display: inline-block;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--gold);
            margin-bottom: .75rem;
        }
        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: .75rem;
        }
        .section-subtitle {
            color: var(--gray);
            max-width: 560px;
            line-height: 1.7;
        }

        /* ── Disciplinas ── */
        .disciplina-card {
            background: var(--black-card);
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            transition: all .3s;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .disciplina-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gold-gradient);
            opacity: 0;
            transition: opacity .3s;
        }
        .disciplina-card:hover {
            border-color: rgba(212,160,23,.2);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,.4);
        }
        .disciplina-card:hover::before { opacity: 1; }
        .disciplina-logo {
            height: 60px;
            margin-bottom: 1.5rem;
            object-fit: contain;
        }
        .disciplina-card h4 { font-weight: 700; font-size: 1.2rem; }
        .disciplina-card p { color: var(--gray); font-size: .9rem; line-height: 1.6; }
        .disciplina-link {
            color: var(--gold);
            font-weight: 600;
            font-size: .85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            transition: gap .2s;
        }
        .disciplina-link:hover { color: var(--gold-light); gap: .7rem; }

        /* ── Eventos/Marcas ── */
        .marca-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1.5rem;
        }
        .marca-card {
            background: var(--black-card);
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all .3s;
        }
        .marca-card:hover {
            border-color: rgba(212,160,23,.2);
            transform: translateY(-3px);
        }
        .marca-card img {
            height: 70px;
            object-fit: contain;
            margin-bottom: 1rem;
        }
        .marca-card span {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--gray);
        }

        /* ── Servicios ── */
        .servicio-card {
            background: var(--black-card);
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 14px;
            padding: 2rem;
            height: 100%;
            transition: all .3s;
        }
        .servicio-card:hover {
            border-color: rgba(212,160,23,.15);
        }
        .servicio-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            background: rgba(212,160,23,.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--gold);
            margin-bottom: 1.25rem;
        }
        .servicio-card h5 { font-weight: 700; font-size: 1rem; }
        .servicio-card p { color: var(--gray); font-size: .875rem; line-height: 1.6; }

        /* ── Contacto ── */
        .contacto-section { background: var(--black-light); }
        .contacto-item i {
            font-size: 1.3rem;
            color: var(--gold);
            width: 44px; height: 44px;
            background: rgba(212,160,23,.08);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .contacto-item strong { font-size: .85rem; color: rgba(255,255,255,.9); }
        .contacto-item p { color: var(--gray); font-size: .875rem; margin: 0; }

        /* ── Footer ── */
        .footer {
            border-top: 1px solid rgba(255,255,255,.06);
            padding: 2rem 0;
            color: rgba(255,255,255,.35);
            font-size: .8rem;
        }
        .footer a { color: rgba(255,255,255,.35); text-decoration: none; transition: color .2s; }
        .footer a:hover { color: var(--gold); }
        .social-link {
            width: 36px; height: 36px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,.08);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.4);
            font-size: 1rem;
            transition: all .2s;
        }
        .social-link:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(212,160,23,.05);
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.2rem; }
            .hero-logo { max-width: 280px; margin-top: 2rem; }
            .stat-divider { display: none; }
            section { padding: 4rem 0; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar-classic" id="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/">
            <img src="/assets/img/ClassicEventosLogoBlanco.webp" alt="Classic Eventos" class="nav-logo">
        </a>
        <div class="d-none d-md-flex align-items-center gap-1">
            <a href="#nosotros" class="nav-link">Nosotros</a>
            <a href="#marcas" class="nav-link">Marcas</a>
            <a href="#servicios" class="nav-link">Servicios</a>
            <a href="#contacto" class="nav-link">Contacto</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero" id="inicio">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-tag">
                    <i class="bi bi-star-fill"></i> 20 anos de excelencia
                </div>
                <h1>
                    Creando <span class="gold">experiencias</span><br>deportivas desde 2006
                </h1>
                <p class="lead">
                    Somos la productora lider en campeonatos de Cheerleading, Dance y Gimnasia en Chile. Mas de dos decadas formando atletas, construyendo comunidad y conectando con el mundo.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#marcas" class="btn-gold">
                        Nuestras marcas <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <a href="#contacto" class="btn-outline-gold">Contacto</a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="/assets/img/ClassicEventosLogoBlanco.webp" alt="Classic Eventos" class="hero-logo d-none d-lg-inline-block">
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-section py-5" id="nosotros">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 gap-md-5">
            <div class="text-center">
                <div class="stat-number">20+</div>
                <div class="stat-label">Anos de trayectoria</div>
            </div>
            <div class="stat-divider d-none d-md-block"></div>
            <div class="text-center">
                <div class="stat-number">50+</div>
                <div class="stat-label">Campeonatos realizados</div>
            </div>
            <div class="stat-divider d-none d-md-block"></div>
            <div class="text-center">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Atletas participantes</div>
            </div>
            <div class="stat-divider d-none d-md-block"></div>
            <div class="text-center">
                <div class="stat-number">6</div>
                <div class="stat-label">Alianzas internacionales</div>
            </div>
        </div>
    </div>
</section>

<!-- Marcas -->
<section id="marcas">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag">Nuestras Marcas</div>
            <h2 class="section-title">El ecosistema Classic</h2>
            <p class="section-subtitle mx-auto">Cada marca tiene su propia identidad, comunidad y proposito. Todas bajo el sello Classic.</p>
        </div>

        <?php
        $marcasSitios = [
            'cheerleader' => [
                'nombre' => 'CheerleaderClassic',
                'logo'   => '/assets/img/cheerleaderclassic_logo.webp',
                'desc'   => 'Campeonatos de Cheerleading con estandar IASF/USASF. Niveles 1 a 7, todas las divisiones School y All Star.',
            ],
            'dance' => [
                'nombre' => 'DanceClassic',
                'logo'   => '/assets/img/cheerleaderclassic_logo.webp',
                'desc'   => 'Competencias de Dance en todas sus modalidades: Hip Hop, Jazz, Pom, Contemporary y mas.',
            ],
            'gym' => [
                'nombre' => 'GymClassic',
                'logo'   => '/assets/img/cheerleaderclassic_logo.webp',
                'desc'   => 'El primer gimnasio pensado exclusivamente para la practica de Cheerleading en Chile.',
            ],
        ];
        ?>

        <!-- Marcas principales (sitios) -->
        <div class="row g-4 justify-content-center mb-5">
            <?php foreach ($sitios as $sitio):
                $slug = $sitio['sit_slug'];
                $info = $marcasSitios[$slug] ?? null;
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="disciplina-card">
                    <?php if (! empty($sitio['sit_logo'])): ?>
                    <img src="/<?= esc($sitio['sit_logo']) ?>" alt="<?= esc($info['nombre'] ?? $sitio['sit_nombre']) ?>" class="disciplina-logo">
                    <?php elseif ($info): ?>
                    <img src="<?= $info['logo'] ?>" alt="<?= esc($info['nombre']) ?>" class="disciplina-logo">
                    <?php endif; ?>
                    <h4><?= esc($info['nombre'] ?? $sitio['sit_nombre']) ?></h4>
                    <p><?= $info['desc'] ?? 'Eventos deportivos de primer nivel.' ?></p>
                    <a href="http://<?= esc($sitio['sit_dominio']) ?>" class="disciplina-link" target="_blank">
                        Visitar sitio <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <hr class="gold-divider mb-5" style="max-width:120px;margin-left:auto;margin-right:auto;">

        <!-- Marcas de eventos -->
        <div class="marca-grid">
            <?php
            $marcasEventos = [
                ['img' => '/assets/img/LogoSuperNationals.webp', 'name' => 'Super Nationals'],
                ['img' => '/assets/img/gameday-classic-logo.webp', 'name' => 'Gameday Classic'],
                ['img' => '/assets/img/classic-patagonia-logo.webp', 'name' => 'Classic Patagonia'],
            ];
            foreach ($marcasEventos as $marca):
            ?>
            <div class="marca-card">
                <img src="<?= $marca['img'] ?>" alt="<?= $marca['name'] ?>">
                <span><?= $marca['name'] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Servicios -->
<section id="servicios" style="background:var(--black-light);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag">Ecosistema</div>
            <h2 class="section-title">Más que campeonatos</h2>
            <p class="section-subtitle mx-auto">Un ecosistema completo de plataformas, servicios y alianzas para el deporte competitivo.</p>
        </div>
        <div class="row g-4">
            <?php
            $servicios = [
                ['bi-calendar-event', 'Campeonatos', 'Organizacion integral de campeonatos nacionales e internacionales con estandares IASF.'],
                ['bi-mortarboard', 'Classic Education', 'Cursos y clinicas para entrenadores, jueces y atletas con certificacion oficial.'],
                ['bi-ticket-perforated', 'Tickets Classic', 'Sistema propio de venta de entradas para todos los eventos del ecosistema.'],
                ['bi-clipboard-data', 'Scoring Classic', 'Plataforma de evaluacion y tabulacion en tiempo real para competencias.'],
                ['bi-globe2', 'Alianzas Internacionales', 'Conexion directa con The Cheerleading Worlds, The Summit, AIA y mas.'],
                ['bi-phone', 'Mi Classic', 'Portal digital para entrenadores, atletas e instituciones del ecosistema.'],
            ];
            ?>
            <?php foreach ($servicios as [$icono, $titulo, $desc]): ?>
            <div class="col-md-6 col-lg-4">
                <div class="servicio-card">
                    <div class="servicio-icon">
                        <i class="bi <?= $icono ?>"></i>
                    </div>
                    <h5><?= $titulo ?></h5>
                    <p class="mb-0"><?= $desc ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contacto -->
<section class="contacto-section" id="contacto">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <div class="section-tag">Contacto</div>
                    <h2 class="section-title">Hablemos</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="contacto-item d-flex gap-3 align-items-start">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <strong>Dirección</strong>
                                <p>Puma #1417, Recoleta<br>Santiago, Chile</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contacto-item d-flex gap-3 align-items-start">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <strong>Email</strong>
                                <p>contacto@classic.cl</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contacto-item d-flex gap-3 align-items-start">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <strong>Teléfono</strong>
                                <p>+56 9 9249 2827</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="/assets/img/ClassicEventosLogoBlanco.webp" alt="Classic Eventos" style="height:28px;opacity:.5;">
            </div>
            <div class="col-md-4 text-center my-2 my-md-0">
                &copy; <?= date('Y') ?> Classic Producciones
            </div>
            <div class="col-md-4 text-md-end d-flex justify-content-md-end justify-content-center gap-2">
                <a href="https://www.instagram.com/classiceventos" class="social-link"><i class="bi bi-instagram"></i></a>
                <a href="https://www.facebook.com/classiceventos" class="social-link"><i class="bi bi-facebook"></i></a>
                <a href="https://www.youtube.com/@classiceventos" class="social-link"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Navbar scroll effect
const nav = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault();
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
</body>
</html>
