<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | MYCINEMA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/images/MYCINEMA.png') ?>" type="image/x-icon">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background: url("<?= base_url('assets/picsbackground/login-bg.jpg') ?>")
                        no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 0;
        }

        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(16px);
            border-radius: 16px;
            padding: 2.5rem;
            color: #fff;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);

            opacity: 0;
            animation: fadeUp 0.7s ease-out forwards;
        }

        .login-card input {
            border-radius: 10px;
            padding: 12px;
        }

        .login-logo {
            max-width: 150px;
            width: 100%;
            height: auto;
            margin-bottom: 1rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .login-title {
            font-size: 0.9rem;
            letter-spacing: 0.3em;
            font-weight: 700;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4);
            margin-bottom: 1.8rem;
        }

        .login-card button {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
        }

        .demo-account {
            font-size: 0.95rem;
        }

        .demo-account strong {
            font-size: 1.30rem;
        }

        .demo-account code {
            font-size: 1rem;
            color: #ffb3d9;
        }

        .demo-box {
            background: rgba(0, 0, 0, 0.35);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            margin-top: 1rem;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.15);
        }

        .demo-title {
            font-size: 1.1rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

            @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    </style>
</head>
<body>

<div class="overlay"></div>

<div class="login-card text-center">
    <img src="<?= base_url('assets/images/MYCINEMA.png') ?>"
         alt="MYCINEMA"
         class="login-logo">

    <div class="login-title">LOGIN</div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <input type="text" name="username" class="form-control"
                   placeholder="Username" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control"
                   placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>
    </form>

    <hr class="my-4" style="border-color: rgba(255,255,255,0.3);">

    <div class="demo-box demo-account text-start" style="opacity: 0.95;">
      <div class="demo-title">
          👤 Akun Demo
        </div>

        <div class="mb-2">
            <strong>Admin</strong><br>
            Username: <code>admin</code><br>
            Password: <code>admin123</code>
        </div>

        <div>
            <strong>Kasir</strong><br>
            Username: <code>kasir</code><br>
            Password: <code>kasir123</code>
        </div>
    </div>
</div>

</body>
</html>
