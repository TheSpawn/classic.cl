<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Classic CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
        }
        .login-card .brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-card .brand h2 {
            font-weight: 700;
            color: #1a1a2e;
        }
        .login-card .brand small {
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="brand">
        <h2><i class="bi bi-grid-fill"></i> Classic CMS</h2>
        <small>Sistema de gestion de contenido</small>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="/login">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= old('email') ?>" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contrasena</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-dark w-100">
            <i class="bi bi-box-arrow-in-right"></i> Ingresar
        </button>
    </form>
</div>

</body>
</html>
