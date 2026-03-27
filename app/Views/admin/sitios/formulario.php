<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $sitio !== null;
$action    = $esEdicion ? "/sitios/actualizar/{$sitio['sit_id']}" : '/sitios/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="sit_nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="sit_nombre" name="sit_nombre"
                           value="<?= old('sit_nombre', $sitio['sit_nombre'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="sit_slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="sit_slug" name="sit_slug"
                           value="<?= old('sit_slug', $sitio['sit_slug'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="sit_color_primario" class="form-label">Color</label>
                    <input type="color" class="form-control form-control-color w-100" id="sit_color_primario" name="sit_color_primario"
                           value="<?= old('sit_color_primario', $sitio['sit_color_primario'] ?? '#000000') ?>">
                </div>
                <div class="col-md-6">
                    <label for="sit_dominio" class="form-label">Dominio</label>
                    <input type="text" class="form-control" id="sit_dominio" name="sit_dominio"
                           value="<?= old('sit_dominio', $sitio['sit_dominio'] ?? '') ?>" required
                           placeholder="ejemplo.cl">
                </div>
                <div class="col-md-4">
                    <label for="sit_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="sit_email" name="sit_email"
                           value="<?= old('sit_email', $sitio['sit_email'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label for="sit_activo" class="form-label">Estado</label>
                    <select class="form-select" id="sit_activo" name="sit_activo">
                        <option value="1" <?= old('sit_activo', $sitio['sit_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= old('sit_activo', $sitio['sit_activo'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Logo <small class="text-muted fw-normal">(400x120 px recomendado)</small></label>
                    <input type="file" class="form-control" name="sit_logo" accept="image/*">
                    <?php if ($esEdicion && ! empty($sitio['sit_logo'])): ?>
                        <div class="mt-2">
                            <img src="/<?= esc($sitio['sit_logo']) ?>" alt="Logo actual" style="max-height:40px;" class="rounded">
                            <small class="text-muted ms-2">Logo actual</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/sitios" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
