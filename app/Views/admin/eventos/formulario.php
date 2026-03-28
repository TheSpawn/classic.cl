<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $evento !== null;
$action    = $esEdicion ? "/eventos/actualizar/{$evento['eve_id']}" : '/eventos/guardar';
?>

<form method="post" action="<?= $action ?>" x-data="eventoForm()" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white fw-semibold">Datos del evento</div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" name="eve_titulo"
                           value="<?= old('eve_titulo', $evento['eve_titulo'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="eve_slug"
                           value="<?= old('eve_slug', $evento['eve_slug'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="eve_fecha"
                           value="<?= old('eve_fecha', $evento['eve_fecha'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Hora</label>
                    <input type="time" class="form-control" name="eve_hora"
                           value="<?= old('eve_hora', $evento['eve_hora'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ubicacion</label>
                    <input type="text" class="form-control" name="eve_ubicacion"
                           value="<?= old('eve_ubicacion', $evento['eve_ubicacion'] ?? '') ?>"
                           placeholder="Santiago, Chile">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Venue</label>
                    <input type="text" class="form-control" name="eve_venue"
                           value="<?= old('eve_venue', $evento['eve_venue'] ?? '') ?>"
                           placeholder="Movistar Arena">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="eve_estado">
                        <?php foreach (['PRONTO', 'ABIERTO', 'CERRADO'] as $est): ?>
                        <option value="<?= $est ?>" <?= old('eve_estado', $evento['eve_estado'] ?? 'PRONTO') === $est ? 'selected' : '' ?>>
                            <?= $est ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Vende entradas</label>
                    <select class="form-select" name="eve_vende_entradas">
                        <option value="1" <?= old('eve_vende_entradas', $evento['eve_vende_entradas'] ?? 1) == 1 ? 'selected' : '' ?>>Si</option>
                        <option value="0" <?= old('eve_vende_entradas', $evento['eve_vende_entradas'] ?? 1) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                    <small class="text-muted">Capacitaciones: No</small>
                </div>
                <div class="col-md-3">
                    <?= $this->include('admin/_icono_picker') ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="eve_orden"
                           value="<?= old('eve_orden', $evento['eve_orden'] ?? 0) ?>">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Activo</label>
                    <select class="form-select" name="eve_activo">
                        <option value="1" <?= old('eve_activo', $evento['eve_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Si</option>
                        <option value="0" <?= old('eve_activo', $evento['eve_activo'] ?? 1) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Imagen <small class="text-muted fw-normal">(1920x800 px recomendado)</small></label>
                    <input type="file" class="form-control" name="eve_imagen" accept="image/*">
                    <?php if ($esEdicion && ! empty($evento['eve_imagen'])): ?>
                        <div class="mt-2">
                            <img src="/<?= esc($evento['eve_imagen']) ?>" alt="Imagen actual" style="max-height:60px;" class="rounded">
                            <small class="text-muted ms-2">Imagen actual</small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Video <small class="text-muted fw-normal">(subir MP4 o pegar URL)</small></label>
                    <input type="file" class="form-control mb-1" name="eve_video_archivo" accept="video/mp4,video/webm">
                    <input type="text" class="form-control form-control-sm" name="eve_video"
                           value="<?= old('eve_video', $evento['eve_video'] ?? '') ?>"
                           placeholder="o pegar URL de YouTube/Vimeo">
                    <small class="text-muted">MP4 recomendado: H.264, 1280x720, max 50MB</small>
                    <?php if ($esEdicion && ! empty($evento['eve_video'])): ?>
                        <div class="mt-1">
                            <small class="text-success"><i class="bi bi-check-circle"></i> Video: <?= esc(basename($evento['eve_video'])) ?></small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Descripción corta <small class="text-muted fw-normal">(texto plano)</small></label>
                    <textarea class="form-control" name="eve_descripcion_corta" rows="3"><?= old('eve_descripcion_corta', $evento['eve_descripcion_corta'] ?? '') ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Descripción completa <small class="text-muted fw-normal">(acepta HTML)</small></label>
                    <textarea class="form-control" name="eve_descripcion" rows="3"><?= old('eve_descripcion', $evento['eve_descripcion'] ?? '') ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Meta datos -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Meta datos <small class="text-muted">(info icons)</small></span>
            <button type="button" class="btn btn-sm btn-outline-dark" @click="agregarMeta()">
                <i class="bi bi-plus-lg"></i> Agregar
            </button>
        </div>
        <div class="card-body">
            <template x-for="(meta, i) in metaItems" :key="i">
                <div class="row g-2 mb-2 align-items-center">
                    <div class="col-md-3">
                        <input type="text" class="form-control form-control-sm" name="met_icono[]"
                               x-model="meta.icono" placeholder="bi-calendar">
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control form-control-sm" name="met_texto[]"
                               x-model="meta.texto" placeholder="Texto descriptivo">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click="metaItems.splice(i, 1)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </template>
            <p x-show="metaItems.length === 0" class="text-muted mb-0">Sin meta datos.</p>
        </div>
    </div>

    <!-- Highlights -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Highlights</span>
            <button type="button" class="btn btn-sm btn-outline-dark" @click="agregarHighlight()">
                <i class="bi bi-plus-lg"></i> Agregar
            </button>
        </div>
        <div class="card-body">
            <template x-for="(hl, i) in highlightItems" :key="i">
                <div class="row g-2 mb-2 align-items-center">
                    <div class="col-md-11">
                        <input type="text" class="form-control form-control-sm" name="hig_texto[]"
                               x-model="hl.texto" placeholder="Highlight del evento">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click="highlightItems.splice(i, 1)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </template>
            <p x-show="highlightItems.length === 0" class="text-muted mb-0">Sin highlights.</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-dark">
            <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
        </button>
        <a href="/eventos" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function eventoForm() {
    return {
        metaItems: <?= json_encode(array_map(fn($m) => ['icono' => $m['met_icono'], 'texto' => $m['met_texto']], $metas)) ?>,
        highlightItems: <?= json_encode(array_map(fn($h) => ['texto' => $h['hig_texto']], $highlights)) ?>,
        agregarMeta() {
            this.metaItems.push({ icono: '', texto: '' });
        },
        agregarHighlight() {
            this.highlightItems.push({ texto: '' });
        }
    };
}
</script>
<?= $this->endSection() ?>
