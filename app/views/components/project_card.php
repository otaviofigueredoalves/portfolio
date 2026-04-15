<?php foreach ($projects as $project): ?>

    <div class="box">
        <a href="<?= $project->url_github_project ?>" target="_blank">
            <div class="box-img">
                <img src="<?= BASE_URL ?>/assets/images/projects_img/<?= $project->project_img ?>" alt="<?= $project->img_alt ?>">
            </div>
        </a>
        <div class="box-info">
            <h4><?= $project->nome ?></h4>
            <p><?= $project->descricao ?></p>
            <ul class="technologies">
                <?php foreach ($project->tech_list as $tech): ?>
                    <li>- <?= $tech['nome']?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($project->site_link): ?>
                <div class="buttons">
                    <a href="<?= $project->site_link ?>" class="button" target="_blank">View web</a>
                </div>
            <?php endif; ?>
            <?php if ($project->url_github_project): ?>
                <div class="buttons">
                    <a href="<?= $project->url_github_project ?>" class="button" target="_blank">Github</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>