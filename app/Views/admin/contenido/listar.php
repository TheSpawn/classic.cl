<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($contenidos) ?> registro(s)</span>
    <a href="/contenido/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Contenido
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Seccion</th>
                    <th>Clave</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contenidos as $con): ?>
                <tr>
                    <td><span class="badge bg-dark"><?= esc($con['con_seccion']) ?></span></td>
                    <td><code><?= esc($con['con_clave']) ?></code></td>
                    <td><span class="badge bg-light text-dark"><?= $con['con_tipo'] ?></span></td>
                    <td class="text-muted"><?= esc(mb_strimwidth($con['con_valor'] ?? '', 0, 80, '...')) ?></td>
                    <td>
                        <a href="/contenido/editar/<?= $con['con_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/contenido/eliminar/<?= $con['con_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar contenido <?= esc($con['con_seccion'] . '.' . $con['con_clave']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($contenidos)): ?>
                <tr><td colspan="5" class="text-center text-muted py-4">No hay contenido.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
