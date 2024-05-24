<?php
require_once 'functions.php';

$pdo = getPDO();
$sql = "SELECT * FROM clients";
$stmt = $pdo->query($sql);
$clients = $stmt->fetchAll();

foreach ($clients as $client) {
    $nameEscaped = htmlspecialchars($client['name'], ENT_QUOTES);
    $emailEscaped = htmlspecialchars($client['email'], ENT_QUOTES);
    $clientId = $client['id'];

    echo "<tr>";
    echo "<td>" . $nameEscaped . "</td>";
    echo "<td>" . $emailEscaped . "</td>";
    echo "<td>";
    echo "<button onclick=\"openModal('{$clientId}', '{$nameEscaped}', '{$emailEscaped}')\">Edit</button>";
    echo "<form action='admin_process.php' method='post' style='display:inline;'>";
    echo "<input type='hidden' name='id' value='{$clientId}'>";
    echo "<input type='hidden' name='action' value='delete'>";
    echo "<button type='submit'>Delete</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
?>
