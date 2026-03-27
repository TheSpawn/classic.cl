<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?? 'CMS' ?> — Classic CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1a1a2e;
            --sidebar-hover: #16213e;
        }
        [x-cloak] { display: none !important; }
        body { background: #f4f6f9; }

        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: #ccc;
            overflow-y: auto;
            z-index: 1000;
            transition: transform .3s;
        }
        .sidebar .brand {
            padding: 1.2rem 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: .55rem 1rem;
            font-size: .875rem;
            border-radius: 0;
            transition: all .15s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: var(--sidebar-hover);
        }
        .sidebar .nav-link i {
            width: 1.4rem;
            text-align: center;
            margin-right: .5rem;
        }
        .sidebar .nav-header {
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6c757d;
            padding: 1rem 1rem .3rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: .75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar h1 {
            font-size: 1.15rem;
            font-weight: 600;
            margin: 0;
        }
        .content-wrapper {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="brand">
        <i class="bi bi-grid-fill"></i> Classic CMS
    </div>

    <!-- Selector de sitio -->
    <?php $sitioActivo = session()->get('sitio_activo'); ?>
    <?php $sitiosUsuario = session()->get('sitios_usuario') ?? []; ?>
    <?php if (count($sitiosUsuario) > 0): ?>
    <div class="px-3 py-2 border-bottom border-dark">
        <form method="post" action="/cambiar-sitio">
            <?= csrf_field() ?>
            <select name="sit_id" class="form-select form-select-sm bg-dark text-light border-secondary"
                    onchange="this.form.submit()">
                <?php foreach ($sitiosUsuario as $s): ?>
                <option value="<?= $s['sit_id'] ?>" <?= ($sitioActivo && $sitioActivo['sit_id'] == $s['sit_id']) ? 'selected' : '' ?>>
                    <?= esc($s['sit_nombre']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <?php endif; ?>

    <div class="nav-header">Principal</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="/" class="nav-link <?= uri_string() === '' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
    </ul>

    <?php if ($sitioActivo): ?>
    <div class="nav-header">Contenido</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="/eventos" class="nav-link <?= str_starts_with(uri_string(), 'eventos') ? 'active' : '' ?>">
                <i class="bi bi-calendar-event"></i> Eventos
            </a>
        </li>
        <li class="nav-item">
            <a href="/galeria" class="nav-link <?= str_starts_with(uri_string(), 'galeria') ? 'active' : '' ?>">
                <i class="bi bi-images"></i> Galeria
            </a>
        </li>
        <li class="nav-item">
            <a href="/alianzas" class="nav-link <?= str_starts_with(uri_string(), 'alianzas') ? 'active' : '' ?>">
                <i class="bi bi-globe2"></i> Alianzas
            </a>
        </li>
        <li class="nav-item">
            <a href="/documentos" class="nav-link <?= str_starts_with(uri_string(), 'documentos') ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-pdf"></i> Documentos
            </a>
        </li>
        <li class="nav-item">
            <a href="/partners" class="nav-link <?= str_starts_with(uri_string(), 'partners') ? 'active' : '' ?>">
                <i class="bi bi-building"></i> Partners
            </a>
        </li>
        <li class="nav-item">
            <a href="/precios" class="nav-link <?= str_starts_with(uri_string(), 'precios') ? 'active' : '' ?>">
                <i class="bi bi-currency-dollar"></i> Precios
            </a>
        </li>
        <li class="nav-item">
            <a href="/contenido" class="nav-link <?= str_starts_with(uri_string(), 'contenido') ? 'active' : '' ?>">
                <i class="bi bi-text-paragraph"></i> Contenido
            </a>
        </li>
        <li class="nav-item">
            <a href="/hitos" class="nav-link <?= str_starts_with(uri_string(), 'hitos') ? 'active' : '' ?>">
                <i class="bi bi-clock-history"></i> Hitos
            </a>
        </li>
    </ul>
    <?php endif; ?>

    <div class="nav-header">Administracion</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="/sitios" class="nav-link <?= str_starts_with(uri_string(), 'sitios') ? 'active' : '' ?>">
                <i class="bi bi-diagram-3"></i> Sitios
            </a>
        </li>
        <?php if (session()->get('usu_rol') === 'SUPERADMIN'): ?>
        <li class="nav-item">
            <a href="/usuarios" class="nav-link <?= str_starts_with(uri_string(), 'usuarios') ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Usuarios
            </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a href="/perfil" class="nav-link <?= str_starts_with(uri_string(), 'perfil') ? 'active' : '' ?>">
                <i class="bi bi-person-gear"></i> Mi Perfil
            </a>
        </li>
    </ul>

    <div class="mt-auto p-3 border-top border-dark" style="position:absolute;bottom:0;width:100%;">
        <div class="d-flex align-items-center justify-content-between">
            <small class="text-muted">
                <i class="bi bi-person-circle"></i>
                <?= esc(session()->get('usu_nombre')) ?>
            </small>
            <a href="/logout" class="text-muted" title="Cerrar sesion"><i class="bi bi-box-arrow-right"></i></a>
        </div>
    </div>
</nav>

<!-- Main -->
<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
            <h1><?= $tituloPagina ?? 'Dashboard' ?></h1>
        </div>
        <div class="d-flex align-items-center gap-3">
            <?php if ($sitioActivo): ?>
            <span class="badge" style="background:<?= esc($sitioActivo['sit_color_primario']) ?>">
                <?= esc($sitioActivo['sit_nombre']) ?>
            </span>
            <?php endif; ?>
            <a href="/logout" class="btn btn-sm btn-outline-secondary" title="Cerrar sesion">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </div>

    <div class="content-wrapper">
        <!-- Flash messages -->
        <?php if (session()->getFlashdata('exito')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('exito') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('contenido') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Auto-cerrar alertas
    setTimeout(() => {
        document.querySelectorAll('.alert-dismissible').forEach(el => {
            bootstrap.Alert.getOrCreateInstance(el).close();
        });
    }, 4000);

    // Confirmar acciones destructivas
    document.querySelectorAll('[data-confirmar]').forEach(form => {
        form.addEventListener('submit', e => {
            if (!confirm(form.dataset.confirmar || '¿Estás seguro?')) {
                e.preventDefault();
            }
        });
    });
</script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
