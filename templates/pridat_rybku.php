<?php
session_start();
require_once '../class/Config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_logged_in'])) {
    $nazevRybky = $_POST['fishName'];
    $barvaRybky = $_POST['fishColor'];
    $uzivatelID = $_SESSION['UzivatelID'];

    $database = new Database();
    $conn = $database->getConnection();

    // Kontrola, zda již existuje záznam pro daného uživatele
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM Ryba WHERE UzivatelID = :UzivatelID");
    $checkStmt->bindParam(':UzivatelID', $uzivatelID);
    $checkStmt->execute();

    if ($checkStmt->fetchColumn() > 0) {
        // Update existujícího záznamu
        $updateStmt = $conn->prepare("UPDATE Ryba SET Jmeno = :Jmeno, Barva = :Barva WHERE UzivatelID = :UzivatelID");
        $updateStmt->bindParam(':Jmeno', $nazevRybky);
        $updateStmt->bindParam(':Barva', $barvaRybky);
        $updateStmt->bindParam(':UzivatelID', $uzivatelID);
        $updateStmt->execute();
    } else {
        // Vložení nového záznamu
        $insertStmt = $conn->prepare("INSERT INTO Ryba (UzivatelID, Jmeno, Barva) VALUES (:UzivatelID, :Jmeno, :Barva)");
        $insertStmt->bindParam(':UzivatelID', $uzivatelID);
        $insertStmt->bindParam(':Jmeno', $nazevRybky);
        $insertStmt->bindParam(':Barva', $barvaRybky);
        $insertStmt->execute();
    }

    header('Location: ../index.php?akvarko');
    exit();
} else {
    header('Location: ../index.php?rybka');
    exit();
}
?>
