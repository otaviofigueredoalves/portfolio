<?php
$count_item = 1;
?>
<?php foreach($techs as $tech): ?>

    <div class="item item<?= $count_item ?>">
        <img src="<?= BASE_URL ?>/assets/icons/<?= $tech['icon'] ?>" alt="<?= $tech['nome'] ?>">
    </div>
    <?php $count_item++?>
<?php endforeach; ?>