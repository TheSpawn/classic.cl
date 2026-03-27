<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="/galeria" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Volver a galerias
    </a>
</div>

<!-- Formulario subir imagen -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white fw-semibold">Subir imagen</div>
    <div class="card-body">
        <form method="post" action="/galeria/<?= $galeria['gal_id'] ?>/subir-imagen" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Archivo</label>
                    <input type="file" class="form-control" name="imagen" accept="image/*" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" name="ima_titulo">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Alt text</label>
                    <input type="text" class="form-control" name="ima_alt">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Orden</label>
                    <input type="number" class="form-control" name="ima_orden" value="0">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-upload"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Grid de imágenes -->
<div class="row g-3">
    <?php foreach ($imagenes as $img): ?>
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <img src="/<?= esc($img['ima_archivo']) ?>" class="card-img-top" alt="<?= esc($img['ima_alt']) ?>"
                 style="height:180px;object-fit:cover;">
            <div class="card-body p-2">
                <small class="text-muted d-block"><?= esc($img['ima_titulo'] ?: 'Sin titulo') ?></small>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="badge bg-light text-dark">Orden: <?= $img['ima_orden'] ?></span>
                    <form method="post" action="/galeria/eliminar-imagen/<?= $img['ima_id'] ?>"
                          data-confirmar="¿Eliminar esta imagen?">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if (empty($imagenes)): ?>
    <div class="col-12">
        <div class="text-center text-muted py-5">No hay imagenes en esta galeria.</div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
