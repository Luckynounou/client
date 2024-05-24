<?php

require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $pdo = getPDO();  // Ensure your getPDO function handles connection errors

    try {
        switch ($action) {
            case 'add':
                $name = $_POST['name'];
                $email = $_POST['email'];

                $sql = "INSERT INTO clients (name, email) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $email]);

                if ($stmt->rowCount() > 0) {
                    echo "Client added successfully.";
                } else {
                    echo "Failed to add the client.";
                }
                break;

            case 'edit':
                $client_id = $_POST['id'];  // Ensure the client ID is being sent in the form
                $name = $_POST['name'];
                $email = $_POST['email'];

                $sql = "UPDATE clients SET name = ?, email = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $email, $client_id]);

                if ($stmt->rowCount() > 0) {
                    echo "Client updated successfully.";
                } else {
                    echo "No rows affected. Check if the ID exists and data differs from current values.";
                }
                break;

            case 'delete':
                $client_id = $_POST['id'];  // Ensure the client ID is being sent in the form

                $sql = "DELETE FROM clients WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$client_id]);

                if ($stmt->rowCount() > 0) {
                    echo "Client deleted successfully.";
                } else {
                    echo "No client found with that ID.";
                }
                break;

            default:
                echo "Invalid action.";
                break;
        }

        // Redirect to avoid form resubmission issues
        header("Location: admin.php");
        exit();

    } catch (PDOException $e) {
        // Error handling, display error message
        echo "Error: " . $e->getMessage();
        exit;
    }
}
