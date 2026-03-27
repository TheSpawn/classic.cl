<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($usuarios) ?> usuario(s)</span>
    <a href="/usuarios/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Usuario
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usu): ?>
                <tr>
                    <td class="fw-semibold"><?= esc($usu['usu_nombre'] . ' ' . $usu['usu_apellido']) ?></td>
                    <td><?= esc($usu['usu_email']) ?></td>
                    <td>
                        <?php
                        $rolClass = match($usu['usu_rol']) {
                            'SUPERADMIN' => 'bg-danger',
                            'ADMIN'      => 'bg-primary',
                            'EDITOR'     => 'bg-info',
                            default      => 'bg-secondary',
                        };
                        ?>
                        <span class="badge <?= $rolClass ?>"><?= $usu['usu_rol'] ?></span>
                    </td>
                    <td>
                        <?php if ($usu['usu_activo']): ?>
                            <span class="badge bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/usuarios/editar/<?= $usu['usu_id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <?php if ((int) session()->get('usu_id') !== (int) $usu['usu_id']): ?>
                        <form method="post" action="/usuarios/eliminar/<?= $usu['usu_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar el usuario <?= esc($usu['usu_nombre']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($usuarios)): ?>
                <tr><td colspan="5" class="text-center text-muted py-4">No hay usuarios registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
