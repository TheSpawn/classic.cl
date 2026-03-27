<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php $sitioActivo = session()->get('sitio_activo'); ?>

<?php if (! $sitioActivo): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Selecciona un sitio desde el menu lateral para comenzar a gestionar contenido.
    </div>
<?php else: ?>
    <div class="row g-3">
        <?php
        $tarjetas = [
            ['Eventos', $contadores['eventos'] ?? 0, 'bi-calendar-event', 'primary', '/eventos'],
            ['Galerias', $contadores['galerias'] ?? 0, 'bi-images', 'success', '/galeria'],
            ['Alianzas', $contadores['alianzas'] ?? 0, 'bi-globe2', 'info', '/alianzas'],
            ['Documentos', $contadores['documentos'] ?? 0, 'bi-file-earmark-pdf', 'danger', '/documentos'],
            ['Partners', $contadores['partners'] ?? 0, 'bi-building', 'warning', '/partners'],
            ['Precios', $contadores['precios'] ?? 0, 'bi-currency-dollar', 'secondary', '/precios'],
            ['Hitos', $contadores['hitos'] ?? 0, 'bi-clock-history', 'dark', '/hitos'],
        ];
        ?>
        <?php foreach ($tarjetas as [$titulo, $cantidad, $icono, $color, $link]): ?>
        <div class="col-sm-6 col-lg-3">
            <a href="<?= $link ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-<?= $color ?> bg-opacity-10 p-3">
                            <i class="bi <?= $icono ?> fs-3 text-<?= $color ?>"></i>
                        </div>
                        <div>
                            <div class="fs-3 fw-bold"><?= $cantidad ?></div>
                            <div class="text-muted small"><?= $titulo ?></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
