<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($partners) ?> partner(s)</span>
    <a href="/partners/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Partner
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Orden</th>
                    <th width="60">Logo</th>
                    <th>Nombre</th>
                    <th>URL</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partners as $par): ?>
                <tr>
                    <td class="text-center text-muted"><?= $par['par_orden'] ?></td>
                    <td>
                        <?php if ($par['par_logo']): ?>
                            <img src="<?= esc($par['par_logo']) ?>" alt="" style="max-height:30px;">
                        <?php else: ?>
                            <i class="bi bi-building text-muted"></i>
                        <?php endif; ?>
                    </td>
                    <td class="fw-semibold"><?= esc($par['par_nombre']) ?></td>
                    <td class="text-muted"><?= esc($par['par_url'] ?? '—') ?></td>
                    <td>
                        <span class="badge <?= $par['par_activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $par['par_activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="/partners/editar/<?= $par['par_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/partners/eliminar/<?= $par['par_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar partner <?= esc($par['par_nombre']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($partners)): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">No hay partners.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
