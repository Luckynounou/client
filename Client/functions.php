<?php
// Database configuration settings
$host = 'localhost';  // Database host
$dbname = 'management';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password, adjust as necessary

/// Function to create and return a new PDO connection
function getPDO() {
    global $host, $dbname, $username, $password;
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Make the default fetch be an associative array
        PDO::ATTR_EMULATE_PREPARES => false, // Turn off emulation mode for "real" prepared statements
    ];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        return $pdo;
    } catch (PDOException $e) {
        die("PDO Connection Error: " . $e->getMessage());
    }
}


// Function to fetch upcoming clients
function getUpcomingclients() {
    $pdo = getPDO();
    $sql = "SELECT * FROM clients WHERE client_id >= CURDATE() ORDER BY client_id ASC";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Failed to fetch upcoming clients: " . $e->getMessage());
        return [];
    }
}

function searchclients($searchTerm) {
    $pdo = getPDO();
    $sql = "SELECT * FROM clients WHERE name LIKE ? AND client_id >= CURDATE() ORDER BY client_id ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $searchTerm . '%']);
    return $stmt->fetchAll();
}







?>

