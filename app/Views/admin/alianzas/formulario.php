<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $alianza !== null;
$action    = $esEdicion ? "/alianzas/actualizar/{$alianza['ali_id']}" : '/alianzas/guardar';
$stats     = [];
if ($esEdicion && ! empty($alianza['ali_stats'])) {
    $stats = json_decode($alianza['ali_stats'], true) ?? [];
}
?>

<form method="post" action="<?= $action ?>" enctype="multipart/form-data" x-data="alianzaForm()">
    <?= csrf_field() ?>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white fw-semibold">Datos de la alianza</div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="ali_nombre"
                           value="<?= old('ali_nombre', $alianza['ali_nombre'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select class="form-select" name="ali_tipo">
                        <option value="PRINCIPAL" <?= old('ali_tipo', $alianza['ali_tipo'] ?? '') === 'PRINCIPAL' ? 'selected' : '' ?>>Principal</option>
                        <option value="SECUNDARIA" <?= old('ali_tipo', $alianza['ali_tipo'] ?? '') === 'SECUNDARIA' ? 'selected' : '' ?>>Secundaria</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Invitaciones</label>
                    <input type="text" class="form-control" name="ali_invitaciones"
                           value="<?= old('ali_invitaciones', $alianza['ali_invitaciones'] ?? '') ?>"
                           placeholder="5, 30, etc.">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="ali_orden"
                           value="<?= old('ali_orden', $alianza['ali_orden'] ?? 0) ?>">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Activo</label>
                    <select class="form-select" name="ali_activo">
                        <option value="1" <?= old('ali_activo', $alianza['ali_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Si</option>
                        <option value="0" <?= old('ali_activo', $alianza['ali_activo'] ?? 1) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Logo <small class="text-muted fw-normal">(400x400 px recomendado)</small></label>
                    <input type="file" class="form-control" name="ali_logo" accept="image/*">
                    <?php if ($esEdicion && ! empty($alianza['ali_logo'])): ?>
                        <div class="mt-2">
                            <img src="/<?= esc($alianza['ali_logo']) ?>" alt="Logo actual" style="max-height:40px;" class="rounded">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ubicación</label>
                    <input type="text" class="form-control" name="ali_ubicacion"
                           value="<?= old('ali_ubicacion', $alianza['ali_ubicacion'] ?? '') ?>"
                           placeholder="Orlando, FL, USA">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fechas</label>
                    <input type="text" class="form-control" name="ali_fechas"
                           value="<?= old('ali_fechas', $alianza['ali_fechas'] ?? '') ?>"
                           placeholder="Abril 23-26, 2027">
                </div>
                <div class="col-12">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="ali_descripcion" rows="3"><?= old('ali_descripcion', $alianza['ali_descripcion'] ?? '') ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Estadísticas <small class="text-muted">(ej: 600+ equipos, 20K+ atletas)</small></span>
            <button type="button" class="btn btn-sm btn-outline-dark" @click="agregarStat()">
                <i class="bi bi-plus-lg"></i> Agregar
            </button>
        </div>
        <div class="card-body">
            <template x-for="(stat, i) in statsItems" :key="i">
                <div class="row g-2 mb-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="stat_valor[]"
                               x-model="stat.valor" placeholder="600+">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" name="stat_label[]"
                               x-model="stat.label" placeholder="Equipos participantes">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click="statsItems.splice(i, 1)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </template>
            <p x-show="statsItems.length === 0" class="text-muted mb-0">Sin estadísticas.</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-dark">
            <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
        </button>
        <a href="/alianzas" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function alianzaForm() {
    return {
        statsItems: <?= json_encode(array_map(fn($s) => ['label' => $s['label'], 'valor' => $s['valor']], $stats)) ?>,
        agregarStat() {
            this.statsItems.push({ label: '', valor: '' });
        }
    };
}
</script>
<?= $this->endSection() ?>
