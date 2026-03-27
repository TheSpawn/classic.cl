<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $hito !== null;
$action    = $esEdicion ? "/hitos/actualizar/{$hito['hit_id']}" : '/hitos/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" name="hit_titulo"
                           value="<?= old('hit_titulo', $hito['hit_titulo'] ?? '') ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Año</label>
                    <input type="number" class="form-control" name="hit_anio"
                           value="<?= old('hit_anio', $hito['hit_anio'] ?? date('Y')) ?>" required>
                </div>
                <div class="col-md-3">
                    <?= $this->include('admin/_icono_picker') ?>
                </div>
                <div class="col-md-1">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="hit_orden"
                           value="<?= old('hit_orden', $hito['hit_orden'] ?? 0) ?>">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Activo</label>
                    <select class="form-select" name="hit_activo">
                        <option value="1" <?= old('hit_activo', $hito['hit_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Si</option>
                        <option value="0" <?= old('hit_activo', $hito['hit_activo'] ?? 1) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Imagen <small class="text-muted fw-normal">(800x500 px recomendado)</small></label>
                    <input type="file" class="form-control" name="hit_imagen" accept="image/*">
                    <?php if ($esEdicion && ! empty($hito['hit_imagen'])): ?>
                        <div class="mt-2">
                            <img src="/<?= esc($hito['hit_imagen']) ?>" alt="Imagen actual" style="max-height:60px;" class="rounded">
                            <small class="text-muted ms-2">Imagen actual</small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="hit_descripcion" rows="3"><?= old('hit_descripcion', $hito['hit_descripcion'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/hitos" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
