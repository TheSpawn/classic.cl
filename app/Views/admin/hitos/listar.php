<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($hitos) ?> hito(s)</span>
    <a href="/hitos/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Hito
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Orden</th>
                    <th width="80">Anio</th>
                    <th>Titulo</th>
                    <th>Icono</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hitos as $hit): ?>
                <tr>
                    <td class="text-center text-muted"><?= $hit['hit_orden'] ?></td>
                    <td class="fw-bold"><?= $hit['hit_anio'] ?></td>
                    <td class="fw-semibold"><?= esc($hit['hit_titulo']) ?></td>
                    <td>
                        <?php if ($hit['hit_icono']): ?>
                            <i class="<?= esc($hit['hit_icono']) ?>"></i>
                            <small class="text-muted"><?= esc($hit['hit_icono']) ?></small>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge <?= $hit['hit_activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $hit['hit_activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="/hitos/editar/<?= $hit['hit_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/hitos/eliminar/<?= $hit['hit_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar hito <?= esc($hit['hit_titulo']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($hitos)): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">No hay hitos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
