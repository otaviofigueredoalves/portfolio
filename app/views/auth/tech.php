<?php
$isEdit = isset($tech) && !empty($tech);
$actionUrl = $isEdit ? BASE_URL . '/admin/updateTech/' . $tech['id'] : BASE_URL . '/admin/createTech';
$pageTitle = $isEdit ? 'Editar Tecnologia' : 'Cadastrar Nova Tecnologia';
?>
<div class="container py-1 d-flex justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $pageTitle ?></h2>
        </div>

        <div class="card ds-glass p-4 shadow-lg">

            <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Tecnologia</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: PHP" required value="<?= $isEdit ? $tech['nome'] : '' ?>">
                </div>

                <div class="mb-4">
                    <label for="icon" class="form-label">Ícone da Tecnologia <?= $isEdit ? '(deixe vazio para manter)' : '' ?></label>
                    <input class="form-control" type="file" id="icon" name="tech_icon" accept="image/svg+xml,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>>
                    <div class="form-text text-secondary">Formatos aceitos: SVG, PNG, WEBP.</div>
                    <?php if ($isEdit && !empty($tech['icon'])): ?>
                        <div class="mt-2">
                            <img src="<?= BASE_URL ?>/assets/icons/<?= $tech['icon'] ?>" alt="Atual" style="width: 48px; height: 48px; object-fit: contain;">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= BASE_URL ?>/admin/techs" class="btn btn-outline-secondary rounded-pill px-4">Voltar</a>
                    <button type="submit" class="btn ds-btn ds-btn-solid">Salvar Tecnologia</button>
                </div>

            </form>
        </div>
    </div>
</div>
