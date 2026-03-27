<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $partner !== null;
$action    = $esEdicion ? "/partners/actualizar/{$partner['par_id']}" : '/partners/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="par_nombre"
                           value="<?= old('par_nombre', $partner['par_nombre'] ?? '') ?>" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Logo <small class="text-muted fw-normal">(300x120 px recomendado)</small></label>
                    <input type="file" class="form-control" name="par_logo" accept="image/*">
                    <?php if ($esEdicion && ! empty($partner['par_logo'])): ?>
                        <div class="mt-2">
                            <img src="/<?= esc($partner['par_logo']) ?>" alt="Logo actual" style="max-height:30px;" class="rounded">
                            <small class="text-muted ms-2">Logo actual</small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="par_orden"
                           value="<?= old('par_orden', $partner['par_orden'] ?? 0) ?>">
                </div>
                <div class="col-md-8">
                    <label class="form-label">URL</label>
                    <input type="url" class="form-control" name="par_url"
                           value="<?= old('par_url', $partner['par_url'] ?? '') ?>"
                           placeholder="https://...">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="par_activo">
                        <option value="1" <?= old('par_activo', $partner['par_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= old('par_activo', $partner['par_activo'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/partners" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
