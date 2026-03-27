<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><?= count($documentos) ?> documento(s)</span>
    <a href="/documentos/crear" class="btn btn-dark btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Documento
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Orden</th>
                    <th>Titulo</th>
                    <th>Categoria</th>
                    <th>Archivo</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documentos as $doc): ?>
                <tr>
                    <td class="text-center text-muted"><?= $doc['doc_orden'] ?></td>
                    <td class="fw-semibold"><?= esc($doc['doc_titulo']) ?></td>
                    <td><span class="badge bg-light text-dark"><?= esc($doc['doc_categoria'] ?? '—') ?></span></td>
                    <td>
                        <a href="/<?= esc($doc['doc_archivo']) ?>" target="_blank" class="text-decoration-none">
                            <i class="bi bi-file-earmark-pdf text-danger"></i> Ver
                        </a>
                    </td>
                    <td>
                        <span class="badge <?= $doc['doc_activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $doc['doc_activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="/documentos/editar/<?= $doc['doc_id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="post" action="/documentos/eliminar/<?= $doc['doc_id'] ?>" class="d-inline"
                              data-confirmar="¿Eliminar documento <?= esc($doc['doc_titulo']) ?>?">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($documentos)): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">No hay documentos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (isset($pager)): ?>
<div class="mt-3"><?= $pager->links() ?></div>
<?php endif; ?>

<?= $this->endSection() ?>
