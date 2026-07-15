<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Portfolio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/design-system.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: var(--ds-font-body);
            background-color: var(--ds-color-text-main);
        }
        h1, h2, h3, h4, .navbar-brand {
            font-family: var(--ds-font-heading);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-5" style="background-color: rgba(0,0,0,0.2);">
        <div class="container">
            <a class="navbar-brand fs-3" href="#"><span style="color: var(--ds-color-primary);">Admin</span></a>
            <div class="d-flex">
                <a href="<?= BASE_URL ?>" class="btn btn-outline-light btn-sm rounded-pill">Voltar ao Site</a>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                
                <div class="d-flex justify-content-center align-items-center mb-4">
                    <h2>Admin Login</h2>
                </div>

                <div class="card ds-glass p-4 shadow-lg">
                    <form action="<?= BASE_URL ?>/auth/login" method="POST" enctype="multipart/form-data">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="pass" name="pass" required>
                            </div>
                            <button type="submit" class="btn ds-btn ds-btn-solid w-100">Entrar</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>