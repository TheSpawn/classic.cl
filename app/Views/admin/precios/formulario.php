<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<?php
$esEdicion = $precio !== null;
$action    = $esEdicion ? "/precios/actualizar/{$precio['pre_id']}" : '/precios/guardar';
$caracteristicas = [];
if ($esEdicion && ! empty($precio['pre_caracteristicas'])) {
    $caracteristicas = json_decode($precio['pre_caracteristicas'], true) ?? [];
}
?>

<form method="post" action="<?= $action ?>" x-data="precioForm()">
    <?= csrf_field() ?>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white fw-semibold">Datos del precio</div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Evento</label>
                    <select class="form-select" name="eve_id" required>
                        <option value="">— Seleccionar evento —</option>
                        <?php foreach ($eventos as $eve): ?>
                        <option value="<?= $eve['eve_id'] ?>" <?= old('eve_id', $precio['eve_id'] ?? '') == $eve['eve_id'] ? 'selected' : '' ?>>
                            <?= esc($eve['eve_titulo']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nombre del tier</label>
                    <input type="text" class="form-control" name="pre_nombre"
                           value="<?= old('pre_nombre', $precio['pre_nombre'] ?? '') ?>" required
                           placeholder="Anticipado, On-Time, Final">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Monto</label>
                    <input type="number" class="form-control" name="pre_monto"
                           value="<?= old('pre_monto', $precio['pre_monto'] ?? '') ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Moneda</label>
                    <select class="form-select" name="pre_moneda">
                        <option value="CLP" <?= old('pre_moneda', $precio['pre_moneda'] ?? 'CLP') === 'CLP' ? 'selected' : '' ?>>CLP</option>
                        <option value="USD" <?= old('pre_moneda', $precio['pre_moneda'] ?? '') === 'USD' ? 'selected' : '' ?>>USD</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="pre_activo">
                        <option value="1" <?= old('pre_activo', $precio['pre_activo'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= old('pre_activo', $precio['pre_activo'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha inicio</label>
                    <input type="date" class="form-control" name="pre_fecha_inicio"
                           value="<?= old('pre_fecha_inicio', $precio['pre_fecha_inicio'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha fin</label>
                    <input type="date" class="form-control" name="pre_fecha_fin"
                           value="<?= old('pre_fecha_fin', $precio['pre_fecha_fin'] ?? '') ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- Características -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Caracteristicas <small class="text-muted">(lo que incluye este precio)</small></span>
            <button type="button" class="btn btn-sm btn-outline-dark" @click="agregar()">
                <i class="bi bi-plus-lg"></i> Agregar
            </button>
        </div>
        <div class="card-body">
            <template x-for="(item, i) in items" :key="i">
                <div class="row g-2 mb-2 align-items-center">
                    <div class="col-md-11">
                        <input type="text" class="form-control form-control-sm" name="caracteristica[]"
                               x-model="item.texto" placeholder="Ej: Inscripcion al campeonato">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click="items.splice(i, 1)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </template>
            <p x-show="items.length === 0" class="text-muted mb-0">Sin caracteristicas. Agrega lo que incluye este precio.</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-dark">
            <i class="bi bi-check-lg"></i> <?= $esEdicion ? 'Actualizar' : 'Crear' ?>
        </button>
        <a href="/precios" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function precioForm() {
    return {
        items: <?= json_encode(array_map(fn($c) => ['texto' => $c], $caracteristicas)) ?>,
        agregar() {
            this.items.push({ texto: '' });
        }
    };
}
</script>
<?= $this->endSection() ?>
