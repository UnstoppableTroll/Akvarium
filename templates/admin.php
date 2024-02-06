<?php
include 'templates/head.php';
require_once './class/Config.php';


if (!isset($_SESSION['user_logged_in']) || $_SESSION['UzivatelID'] != 1) {
    header('Location: index.php?rybka'); // Přesměrování na přihlašovací stránku
    exit;
}

$model = new Model();
$controller = new Controller($model);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ryba_id'])) {
    $controller->handleDeleteFish();
}

// Vytvoření instance databáze
$database = new Database();
$conn = $database->getConnection();

// Získání ID přihlášeného uživatele
$uzivatelID = $_SESSION['UzivatelID'] ?? null;

$rybky = [];
if ($uzivatelID) {
    // Příprava dotazu pro načtení rybek uživatele
    $stmt = $conn->prepare("SELECT * FROM Ryba ORDER BY RybaID DESC LIMIT 10");
  
    $stmt->execute();
    $rybky = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container">
    <div class="wrapper">
        <h1>Správa rybiček</h1>

 
        <table>
            <tr>
                <th>ID</th>
                <th>Jméno</th>
                <th>Akce</th>
            </tr>
            <?php foreach ($rybky as $rybka): ?>
            <tr>
                <td><?php echo htmlspecialchars($rybka['RybaID']); ?></td>
                <td><?php echo htmlspecialchars($rybka['Jmeno']); ?></td>
                <td>
                    <form method="post" action="index.php?admin">
                        <input type="hidden" name="ryba_id" value="<?php echo htmlspecialchars($rybka['RybaID']); ?>">
                        <input type="submit" value="Spláchnout">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<style>
body {
    /* solid background */
    background: rgb(0, 212, 255);
    margin: 0;
    /* gradient background*/
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
    /* Přidáno pro horizontální centrování */
    top: 50%;
    /* Přidat pro vertikální centrování */
    transform: translate(-50%, -50%);
    /* Upraveno pro obě osy */
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

table {
    width: 80%; /* Upravte podle potřeby */
    margin: auto;
    border-collapse: collapse;
    border-spacing: 0;
}

th, td {
    border-bottom: 1px solid rgba(255, 255, 255, 0.125);
    padding: 8px;
    text-align: left;
}

th {
    background-color: rgba(0, 212, 255, 0.6);
    color: white;
        text-align: center;

}

td {
    background-color: rgba(17, 25, 40, 0.25);
    color: white;
    text-align: center;

}

input[type="submit"] {
    background-color: rgba(0, 212, 255, 0.9);
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    top: 11px;
}

input[type="submit"]:hover {
    background-color: rgba(0, 212, 255, 1);
}

</style>