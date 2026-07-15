<?php foreach ($projects as $project): ?>

    <div class="box">
        <a href="<?= $project->url_github_project ?>" target="_blank">
            <div class="box-img">
                <?php if(!empty($project->highlight_tag)): ?>
                    <div class="ds-badge-special"><?= htmlspecialchars($project->highlight_tag) ?></div>
                <?php endif; ?>
                <img src="<?= BASE_URL ?>/assets/images/projects_img/<?= $project->project_img ?>" alt="<?= $project->img_alt ?>">
            </div>
        </a>
        <div class="box-info">
            <h4><?= $project->nome ?></h4>
            <p><?= $project->descricao ?></p>
            <ul class="technologies">
                <?php foreach ($project->tech_list as $tech): ?>
                    <li class="tech-badge"><?= $tech['nome']?></li>
                <?php endforeach; ?>
            </ul>
            <div class="buttons">
                <?php if ($project->site_link): ?>
                    <a href="<?= $project->site_link ?>" class="ds-btn ds-btn-outline" target="_blank">View web</a>
                <?php endif; ?>
                <?php if ($project->url_github_project): ?>
                    <a href="<?= $project->url_github_project ?>" class="ds-btn ds-btn-outline" target="_blank">Github</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>