<?php 
include 'templates/head.php';
require_once './class/Config.php';

// Kontrola, jestli je uživatel přihlášen
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Vytvoření instance databáze
$database = new Database();
$conn = $database->getConnection();

// Získání ID přihlášeného uživatele
$uzivatelID = $_SESSION['UzivatelID'];

// Příprava dotazu pro načtení rybek uživatele
$stmt = $conn->prepare("SELECT Jmeno, Barva FROM Ryba ");

$stmt->execute();
$rybky = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="./css/akvarium.css">

<div id="fish-tank">
    <div id="bubble-field">
    <?php foreach ($rybky as $rybka): ?>
    <?php
    // Náhodné pozice pro ryby
    $left = rand(0, 80); // Náhodná pozice zleva (v procentech)
    $bottom = rand(20, 70); // Náhodná pozice odspodu (v procentech)
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

<script>
    var bubbleCount = 30;
    var bubbleField = document.getElementById("bubble-field");

    for (i = 0; i < bubbleCount; i++) {
        var randNum = Math.floor(Math.random() * 20) + 1;
        var animDur = 2 + (0.5 * randNum);
        moveEl = document.createElement('div');
        moveEl.setAttribute('class', 'bubble-rise');
        moveEl.setAttribute('style', 'animation-duration: ' + animDur + 's;');

        bubbleEl = document.createElement('div');
        bubbleEl.setAttribute('class', 'bubble');
        bubbleElContent = document.createTextNode('');
        bubbleEl.appendChild(bubbleElContent);

        moveEl.appendChild(bubbleEl)
        bubbleField.appendChild(moveEl);
    }
</script>




<?php include 'templates/end.html'; ?>