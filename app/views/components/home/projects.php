<section id="projects">
    <div class="title">
        <h2><span class="subtitle">Lista de</span> Projetos</h2>
    </div>
    
    <?php foreach($sections as $section): ?>
        <?php if (!empty($section['projects'])): ?>
            <div class="projects-area container">
                <h3><?= htmlspecialchars($section['nome']) ?></h3>
                <div class="projects-area-box">
                    <?php component('project_card', ['projects' => $section['projects']]); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    
</section>
