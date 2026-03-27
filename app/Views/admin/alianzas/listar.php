<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($alianzas) ?> alianza(s)</span>
    <a href="/alianzas/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nueva Alianza
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Orden</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Ubicacion</th>
                    <th>Fechas</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alianzas as $ali): ?>
                <tr>
                    <td class="text-center text-muted"><?= $ali['ali_orden'] ?></td>
                    <td class="fw-semibold"><?= esc($ali['ali_nombre']) ?></td>
                    <td>
                        <span class="badge <?= $ali['ali_tipo'] === 'PRINCIPAL' ? 'bg-primary' : 'bg-info' ?>">
                            <?= $ali['ali_tipo'] ?>
                        </span>
                    </td>
                    <td><?= esc($ali['ali_ubicacion'] ?? '—') ?></td>
                    <td><?= esc($ali['ali_fechas'] ?? '—') ?></td>
                    <td>
                        <span class="badge <?= $ali['ali_activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $ali['ali_activo'] ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </td>
                    <td>
                        <a href="/alianzas/editar/<?= $ali['ali_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/alianzas/eliminar/<?= $ali['ali_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar alianza <?= esc($ali['ali_nombre']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($alianzas)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No hay alianzas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
