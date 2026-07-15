<?php
/** @var array $projects */
?>
<body>
    <main class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h2 class="mb-3 mb-md-0 text-light">Painel Administrativo</h2>
            <div class="d-flex gap-2">
                <a class="btn ds-btn btn-outline-light" href="<?= BASE_URL ?>/admin/sections">Gerenciar Seções</a>
                <a class="btn ds-btn btn-outline-light" href="<?= BASE_URL ?>/admin/techs">Gerenciar Tecnologias</a>
                <a class="btn ds-btn ds-btn-solid" href="<?= BASE_URL ?>/admin/new">+ Novo Projeto</a>
            </div>
        </div>

        <div class="card ds-glass p-4 shadow-lg">
            <div class="table-responsive">
                <table class="table table-dark table-striped mt-3 text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME PROJETO</th>
                            <th>CATEGORIA</th>
                            <th>AÇÕES</th>
                            <th>POSIÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                            <tr>
                                <td><?= $project->id ?></td>
                                <td><?= $project->nome ?></td>
                                <td><?= $project->category ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="<?= BASE_URL . "/admin/edit/$project->id" ?>">Editar</a>
                                    <a class="btn btn-danger btn-sm" href="<?= BASE_URL . "/admin/drop/$project->id" ?>" onclick="return confirm('Tem certeza que deseja excluir este projeto?')">Excluir</a>
                                </td>
                                <td><?= $project->sort_by ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($projects)): ?>
                            <tr>
                                <td colspan="5">Nenhum projeto cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>