<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Portfolio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto Mono', system-ui;
            background-color: #282131; /* Sua cor primária */
        }
        h1, h2, h3, h4, .navbar-brand {
            font-family: 'Literata', system-ui;
        }
        .btn-custom {
            background-color: #716087;
            color: #F9F9F9;
            border-radius: 20px;
            padding: 10px 30px;
            border: 1px solid #716087;
            transition: all 0.2s ease-in-out;
        }
        .btn-custom:hover {
            background-color: #F9F9F9;
            color: #282131;
            transform: scale(0.95);
        }
        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-5" style="background-color: rgba(0,0,0,0.2);">
        <div class="container">
            <a class="navbar-brand fs-3" href="#"><span style="color: #716087;">Admin</span></a>
            <div class="d-flex">
                <a href="<?= BASE_URL ?>" class="btn btn-outline-light btn-sm rounded-pill">Voltar ao Site</a>
            </div>
        </div>
    </nav>

    <main class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Cadastrar Novo Projeto</h2>
                </div>

                <div class="card glass-card p-4 shadow-lg">
                    
                    <form action="<?= BASE_URL ?>/admin/register" method="POST" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">Nome do Projeto</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Webapp brabo" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select class="form-select" id="categoria" name="category" required>
                                    <option value="" selected disabled>Escolha o tipo...</option>
                                    <option value="webapp">WebApp</option>
                                    <option value="webpage">Webpage</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição Breve</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Do que se trata esse projeto?" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="github" class="form-label">URL do GitHub (Opcional)</label>
                                <input type="url" class="form-control" id="github" name="url_github_project" placeholder="https://github.com/...">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="site" class="form-label">URL do Site (Opcional)</label>
                                <input type="url" class="form-control" id="site" name="site_link" placeholder="https://...">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Tecnologias Utilizadas</label>
                            
                            <div class="p-3 rounded border border-secondary" style="max-height: 150px; overflow-y: auto; background-color: rgba(0,0,0,0.1);">
                                <div class="row">
                                    
                                    <?php foreach($techs as $tech): ?>
                                        <div class="col-md-4 col-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="techs[]" value="<?= $tech['id'] ?>" id="tech_<?= $tech['id'] ?>">
                                                <label class="form-check-label" for="tech_<?= $tech['id'] ?>">
                                                    <?= $tech['nome'] ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                </div>
                            </div>
                            <div class="form-text text-secondary">Selecione todas as tecnologias que você usou.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alt_text" class="form-label">Texto alternativo da capa</label>
                            <input type="text" class="form-control" id="alt_text" name="img_alt" placeholder="Ex: Imagem do projeto X" required>
                        </div>

                        <div class="mb-4">
                            <label for="imagem" class="form-label">Capa do Projeto</label>
                            <input class="form-control" type="file" id="imagem" name="project_img" accept="image/*" required>
                            <div class="form-text text-secondary">Formatos aceitos: JPG, PNG, WEBP.</div>
                        </div>


                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">Limpar</button>
                            <button type="submit" class="btn btn-custom">Salvar Projeto</button>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>