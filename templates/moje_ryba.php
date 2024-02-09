<?php
include 'templates/head.php';
require_once 'class/Config.php';

$model = new Model();
$controller = new Controller($model);
$rybaData = $controller->zobrazMojeRyba();
?>


<div class="container">
    <div class="arrow left-arrow" onclick="changeFishColor('left')">&#9664;</div>

    <div class="wrapper">
        <?php if ($rybaData): ?>
        <div class="fish <?= htmlspecialchars($rybaData['Barva']) ?>">
            <div class="top-fin"></div>
            <div class="fish-body"></div>
            <div class="tail-fin"></div>
            <div class="side-fin"></div>
            <div class="scale scale-1"></div>
            <div class="scale scale-2"></div>
            <div class="scale scale-3"></div>
        </div>
        <?php else: ?>




        <div class="fish orange-fish">
            <div class="top-fin"></div>
            <div class="fish-body"></div>
            <div class="tail-fin"></div>
            <div class="side-fin"></div>
            <div class="scale scale-1"></div>
            <div class="scale scale-2"></div>
            <div class="scale scale-3"></div>
        </div>
        <?php endif; ?>
        <h1>Výběr rybičky</h1>

    </div>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="pridejAktualizujRybu">
        <div class="fish-name-input">
            <label for="fishName">Název rybky:</label>
            <input type="text" id="fishName" name="fishName"
                value="<?= $rybaData ? htmlspecialchars($rybaData['Jmeno']) : '' ?>">
        </div>
        <input type="hidden" id="fishColor" name="fishColor"
            value="<?= $rybaData ? htmlspecialchars($rybaData['Barva']) : 'orange-fish' ?>">
        <div class="button-wrapper">
            <button type="submit" class="btn fill"><?= $rybaData ? 'Upravit' : 'Přidat' ?></button>
        </div>
    </form>

    <div class="arrow right-arrow" onclick="changeFishColor('right')">&#9654;</div>
</div>

<script src="./scripts/moje_ryba.js"></script>


<style>
body {

    background: rgb(0, 212, 255);
    margin: 0;

    background: linear-gradient(45deg, rgba(0, 212, 255, 1) 0%, rgba(11, 3, 45, 1) 100%);


    background-size: cover;
    background-position: center;


}

.container {
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    background-color: rgba(17, 25, 40, 0.25);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.125);
    padding: 38px;
    filter: drop-shadow(0 30px 10px rgba(0, 0, 0, 0.125));
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}


.wrapper {
    width: 100%;
    height: 100%;
    margin: 74px 27px 33px -2px;


}



h1 {
    font-family: 'Righteous', sans-serif;
    color: rgba(255, 255, 255, 0.98);
    text-transform: uppercase;
    font-size: 2.4rem;
    position: relative;
    top: -86px;
    left: 5%;
    text-align: center;
}

p {
    color: #fff;
    font-family: 'Lato', sans-serif;
    text-align: center;
    font-size: 0.8rem;
    line-height: 150%;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.button-wrapper {
    margin-top: 18px;
}

.btn {
    border: none;
    padding: 12px 24px;
    border-radius: 24px;
    font-size: 12px;
    font-size: 0.8rem;
    letter-spacing: 2px;
    cursor: pointer;
}

.btn+.btn {
    margin-left: 10px;
}

.outline {
    background: transparent;
    color: rgba(0, 212, 255, 0.9);
    border: 1px solid rgba(0, 212, 255, 0.6);
    transition: all .3s ease;

}

.outline:hover {
    transform: scale(1.125);
    color: rgba(255, 255, 255, 0.9);
    border-color: rgba(255, 255, 255, 0.9);
    transition: all .3s ease;
}

.fill {
    background: rgba(0, 212, 255, 0.9);
    color: rgba(255, 255, 255, 0.95);
    filter: drop-shadow(0);
    font-weight: bold;
    transition: all .3s ease;
}

.fill:hover {
    transform: scale(1.125);
    border-color: rgba(255, 255, 255, 0.9);
    filter: drop-shadow(0 10px 5px rgba(0, 0, 0, 0.125));
    transition: all .3s ease;
}


/************************************************************/


.fish {
    position: absolute;
    left: 40%;
    top: 91px;
    margin-bottom: 30px;
    margin-top: 70px;
}


.fish-body {
    position: absolute;
    width: 115px;
    height: 75px;
    border-radius: 50%;
    background-color: orange;
    box-shadow: 0px -7px 7px inset #00000045;
    -webkit-box-shadow: 0px -7px 7px inset #00000045;
    -moz-box-shadow: 0px -7px 7px inset #00000045;
    -o-box-shadow: 0px -7px 7px inset #00000045;
    -ms-box-shadow: 0px -7px 7px inset #00000045;
    transform: skewX(5deg) skewY(-10deg);
    -webkit-transform: skewX(5deg) skewY(-10deg);
    -moz-transform: skewX(5deg) skewY(-10deg);
    -ms-transform: skewX(5deg) skewY(-10deg);
    -o-transform: skewX(5deg) skewY(-10deg);
}

.blue-fish .fish-body {
    background-color: #0098e0;
}

.fish-body:before {
    content: "";
    width: 15px;
    height: 15px;
    background-color: #ffffff;
    position: absolute;
    border-radius: 50%;
    right: 18px;
    top: 16px;
}

.fish-body:after {
    content: "";
    width: 7px;
    height: 9px;
    background-color: #000000;
    position: absolute;
    border-radius: 50%;
    right: 20px;
    top: 18px;
}

.top-fin {
    position: absolute;
    left: 35px;
    top: -23px;
    width: 28px;
    height: 50px;
    border-radius: 20% 50%;
    background-color: orange;
    box-shadow: 2px -11px 7px inset #00000080;
    -webkit-box-shadow: 2px -11px 7px inset #00000080;
    -moz-box-shadow: 2px -11px 7px inset #00000080;
    -o-box-shadow: 2px -11px 7px inset #00000080;
    -ms-box-shadow: 2px -11px 7px inset #00000080;
    transform: rotate(80deg) skewX(-23deg);
    -webkit-transform: rotate(80deg) skewX(-23deg);
    -moz-transform: rotate(80deg) skewX(-23deg);
    -ms-transform: rotate(80deg) skewX(-23deg);
    -o-transform: rotate(80deg) skewX(-23deg);
}

.blue-fish .top-fin {
    background-color: #0098e0;
}

.tail-fin {
    position: absolute;
    left: -35px;
    bottom: -89px;
    width: 43px;
    height: 50px;
    border-radius: 40% 50%;
    background-color: orange;
    box-shadow: 1px -13px 7px inset #00000080;
    -webkit-box-shadow: 1px -13px 7px inset #00000080;
    -moz-box-shadow: 1px -13px 7px inset #00000080;
    -o-box-shadow: 1px -13px 7px inset #00000080;
    -ms-box-shadow: 1px -13px 7px inset #00000080;
    transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -webkit-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -moz-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -ms-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -o-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);

}

.blue-fish .tail-fin {
    background-color: #0098e0;
}

.tail-fin:before {
    content: "";
    z-index: 9;
    position: absolute;
    left: -16px;
    bottom: 19px;
    width: 40px;
    height: 48px;
    border-radius: 40% 50%;
    background-color: orange;
    box-shadow: 1px -13px 7px inset #00000080;
    -webkit-box-shadow: 1px -13px 7px inset #00000080;
    -moz-box-shadow: 1px -13px 7px inset #00000080;
    -o-box-shadow: 1px -13px 7px inset #00000080;
    -ms-box-shadow: 1px -13px 7px inset #00000080;
    transform: rotate(85deg);
    -webkit-transform: rotate(85deg);
    -moz-transform: rotate(85deg);
    -ms-transform: rotate(85deg);
    -o-transform: rotate(85deg);
}

.blue-fish .tail-fin:before {
    background-color: #0098e0;
}

.side-fin {
    position: absolute;
    left: 39px;
    bottom: -77px;
    width: 33px;
    height: 38px;
    border-radius: 50% 40%;
    background-color: orange;
    box-shadow: 1px -13px 7px inset #00000080;
    -webkit-box-shadow: 1px -13px 7px inset #00000080;
    -moz-box-shadow: 1px -13px 7px inset #00000080;
    -o-box-shadow: 1px -13px 7px inset #00000080;
    -ms-box-shadow: 1px -13px 7px inset #00000080;
    transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -webkit-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -moz-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -ms-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);
    -o-transform: rotate(25deg) skewX(-18deg) skewY(-15deg);

}

.blue-fish .side-fin {
    background-color: #0098e0;
}

.scale {
    position: absolute;
    width: 21px;
    height: 24px;
    border-radius: 39%;
    background-color: orange;
    box-shadow: 3px -3px 5px inset #00000020;
    -webkit-box-shadow: 3px -3px 5px inset #00000020;
    -moz-box-shadow: 3px -3px 5px inset #00000020;
    -o-box-shadow: 3px -3px 5px inset #00000020;
    -ms-box-shadow: 3px -3px 5px inset #00000020;

}

.blue-fish .scale {
    background-color: #0098e0;
}

.scale-1 {
    left: 20px;
    bottom: -44px;
}

.scale-2 {
    left: 36px;
    bottom: -32px;
}

.scale-3 {
    left: 53px;
    bottom: -37px;
}

.arrow {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 36px;
    /* Zvětšení velikosti šipky */
    color: rgba(255, 255, 255, 0.7);
    /* Bílá barva s průhledností */
    user-select: none;
}

.left-arrow {
    left: 20px;
    /* Posunutí dále od levého kraje */
}

.right-arrow {
    right: 20px;
    /* Posunutí dále od pravého kraje */
}

.green-fish .fish-body,
.green-fish .top-fin,
.green-fish .tail-fin,
.green-fish .side-fin,
.green-fish .scale {
    background-color: green;
    /* Zelená barva pro části rybky */
}

.green-fish .tail-fin:before {
    background-color: green;
}

.blue-fish .fish-body,
.blue-fish .top-fin,
.blue-fish .tail-fin,
.blue-fish .side-fin,
.blue-fish .scale {
    background-color: #0098e0;
    /* Modrá barva pro části rybky */
}

.blue-fish .tail-fin:before {
    background-color: #0098e0;
}

.fish-name-input {
    text-align: center;
    margin-top: 20px;
    padding-top: 60px
}

.fish-name-input label {
    margin-right: 10px;
    color: rgba(255, 255, 255, 0.9);
    /* Bílá barva textu */
    font-weight: bold;
}

.fish-name-input input[type="text"] {
    padding: 12px 24px;
    border-radius: 24px;
    border: 1px solid rgba(0, 212, 255, 0.6);
    color: rgba(0, 212, 255, 0.9);
    background: transparent;
    transition: all .3s ease;
    margin-right: 10px;
    /* Odsazení tlačítka od textového pole */
}

.fish-name-input input[type="text"]:focus {
    outline: none;
    border-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 0 8px rgba(0, 152, 224, 0.6);
}

.fish-name-input button {
    padding: 12px 24px;
    border-radius: 24px;
    border: none;
    background-color: rgba(0, 212, 255, 0.9);
    /* Modrá barva tlačítka */
    color: rgba(255, 255, 255, 0.95);
    /* Bílá barva textu */
    cursor: pointer;
    font-size: 0.8rem;
    letter-spacing: 2px;
    transition: all .3s ease;
}

.fish-name-input button:hover {
    transform: scale(1.125);
    background-color: rgba(255, 255, 255, 0.9);
    color: rgba(0, 212, 255, 0.9);
    filter: drop-shadow(0 10px 5px rgba(0, 0, 0, 0.125));
}
</style>