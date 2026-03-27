<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($eventos) ?> evento(s)</span>
    <a href="/eventos/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Evento
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Orden</th>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th>Venue</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $eve): ?>
                <tr>
                    <td class="text-center text-muted"><?= $eve['eve_orden'] ?></td>
                    <td>
                        <div class="fw-semibold"><?= esc($eve['eve_titulo']) ?></div>
                        <small class="text-muted"><code><?= esc($eve['eve_slug']) ?></code></small>
                    </td>
                    <td><?= $eve['eve_fecha'] ? date('d/m/Y', strtotime($eve['eve_fecha'])) : '—' ?></td>
                    <td><?= esc($eve['eve_venue'] ?? '—') ?></td>
                    <td>
                        <?php
                        $estadoClass = match($eve['eve_estado']) {
                            'PRONTO'  => 'bg-warning text-dark',
                            'ABIERTO' => 'bg-success',
                            'CERRADO' => 'bg-secondary',
                            default   => 'bg-secondary',
                        };
                        ?>
                        <span class="badge <?= $estadoClass ?>"><?= $eve['eve_estado'] ?></span>
                    </td>
                    <td><?= esc($eve['eve_precio'] ?? '—') ?></td>
                    <td>
                        <a href="/eventos/editar/<?= $eve['eve_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/eventos/eliminar/<?= $eve['eve_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar el evento <?= esc($eve['eve_titulo']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($eventos)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No hay eventos registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (isset($pager)): ?>
<div class="mt-3"><?= $pager->links() ?></div>
<?php endif; ?>

<?= $this->endSection() ?>
