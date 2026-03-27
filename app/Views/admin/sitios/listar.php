<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($sitios) ?> sitio(s)</span>
    <a href="/sitios/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Sitio
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Dominio</th>
                    <th>Email</th>
                    <th>Color</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sitios as $sitio): ?>
                <tr>
                    <td class="fw-semibold"><?= esc($sitio['sit_nombre']) ?></td>
                    <td><code><?= esc($sitio['sit_slug']) ?></code></td>
                    <td><?= esc($sitio['sit_dominio']) ?></td>
                    <td><?= esc($sitio['sit_email']) ?></td>
                    <td>
                        <span class="d-inline-block rounded-circle" style="width:20px;height:20px;background:<?= esc($sitio['sit_color_primario']) ?>"></span>
                    </td>
                    <td>
                        <?php if ($sitio['sit_activo']): ?>
                            <span class="badge bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/sitios/editar/<?= $sitio['sit_id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/sitios/eliminar/<?= $sitio['sit_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar el sitio <?= esc($sitio['sit_nombre']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($sitios)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No hay sitios registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
