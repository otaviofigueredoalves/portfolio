<?php
/** @var array $data */
?>
<div class="container py-1 d-flex justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cadastrar Nova Tecnologia</h2>
        </div>

        <div class="card glass-card p-4 shadow-lg">

            <form action="<?= BASE_URL ?>/admin/createTech" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Tecnologia</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: PHP" required>
                </div>

                <div class="mb-4">
                    <label for="icon" class="form-label">Ícone da Tecnologia</label>
                    <input class="form-control" type="file" id="icon" name="tech_icon" accept="image/svg+xml,image/png,image/webp" required>
                    <div class="form-text text-secondary">Formatos aceitos: SVG, PNG, WEBP.</div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= BASE_URL ?>/admin" class="btn btn-outline-secondary rounded-pill px-4">Voltar</a>
                    <button type="submit" class="btn btn-custom">Salvar Tecnologia</button>
                </div>

            </form>
        </div>
    </div>
</div>
