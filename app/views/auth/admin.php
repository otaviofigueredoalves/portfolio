<?php
/** @var array $projects */
?>
<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="btn-criar d-flex justify-content-end gap-2 mb-3">
                <a class="btn btn-primary" href="<?= BASE_URL ?>/admin/new">+ Novo Projeto</a>
                <a class="btn btn-success" href="<?= BASE_URL ?>/admin/newTech">+ Nova Tecnologia</a>
            </div>
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col">ID</th>
                            <th class="col">NOME PROJETO</th>
                            <th class="col">CATEGORIA</th>
                            <th class="col">AÇÕES</th>
                            <th class="col">POSIÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                            <tr>
                                <td><?= $project->id ?></td>
                                <td><?= $project->nome ?></td>
                                <td><?= $project->category ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?= BASE_URL . "/admin/edit/$project->id" ?>">Editar</a>
                                    <a class="btn btn-danger" href="<?= BASE_URL . "/admin/drop/$project->id" ?>">Excluir</a>
                                </td>
                               <td><?= $project->sort_by ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
<style>
    tr,td{
        text-align: center;
    }
</style>