<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listagem de Tecnologias</h2>
        <a class="btn ds-btn ds-btn-solid" href="<?= BASE_URL ?>/admin/newTech">+ Nova Tecnologia</a>
    </div>

    <div class="card ds-glass p-4 shadow-lg">
        <table class="table table-dark table-striped mt-3 text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ícone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($techs as $tech): ?>
                    <tr>
                        <td><?= $tech['id'] ?></td>
                        <td><?= $tech['nome'] ?></td>
                        <td>
                            <?php if (!empty($tech['icon'])): ?>
                                <img src="<?= BASE_URL ?>/assets/icons/<?= $tech['icon'] ?>" alt="<?= $tech['nome'] ?>" style="width: 32px; height: 32px; object-fit: contain;">
                            <?php else: ?>
                                - 
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL ?>/admin/editTech/<?= $tech['id'] ?>">Editar</a>
                            <a class="btn btn-danger btn-sm" href="<?= BASE_URL ?>/admin/dropTech/<?= $tech['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta tecnologia?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($techs)): ?>
                    <tr>
                        <td colspan="4">Nenhuma tecnologia cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            <a href="<?= BASE_URL ?>/admin" class="btn btn-outline-light rounded-pill px-4">Voltar ao Admin</a>
        </div>
    </div>
</div>
