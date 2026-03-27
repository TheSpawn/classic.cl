<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($galerias) ?> galeria(s)</span>
    <a href="/galeria/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nueva Galeria
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Orden</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th width="160">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($galerias as $gal): ?>
                <tr>
                    <td class="text-center text-muted"><?= $gal['gal_orden'] ?></td>
                    <td class="fw-semibold"><?= esc($gal['gal_titulo']) ?></td>
                    <td class="text-muted"><?= esc(mb_strimwidth($gal['gal_descripcion'] ?? '', 0, 60, '...')) ?></td>
                    <td>
                        <span class="badge <?= $gal['gal_activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $gal['gal_activo'] ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </td>
                    <td>
                        <a href="/galeria/<?= $gal['gal_id'] ?>/imagenes" class="btn btn-sm btn-outline-success" title="Imagenes">
                            <i class="bi bi-images"></i>
                        </a>
                        <a href="/galeria/editar/<?= $gal['gal_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/galeria/eliminar/<?= $gal['gal_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar galeria <?= esc($gal['gal_titulo']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($galerias)): ?>
                <tr><td colspan="5" class="text-center text-muted py-4">No hay galerias.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
