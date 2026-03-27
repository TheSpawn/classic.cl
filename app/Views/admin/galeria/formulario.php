<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $galeria !== null;
$action    = $esEdicion ? "/galeria/actualizar/{$galeria['gal_id']}" : '/galeria/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" name="gal_titulo"
                           value="<?= old('gal_titulo', $galeria['gal_titulo'] ?? '') ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="gal_orden"
                           value="<?= old('gal_orden', $galeria['gal_orden'] ?? 0) ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="gal_activo">
                        <option value="1" <?= old('gal_activo', $galeria['gal_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Activa</option>
                        <option value="0" <?= old('gal_activo', $galeria['gal_activo'] ?? 1) == 0 ? 'selected' : '' ?>>Inactiva</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Descripcion</label>
                    <textarea class="form-control" name="gal_descripcion" rows="3"><?= old('gal_descripcion', $galeria['gal_descripcion'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/galeria" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
