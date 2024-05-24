<?php
require_once 'functions.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="clients.csv"');

$output = fopen("php://output", "w");
fputcsv($output, array('ID', 'Name', 'Email')); // Column headers

$pdo = getPDO();
$sql = "SELECT id, name, email FROM clients";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
