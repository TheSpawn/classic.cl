<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $documento !== null;
$action    = $esEdicion ? "/documentos/actualizar/{$documento['doc_id']}" : '/documentos/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" name="doc_titulo"
                           value="<?= old('doc_titulo', $documento['doc_titulo'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Categoria</label>
                    <input type="text" class="form-control" name="doc_categoria"
                           value="<?= old('doc_categoria', $documento['doc_categoria'] ?? '') ?>"
                           placeholder="IASF, Divisiones, etc.">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="doc_orden"
                           value="<?= old('doc_orden', $documento['doc_orden'] ?? 0) ?>">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Activo</label>
                    <select class="form-select" name="doc_activo">
                        <option value="1" <?= old('doc_activo', $documento['doc_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Si</option>
                        <option value="0" <?= old('doc_activo', $documento['doc_activo'] ?? 1) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Archivo <?= $esEdicion ? '<small class="text-muted">(dejar vacio para mantener actual)</small>' : '' ?>
                    </label>
                    <input type="file" class="form-control" name="doc_archivo" accept=".pdf,.doc,.docx,.xls,.xlsx"
                           <?= $esEdicion ? '' : 'required' ?>>
                    <?php if ($esEdicion && $documento['doc_archivo']): ?>
                        <small class="text-muted">
                            Actual: <a href="/<?= esc($documento['doc_archivo']) ?>" target="_blank"><?= basename($documento['doc_archivo']) ?></a>
                        </small>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Descripcion</label>
                    <textarea class="form-control" name="doc_descripcion" rows="2"><?= old('doc_descripcion', $documento['doc_descripcion'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/documentos" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
