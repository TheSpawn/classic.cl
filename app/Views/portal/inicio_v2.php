<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Producciones — Eventos que crean experiencias</title>
    <meta name="description" content="Organizamos, producimos e implementamos eventos competitivos, recreativos y de formacion. 20 anos creando experiencias unicas en Chile.">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/favicon/android-icon-192x192.png">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #D4A017;
            --gold-light: #E8B730;
            --gold-gradient: linear-gradient(135deg, #D4A017 0%, #E8B730 50%, #D4A017 100%);
            --black: #0a0a0a;
            --black-soft: #111;
            --black-card: #161616;
            --gray: #777;
            --gray-light: #aaa;
            --white: #fff;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',system-ui,sans-serif; background:var(--black); color:var(--white); overflow-x:hidden; }
        img { display:block; max-width:100%; }

        /* ── Navbar ── */
        .nav { position:fixed; top:0; left:0; right:0; z-index:100; padding:1.2rem 0; transition:all .4s; }
        .nav.scrolled { background:rgba(10,10,10,.92); backdrop-filter:blur(20px); padding:.7rem 0; border-bottom:1px solid rgba(255,255,255,.04); }
        .nav-inner { max-width:1280px; margin:0 auto; padding:0 2rem; display:flex; align-items:center; justify-content:space-between; }
        .nav-logo { height:36px; transition:height .3s; }
        .nav.scrolled .nav-logo { height:30px; }
        .nav-links { display:flex; gap:.5rem; align-items:center; }
        .nav-links a { color:rgba(255,255,255,.6); font-size:.8rem; font-weight:500; text-decoration:none; padding:.5rem .9rem; border-radius:6px; transition:all .2s; letter-spacing:.02em; }
        .nav-links a:hover { color:var(--white); background:rgba(255,255,255,.05); }
        .nav-cta { background:var(--gold-gradient)!important; color:var(--black)!important; font-weight:700!important; }
        .nav-cta:hover { box-shadow:0 0 20px rgba(212,160,23,.3); }

        /* ── Hero ── */
        .hero { height:100vh; position:relative; display:flex; align-items:center; overflow:hidden; }
        .hero-bg { position:absolute; inset:0; }
        .hero-bg img { width:100%; height:100%; object-fit:cover; }
        .hero-bg::after { content:''; position:absolute; inset:0; background:linear-gradient(to right, rgba(10,10,10,.95) 0%, rgba(10,10,10,.7) 40%, rgba(10,10,10,.3) 100%); }
        .hero-content { position:relative; z-index:2; max-width:1280px; margin:0 auto; padding:0 2rem; }
        .hero-badge { display:inline-flex; align-items:center; gap:.5rem; padding:.4rem 1rem; border:1px solid rgba(212,160,23,.3); border-radius:100px; font-size:.7rem; font-weight:700; color:var(--gold-light); letter-spacing:.15em; text-transform:uppercase; margin-bottom:1.5rem; background:rgba(212,160,23,.06); }
        .hero h1 { font-size:clamp(2.5rem,6vw,4.5rem); font-weight:900; line-height:1.05; margin-bottom:1.5rem; max-width:750px; }
        .hero h1 .gold { background:var(--gold-gradient); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .hero-sub { font-size:1.1rem; color:var(--gray-light); max-width:520px; line-height:1.7; margin-bottom:2.5rem; }
        .hero-btns { display:flex; gap:1rem; flex-wrap:wrap; }
        .btn-gold { display:inline-flex; align-items:center; gap:.5rem; padding:.9rem 2rem; background:var(--gold-gradient); color:var(--black); font-weight:700; font-size:.85rem; border-radius:8px; text-decoration:none; transition:all .3s; border:none; cursor:pointer; }
        .btn-gold:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(212,160,23,.25); }
        .btn-ghost { display:inline-flex; align-items:center; gap:.5rem; padding:.9rem 2rem; border:1.5px solid rgba(255,255,255,.15); color:var(--white); font-weight:600; font-size:.85rem; border-radius:8px; text-decoration:none; transition:all .3s; background:transparent; }
        .btn-ghost:hover { border-color:rgba(255,255,255,.3); background:rgba(255,255,255,.04); }
        .hero-scroll { position:absolute; bottom:2rem; left:50%; transform:translateX(-50%); z-index:2; color:rgba(255,255,255,.3); font-size:.7rem; text-transform:uppercase; letter-spacing:.2em; text-align:center; animation:bounce 2s infinite; }
        .hero-scroll i { display:block; font-size:1.2rem; margin-top:.3rem; }
        @keyframes bounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(8px)} }

        /* ── Stats ── */
        .stats { border-top:1px solid rgba(212,160,23,.1); border-bottom:1px solid rgba(212,160,23,.1); padding:3.5rem 0; background:var(--black-soft); }
        .stats-inner { max-width:1280px; margin:0 auto; padding:0 2rem; display:flex; justify-content:center; align-items:center; gap:4rem; flex-wrap:wrap; }
        .stat { text-align:center; }
        .stat-num { font-size:2.8rem; font-weight:900; background:var(--gold-gradient); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; line-height:1; }
        .stat-label { font-size:.7rem; text-transform:uppercase; letter-spacing:.12em; color:var(--gray); margin-top:.4rem; }
        .stat-div { width:1px; height:40px; background:rgba(255,255,255,.06); }

        /* ── Section base ── */
        .section { padding:7rem 0; }
        .section-inner { max-width:1280px; margin:0 auto; padding:0 2rem; }
        .section-tag { font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.15em; color:var(--gold); margin-bottom:.6rem; }
        .section-title { font-size:2.5rem; font-weight:900; line-height:1.1; margin-bottom:1rem; }
        .section-sub { color:var(--gray); max-width:520px; line-height:1.7; font-size:.95rem; }

        /* ── Showreel ── */
        .showreel { padding:5rem 0; overflow:hidden; background:var(--black-soft); border-top:1px solid rgba(255,255,255,.03); border-bottom:1px solid rgba(255,255,255,.03); }
        .showreel-track { display:flex; gap:1rem; animation:scrollGallery 40s linear infinite; width:max-content; }
        .showreel-track:hover { animation-play-state:paused; }
        .showreel-item { flex-shrink:0; width:350px; height:230px; border-radius:12px; overflow:hidden; }
        .showreel-item img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
        .showreel-item:hover img { transform:scale(1.08); }
        @keyframes scrollGallery { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }

        /* ── Servicios principales (3 pilares) ── */
        .pilares-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:2rem; margin-top:3rem; }
        .pilar-card { position:relative; border-radius:16px; overflow:hidden; height:420px; }
        .pilar-card img { width:100%; height:100%; object-fit:cover; transition:transform .6s; }
        .pilar-card:hover img { transform:scale(1.05); }
        .pilar-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(10,10,10,.95) 0%, rgba(10,10,10,.4) 50%, rgba(10,10,10,.2) 100%); display:flex; flex-direction:column; justify-content:flex-end; padding:2rem; }
        .pilar-overlay .pilar-icon { font-size:1.5rem; color:var(--gold); margin-bottom:.6rem; }
        .pilar-overlay h3 { font-size:1.3rem; font-weight:800; margin-bottom:.5rem; }
        .pilar-overlay p { color:var(--gray-light); font-size:.8rem; line-height:1.6; }

        /* ── Servicios grid ── */
        .srv-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem; margin-top:3rem; }
        .srv-card { padding:2rem; background:var(--black-card); border:1px solid rgba(255,255,255,.04); border-radius:14px; transition:border-color .3s; }
        .srv-card:hover { border-color:rgba(212,160,23,.12); }
        .srv-icon { width:44px; height:44px; border-radius:10px; background:rgba(212,160,23,.08); display:flex; align-items:center; justify-content:center; color:var(--gold); font-size:1.2rem; margin-bottom:1.2rem; }
        .srv-card h5 { font-weight:700; font-size:.9rem; margin-bottom:.4rem; }
        .srv-card p { color:var(--gray); font-size:.8rem; line-height:1.6; }

        /* ── Marcas ── */
        .marcas-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1.5rem; margin-top:3rem; }
        .marca-card { background:var(--black-card); border:1px solid rgba(255,255,255,.05); border-radius:16px; padding:2.5rem 2rem; text-align:center; transition:all .4s; position:relative; overflow:hidden; }
        .marca-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--gold-gradient); transform:scaleX(0); transition:transform .4s; }
        .marca-card:hover { border-color:rgba(212,160,23,.15); transform:translateY(-4px); }
        .marca-card:hover::before { transform:scaleX(1); }
        .marca-card img { height:55px; object-fit:contain; margin:0 auto 1.5rem; }
        .marca-card h4 { font-weight:700; font-size:1rem; margin-bottom:.4rem; }
        .marca-card p { color:var(--gray); font-size:.8rem; line-height:1.6; }
        .marca-card .marca-link { display:inline-flex; align-items:center; gap:.3rem; color:var(--gold); font-size:.75rem; font-weight:600; text-decoration:none; margin-top:1rem; transition:gap .2s; }
        .marca-card .marca-link:hover { gap:.6rem; }

        /* ── Alianzas ── */
        .alianzas-logos { display:flex; align-items:center; justify-content:center; gap:3rem; flex-wrap:wrap; margin-top:3rem; opacity:.5; transition:opacity .3s; }
        .alianzas-logos:hover { opacity:.8; }
        .alianzas-logos img { height:40px; object-fit:contain; filter:brightness(0) invert(1); transition:filter .3s; }
        .alianzas-logos img:hover { filter:none; }

        /* ── Testimonial ── */
        .testimonial { padding:6rem 0; text-align:center; background:var(--black-soft); border-top:1px solid rgba(255,255,255,.03); border-bottom:1px solid rgba(255,255,255,.03); }
        .testimonial-quote { font-size:clamp(1.5rem,3.5vw,2.8rem); font-weight:800; line-height:1.2; max-width:900px; margin:0 auto 1.5rem; }
        .testimonial-quote .gold { background:var(--gold-gradient); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .testimonial-sub { color:var(--gray); font-size:.9rem; }

        /* ── Contacto ── */
        .contacto-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:2rem; margin-top:3rem; }
        .contacto-item { display:flex; gap:1rem; align-items:flex-start; }
        .contacto-item i { font-size:1.2rem; color:var(--gold); width:44px; height:44px; background:rgba(212,160,23,.06); border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .contacto-item strong { font-size:.8rem; color:rgba(255,255,255,.8); display:block; margin-bottom:.2rem; }
        .contacto-item p { color:var(--gray); font-size:.85rem; margin:0; }

        /* ── Footer ── */
        .footer { border-top:1px solid rgba(255,255,255,.05); padding:2rem 0; }
        .footer-inner { max-width:1280px; margin:0 auto; padding:0 2rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; }
        .footer-copy { color:rgba(255,255,255,.3); font-size:.75rem; }
        .footer-logo { height:24px; opacity:.4; }
        .social-links { display:flex; gap:.5rem; }
        .social-link { width:34px; height:34px; border-radius:8px; border:1px solid rgba(255,255,255,.06); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,.35); font-size:.9rem; text-decoration:none; transition:all .2s; }
        .social-link:hover { border-color:var(--gold); color:var(--gold); }

        @media(max-width:768px) {
            .nav-links { display:none; }
            .hero h1 { font-size:2.2rem; }
            .stats-inner { gap:2rem; }
            .stat-div { display:none; }
            .pilares-grid { grid-template-columns:1fr; }
            .pilar-card { height:300px; }
            .contacto-grid { grid-template-columns:1fr; }
            .section { padding:4rem 0; }
            .showreel-item { width:280px; height:180px; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="nav" id="navbar">
    <div class="nav-inner">
        <a href="/"><img src="/assets/img/ClassicEventosLogoBlanco.webp" alt="Classic Producciones" class="nav-logo"></a>
        <div class="nav-links">
            <a href="#servicios">Que hacemos</a>
            <a href="#marcas">Marcas</a>
            <a href="#plataformas">Plataformas</a>
            <a href="#alianzas">Alianzas</a>
            <a href="#contacto" class="nav-cta">Contacto</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-bg">
        <img src="/assets/img/recursos/50.webp" alt="Evento Classic Producciones">
    </div>
    <div class="hero-content">
        <div class="hero-badge"><i class="bi bi-star-fill"></i> Productora de eventos deportivos</div>
        <h1>Creamos <span class="gold">experiencias</span> que transforman el deporte</h1>
        <p class="hero-sub">Organizamos, producimos e implementamos eventos competitivos, recreativos y de formacion. 20 anos entregando experiencias unicas en Chile y el mundo.</p>
        <div class="hero-btns">
            <a href="#servicios" class="btn-gold">Que hacemos <i class="bi bi-arrow-right"></i></a>
            <a href="#contacto" class="btn-ghost">Trabajemos juntos</a>
        </div>
    </div>
    <div class="hero-scroll">Scroll<i class="bi bi-chevron-down"></i></div>
</section>

<!-- Stats -->
<section class="stats">
    <div class="stats-inner">
        <div class="stat"><div class="stat-num">20+</div><div class="stat-label">Anos produciendo eventos</div></div>
        <div class="stat-div"></div>
        <div class="stat"><div class="stat-num">50+</div><div class="stat-label">Eventos producidos</div></div>
        <div class="stat-div"></div>
        <div class="stat"><div class="stat-num">10K+</div><div class="stat-label">Participantes por temporada</div></div>
        <div class="stat-div"></div>
        <div class="stat"><div class="stat-num">6</div><div class="stat-label">Alianzas internacionales</div></div>
    </div>
</section>

<!-- Que hacemos — 3 pilares -->
<section class="section" id="servicios" style="background:var(--black-soft);">
    <div class="section-inner">
        <div class="section-tag">Que hacemos</div>
        <h2 class="section-title">Organizamos. Producimos.<br>Implementamos.</h2>
        <p class="section-sub">Nos especializamos en tres tipos de eventos deportivos, cada uno disenado para entregar una experiencia unica a participantes, publico y sponsors.</p>

        <div class="pilares-grid">
            <div class="pilar-card">
                <img src="/assets/img/recursos/40.webp" alt="Eventos competitivos" loading="lazy">
                <div class="pilar-overlay">
                    <i class="bi bi-trophy-fill pilar-icon"></i>
                    <h3>Eventos Competitivos</h3>
                    <p>Campeonatos nacionales e internacionales con normativa IASF, escenarios profesionales, scoring en tiempo real y clasificacion a circuitos mundiales.</p>
                </div>
            </div>
            <div class="pilar-card">
                <img src="/assets/img/recursos/15.webp" alt="Eventos recreativos" loading="lazy">
                <div class="pilar-overlay">
                    <i class="bi bi-people-fill pilar-icon"></i>
                    <h3>Eventos Recreativos</h3>
                    <p>Experiencias que unen a la comunidad deportiva. Exhibiciones, encuentros, festivales y celebraciones que generan conexion y cultura.</p>
                </div>
            </div>
            <div class="pilar-card">
                <img src="/assets/img/recursos/10.webp" alt="Eventos de formacion" loading="lazy">
                <div class="pilar-overlay">
                    <i class="bi bi-mortarboard-fill pilar-icon"></i>
                    <h3>Eventos de Formacion</h3>
                    <p>Clinicas, cursos y certificaciones para entrenadores, jueces y atletas. Formacion con estandares internacionales y profesionales de primer nivel.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Showreel -->
<section class="showreel">
    <div class="showreel-track">
        <?php
        $fotos = [1,3,5,8,15,20,25,30,40,42,45,50,55,58,60,64];
        foreach (array_merge($fotos, $fotos) as $n):
        ?>
        <div class="showreel-item">
            <img src="/assets/img/recursos/<?= $n ?>.webp" alt="Classic Eventos" loading="lazy">
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Marcas -->
<section class="section" id="marcas">
    <div class="section-inner">
        <div class="section-tag">Nuestras marcas</div>
        <h2 class="section-title">Un ecosistema de eventos</h2>
        <p class="section-sub">Cada marca es un formato unico de evento con su propia identidad, comunidad y experiencia.</p>

        <div class="marcas-grid">
            <?php
            $marcasInfo = [
                'cheerleader' => ['nombre'=>'CheerleaderClassic', 'desc'=>'Campeonatos de Cheerleading con estandar IASF/USASF. El evento insignia del ecosistema.'],
                'dance'       => ['nombre'=>'DanceClassic', 'desc'=>'Competencias de Dance en todas sus modalidades: Hip Hop, Jazz, Pom, Contemporary.'],
                'gym'         => ['nombre'=>'GymClassic', 'desc'=>'El primer gimnasio pensado exclusivamente para la practica de Cheerleading en Chile.'],
            ];
            foreach ($sitios as $sitio):
                $info = $marcasInfo[$sitio['sit_slug']] ?? null;
            ?>
            <div class="marca-card">
                <?php if (! empty($sitio['sit_logo'])): ?>
                <img src="/<?= esc($sitio['sit_logo']) ?>" alt="<?= esc($info['nombre'] ?? $sitio['sit_nombre']) ?>">
                <?php endif; ?>
                <h4><?= esc($info['nombre'] ?? $sitio['sit_nombre']) ?></h4>
                <p><?= $info['desc'] ?? '' ?></p>
                <a href="http://<?= esc($sitio['sit_dominio']) ?>" class="marca-link" target="_blank">Visitar sitio <i class="bi bi-arrow-right"></i></a>
            </div>
            <?php endforeach; ?>

            <div class="marca-card">
                <img src="/assets/img/LogoSuperNationals.webp" alt="Super Nationals">
                <h4>Super Nationals</h4>
                <p>El mega-evento anual que reune a los mejores equipos del pais en una jornada de nivel internacional.</p>
            </div>
            <div class="marca-card">
                <img src="/assets/img/gameday-classic-logo.webp" alt="Gameday Classic">
                <h4>Gameday Classic</h4>
                <p>Formato Gameday: espiritu, tradicion y energia en un evento que celebra la esencia del deporte.</p>
            </div>
            <div class="marca-card">
                <img src="/assets/img/classic-patagonia-logo.webp" alt="Classic Patagonia">
                <h4>Classic Patagonia</h4>
                <p>Eventos en el extremo sur de Chile. Una experiencia unica en el fin del mundo.</p>
            </div>
        </div>
    </div>
</section>

<!-- Plataformas -->
<section class="section" id="plataformas" style="background:var(--black-soft);">
    <div class="section-inner">
        <div class="section-tag">Plataformas</div>
        <h2 class="section-title">Tecnologia propia para cada evento</h2>
        <p class="section-sub">Desarrollamos nuestras propias herramientas para que cada evento funcione con precision, transparencia y profesionalismo.</p>

        <div class="srv-grid">
            <?php
            $plataformas = [
                ['bi-clipboard-data', 'Scoring Classic', 'Sistema de evaluacion y tabulacion en tiempo real. Jueces, puntajes y ranking al instante.'],
                ['bi-ticket-perforated', 'Tickets Classic', 'Plataforma propia de venta de entradas con control de acceso y reporteria.'],
                ['bi-person-badge', 'Mi Classic', 'Portal para entrenadores, atletas e instituciones. Inscripciones, historial y documentos.'],
                ['bi-mortarboard', 'Classic Education', 'Cursos y clinicas online y presenciales con certificacion oficial.'],
                ['bi-broadcast', 'Streaming', 'Transmision en vivo de cada evento para que nadie se pierda la experiencia.'],
                ['bi-graph-up-arrow', 'Gestion Integral', 'Logistica, produccion, sponsoring y gestion comercial de cada evento.'],
            ];
            foreach ($plataformas as [$ico,$tit,$desc]):
            ?>
            <div class="srv-card">
                <div class="srv-icon"><i class="bi <?= $ico ?>"></i></div>
                <h5><?= $tit ?></h5>
                <p><?= $desc ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Alianzas -->
<section class="section" id="alianzas">
    <div class="section-inner" style="text-align:center;">
        <div class="section-tag">Red internacional</div>
        <h2 class="section-title">Alianzas que abren puertas</h2>
        <p class="section-sub" style="margin:0 auto;">Trabajamos con las organizaciones mas importantes del mundo para ofrecer clasificaciones y oportunidades internacionales.</p>

        <div class="alianzas-logos">
            <?php
            $logos = [
                ['src'=>'/assets/img/recursos/iasf-logo.webp', 'alt'=>'IASF'],
                ['src'=>'/assets/img/recursos/usasf-logo.webp', 'alt'=>'USASF'],
                ['src'=>'/assets/img/recursos/summitcheer-logo.webp', 'alt'=>'The Summit'],
                ['src'=>'/assets/img/recursos/aia-logo.webp', 'alt'=>'AIA'],
                ['src'=>'/assets/img/recursos/jamfest-logo.webp', 'alt'=>'JAMfest'],
            ];
            foreach ($logos as $l):
            ?>
            <img src="<?= $l['src'] ?>" alt="<?= $l['alt'] ?>" title="<?= $l['alt'] ?>">
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonial -->
<section class="testimonial">
    <div style="max-width:1000px;margin:0 auto;padding:0 2rem;">
        <div class="testimonial-quote">Cada evento es una oportunidad para crear algo <span class="gold">inolvidable</span></div>
        <p class="testimonial-sub">Classic Producciones — 20 anos creando experiencias</p>
    </div>
</section>

<!-- Contacto -->
<section class="section" id="contacto">
    <div class="section-inner">
        <div class="section-tag">Contacto</div>
        <h2 class="section-title">Trabajemos juntos</h2>
        <p class="section-sub">¿Quieres producir un evento, ser sponsor o ser parte del ecosistema Classic?</p>

        <div class="contacto-grid">
            <div class="contacto-item">
                <i class="bi bi-geo-alt-fill"></i>
                <div><strong>Direccion</strong><p>Puma #1417, Recoleta<br>Santiago, Chile</p></div>
            </div>
            <div class="contacto-item">
                <i class="bi bi-envelope-fill"></i>
                <div><strong>Email</strong><p>contacto@classic.cl</p></div>
            </div>
            <div class="contacto-item">
                <i class="bi bi-telephone-fill"></i>
                <div><strong>Telefono</strong><p>+56 9 9249 2827</p></div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-inner">
        <img src="/assets/img/ClassicEventosLogoBlanco.webp" alt="Classic" class="footer-logo">
        <span class="footer-copy">&copy; <?= date('Y') ?> Classic Producciones</span>
        <div class="social-links">
            <a href="https://www.instagram.com/classic_producciones" class="social-link" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61577511881405" class="social-link" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.youtube.com/@classic_producciones" class="social-link" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>
    </div>
</footer>

<script>
const nav=document.getElementById('navbar');
window.addEventListener('scroll',()=>nav.classList.toggle('scrolled',window.scrollY>60));
document.querySelectorAll('a[href^="#"]').forEach(a=>{
    a.addEventListener('click',e=>{
        e.preventDefault();
        const t=document.querySelector(a.getAttribute('href'));
        if(t) t.scrollIntoView({behavior:'smooth',block:'start'});
    });
});
</script>
</body>
</html>
