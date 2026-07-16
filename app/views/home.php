<?php component('layout/head'); ?>
<body>
    <?php component('layout/header'); ?>
    <main>
        <?php component('home/hero'); ?>
        <?php component('home/about'); ?>
        <?php component('home/skills', ['techs' => $view_data['techs'] ?? []]); ?>
        <?php component('home/projects', ['sections' => $view_data['sections'] ?? []]); ?>
        <?php component('home/contacts'); ?>
    </main>
    <?php component('layout/footer'); ?>
</body>
</html>