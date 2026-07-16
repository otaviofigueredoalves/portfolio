<section class="skills container">
    <div class="title">
        <h2><span class="subtitle">Habilidades</span>Tecnologias</h2>
    </div>
    <?php 
        $all_techs = $techs ?? [];
        $half = ceil(count($all_techs) / 2);
        $techs_row1 = array_slice($all_techs, 0, $half);
        $techs_row2 = array_slice($all_techs, $half);
    ?>
    <div class="container">
        <?php component('techs', ['techs' => $techs_row1]); ?>
    </div>
    <div class="container reverse">
        <?php component('techs', ['techs' => $techs_row2]); ?>
    </div>
</section>
