<?php
$isEdit = isset($category) && !empty($category);
$actionUrl = $isEdit ? BASE_URL . '/admin/updateSection/' . $category['id'] : BASE_URL . '/admin/createSection';
$pageTitle = $isEdit ? 'Editar Seção' : 'Cadastrar Nova Seção';
?>
<div class="container py-4 d-flex justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $pageTitle ?></h2>
        </div>

        <div class="card ds-glass p-4 shadow-lg">
            <form action="<?= $actionUrl ?>" method="POST">
                <div class="mb-4">
                    <label for="nome" class="form-label">Nome da Seção</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Sistemas Web" required value="<?= $isEdit ? $category['nome'] : '' ?>">
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= BASE_URL ?>/admin/sections" class="btn btn-outline-light rounded-pill px-4">Voltar</a>
                    <button type="submit" class="btn ds-btn ds-btn-solid">Salvar Seção</button>
                </div>
            </form>
        </div>
    </div>
</div>
