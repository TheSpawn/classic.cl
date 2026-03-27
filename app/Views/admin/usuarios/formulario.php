<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $usuario !== null;
$action    = $esEdicion ? "/usuarios/actualizar/{$usuario['usu_id']}" : '/usuarios/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="usu_nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="usu_nombre" name="usu_nombre"
                           value="<?= old('usu_nombre', $usuario['usu_nombre'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="usu_apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="usu_apellido" name="usu_apellido"
                           value="<?= old('usu_apellido', $usuario['usu_apellido'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="usu_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="usu_email" name="usu_email"
                           value="<?= old('usu_email', $usuario['usu_email'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="usu_password" class="form-label">
                        Contrasena <?= $esEdicion ? '<small class="text-muted">(dejar vacio para no cambiar)</small>' : '' ?>
                    </label>
                    <input type="password" class="form-control" id="usu_password" name="usu_password"
                           <?= $esEdicion ? '' : 'required' ?>>
                </div>
                <div class="col-md-4">
                    <label for="usu_rol" class="form-label">Rol</label>
                    <select class="form-select" id="usu_rol" name="usu_rol" required>
                        <?php foreach (['SUPERADMIN', 'ADMIN', 'EDITOR'] as $rol): ?>
                        <option value="<?= $rol ?>" <?= old('usu_rol', $usuario['usu_rol'] ?? '') === $rol ? 'selected' : '' ?>>
                            <?= $rol ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="usu_activo" class="form-label">Estado</label>
                    <select class="form-select" id="usu_activo" name="usu_activo">
                        <option value="1" <?= old('usu_activo', $usuario['usu_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= old('usu_activo', $usuario['usu_activo'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

                <!-- Sitios asignados -->
                <div class="col-12">
                    <label class="form-label">Sitios asignados</label>
                    <div class="row g-2">
                        <?php foreach ($sitios as $sitio): ?>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sitios[]"
                                       value="<?= $sitio['sit_id'] ?>" id="sit_<?= $sitio['sit_id'] ?>"
                                       <?= in_array($sitio['sit_id'], $sitiosAsignados) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="sit_<?= $sitio['sit_id'] ?>">
                                    <span class="d-inline-block rounded-circle me-1" style="width:10px;height:10px;background:<?= esc($sitio['sit_color_primario']) ?>"></span>
                                    <?= esc($sitio['sit_nombre']) ?>
                                </label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/usuarios" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
