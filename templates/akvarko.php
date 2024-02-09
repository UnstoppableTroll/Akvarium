<?php 
include 'templates/head.php';
require_once './class/Config.php';

$model = new Model();
$controller = new Controller($model);
$rybky = $controller->zobrazAkvarko();
?>

<link rel="stylesheet" href="./css/akvarium.css">

<div id="fish-tank">
    <div id="bubble-field">
    <?php foreach ($rybky as $rybka): ?>
    <?php
    $left = rand(0, 80); 
    $bottom = rand(20, 70);
    ?>
    <div class="fish <?= htmlspecialchars($rybka['Barva']) ?>" style="left: <?= $left ?>%; bottom: <?= $bottom ?>%;">
        <div class="jmeno fish-name"><?= $rybka['Jmeno'] ?></div>
        <div class="top-fin"></div>
        <div class="fish-body"></div>
        <div class="tail-fin"></div>
        <div class="side-fin"></div>
        <div class="scale scale-1"></div>
        <div class="scale scale-2"></div>
        <div class="scale scale-3"></div>
    </div>
<?php endforeach; ?>

    </div>
</div>

<script src="./scripts/akvarko.js"></script>




<?php include 'templates/end.html'; ?>