<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $contenido !== null;
$action    = $esEdicion ? "/contenido/actualizar/{$contenido['con_id']}" : '/contenido/guardar';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $action ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Seccion</label>
                    <input type="text" class="form-control" name="con_seccion"
                           value="<?= old('con_seccion', $contenido['con_seccion'] ?? '') ?>" required
                           placeholder="hero, nosotros, inscripcion">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Clave</label>
                    <input type="text" class="form-control" name="con_clave"
                           value="<?= old('con_clave', $contenido['con_clave'] ?? '') ?>" required
                           placeholder="titulo, subtitulo, texto">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tipo</label>
                    <select class="form-select" name="con_tipo">
                        <?php foreach (['TEXTO', 'HTML', 'JSON'] as $tipo): ?>
                        <option value="<?= $tipo ?>" <?= old('con_tipo', $contenido['con_tipo'] ?? 'TEXTO') === $tipo ? 'selected' : '' ?>>
                            <?= $tipo ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Valor</label>
                    <textarea class="form-control" name="con_valor" rows="6"><?= old('con_valor', $contenido['con_valor'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
                </button>
                <a href="/contenido" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
