<?= $this->extend('plantillas/admin') ?>

<?= $this->section('contenido') ?>

<div class="row g-4">
    <!-- Info del usuario -->
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-4">
                <div class="rounded-circle bg-dark bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                    <i class="bi bi-person-fill fs-1 text-dark"></i>
                </div>
                <h5 class="fw-bold mb-1"><?= esc($usuario['usu_nombre'] . ' ' . $usuario['usu_apellido']) ?></h5>
                <p class="text-muted mb-2"><?= esc($usuario['usu_email']) ?></p>
                <span class="badge bg-danger"><?= $usuario['usu_rol'] ?></span>
            </div>
        </div>
    </div>

    <!-- Cambiar contraseña -->
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">Cambiar contraseña</div>
            <div class="card-body">
                <form method="post" action="/perfil/cambiar-password">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Contraseña actual</label>
                        <input type="password" class="form-control" name="password_actual" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" name="password_nueva" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" name="password_confirmar" required minlength="6">
                    </div>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-shield-lock"></i> Cambiar contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
