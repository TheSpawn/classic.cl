<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($precios) ?> precio(s)</span>
    <a href="/precios/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Precio
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Evento</th>
                    <th>Tier</th>
                    <th>Monto</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php helper('cms'); ?>
                <?php foreach ($precios as $pre): ?>
                <tr>
                    <td>
                        <?php if (! empty($pre['eve_titulo'])): ?>
                            <span class="badge bg-dark"><?= esc($pre['eve_titulo']) ?></span>
                        <?php else: ?>
                            <span class="text-muted">— Sin evento —</span>
                        <?php endif; ?>
                    </td>
                    <td class="fw-semibold"><?= esc($pre['pre_nombre']) ?></td>
                    <td><?= formato_clp($pre['pre_monto']) ?> <?= esc($pre['pre_moneda']) ?></td>
                    <td><?= $pre['pre_fecha_inicio'] ? date('d/m/Y', strtotime($pre['pre_fecha_inicio'])) : '—' ?></td>
                    <td><?= $pre['pre_fecha_fin'] ? date('d/m/Y', strtotime($pre['pre_fecha_fin'])) : '—' ?></td>
                    <td>
                        <span class="badge <?= $pre['pre_activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $pre['pre_activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="/precios/editar/<?= $pre['pre_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/precios/eliminar/<?= $pre['pre_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar precio <?= esc($pre['pre_nombre']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($precios)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No hay precios.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
