<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $conn = new mysqli("localhost", "root", "", "signupforms");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];

    // Update the status to 'Found' for the corresponding item ID
    $sql = "UPDATE LostItems SET Status = 'Found' WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        echo 'Status updated successfully';
    } else {
        echo 'Error updating status: ' . $conn->error;
    }

    $conn->close();
} else {
    echo 'Invalid request';
}
?>
