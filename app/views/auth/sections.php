<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listagem de Seções</h2>
        <a class="btn ds-btn ds-btn-solid" href="<?= BASE_URL ?>/admin/newSection">+ Nova Seção</a>
    </div>

    <div class="card ds-glass p-4 shadow-lg">
        <table class="table table-dark table-striped mt-3 text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Seção</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['nome'] ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL ?>/admin/editSection/<?= $category['id'] ?>">Editar</a>
                            <a class="btn btn-danger btn-sm" href="<?= BASE_URL ?>/admin/dropSection/<?= $category['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta seção? Os projetos ficarão sem seção.')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="3">Nenhuma seção cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            <a href="<?= BASE_URL ?>/admin" class="btn btn-outline-light rounded-pill px-4">Voltar ao Admin</a>
        </div>
    </div>
</div>
