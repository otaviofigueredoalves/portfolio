<?php
$count_item = 1;
$total_techs = count($techs);
?>
<?php foreach($techs as $tech): ?>
    <div class="item" style="--quantity: <?= $total_techs ?>; animation-delay: calc(var(--animation-d) / var(--quantity) * (var(--quantity) - <?= $count_item ?>) * -1);">
        <img src="<?= BASE_URL ?>/assets/icons/<?= $tech['icon'] ?>" alt="<?= $tech['nome'] ?>">
    </div>
    <?php $count_item++?>
<?php endforeach; ?>