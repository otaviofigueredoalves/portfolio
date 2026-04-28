<div class="container py-1 d-flex justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= ucfirst($name_action) ?> Projeto</h2>
        </div>

        <div class="card glass-card p-4 shadow-lg">

            <form action="<?= BASE_URL ?>/admin/<?= $action ?>/<?= $project->id  ?? ''?>" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nome" class="form-label">Nome do Projeto</label>
                        <input type="text" class="form-control" value="<?= $project->nome ?? '' ?>" id="nome" name="nome" placeholder="Ex: Webapp brabo" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-select" id="categoria" name="category" required>
                            <option value="<?= $project->category ?? '' ?>" selected><?= $project->category ?? 'Escolha um tipo...' ?></option>
                            <option value="webapp">WebApp</option>
                            <option value="webpage">Webpage</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição Breve</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Do que se trata esse projeto?" required><?= $project->descricao ?? '' ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="github" class="form-label">URL do GitHub (Opcional)</label>
                        <input type="url" class="form-control" value="<?= $project->url_github_project ?? '' ?>" id="github" name="url_github_project" placeholder="https://github.com/...">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="site" class="form-label">URL do Site (Opcional)</label>
                        <input type="url" class="form-control" value="<?= $project->site_link ?>" id="site" name="site_link" placeholder="https://...">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block">Tecnologias Utilizadas</label>

                    <div class="p-3 rounded border border-secondary" style="max-height: 150px; overflow-y: auto; background-color: rgba(0,0,0,0.1);">
                        <div class="row">

                            <?php foreach ($techs as $tech): ?>
                                <div class="col-md-4 col-6 mb-2">
                                    <div class="form-check">
                                        <label class="form-check-label" for="tech_<?= $tech['id'] ?>">
                                            <?= $tech['nome'] ?>
                                        </label>

                                        <input class="form-check-input" type="checkbox" name="techs[]" value="<?= $tech['id'] ?>" id="tech_<?= $tech['id'] ?>"
                                            <?php
                                            foreach ($project->tech_list as $tech_project) {

                                                if ($tech_project['id'] == $tech['id']) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="form-text text-secondary">Selecione todas as tecnologias que você usou.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="alt_text" class="form-label">Texto alternativo da capa</label>
                    <input type="text" class="form-control" id="alt_text" value="<?= $project->img_alt ?>" name="img_alt" placeholder="Ex: Imagem do projeto X">
                </div>

                <div class="mb-4">
                    <label for="imagem" class="form-label">Capa do Projeto</label>
                    <input type="hidden" name="current_img" value="<?= $project->project_img ?>">
                    <input class="form-control" type="file" id="imagem" name="project_img" accept="image/*">
                    <div class="form-text text-secondary">Formatos aceitos: JPG, PNG, WEBP.</div>
                    <div class="form-text text-secondary">
                        Atual: <strong style="color: #fff;text-decoration: underline"><?= $project->project_img ?></strong>. Deixe em branco para manter.
                    </div>
                </div>


                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">Limpar</button>
                    <button type="submit" class="btn btn-custom">Salvar Projeto</button>
                </div>

            </form>
        </div>
    </div>
</div>