<?php
session_start(); // Start the session (ensure this is present at the beginning of the code)

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    // Redirect to the login page or handle unauthorized access
    header('Location: login.php');
    exit();
}

$username = $_SESSION['Username'];

// Your database connection logic here
// (assume you've connected to the database and stored the connection in $conn)

$sql = "SELECT ID, Name, ID_Number, ItemType, ItemName, ItemColor, Description, Date, Location FROM FoundItems WHERE ID_Number IN (SELECT ID_Number FROM registration WHERE Username = '$username')";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Your existing card display logic here

            // Add your card display code here
        }
    } else {
        echo "0 results for the logged-in user";
    }

    // Free result set
    $result->free_result();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>







//foundcard.php


<?php
session_start(); // Start the session (ensure this is present at the beginning of the code)

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    // Redirect to the login page or handle unauthorized access
    header('Location: login.php');
    exit();
}

$conn = new mysqli("localhost", "root", "", "signupforms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['Username'];

$sql = "SELECT ID, Name, ID_Number, ItemType, ItemName, ItemColor, Description, Date, Location FROM FoundItems WHERE ID_Number IN (SELECT Username FROM registration WHERE Username = '$username')";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Add a unique identifier to each card
            $id = $row["ID"];

            echo '<div class="card" onclick="showDetails(' . $id . ')">';
            echo '<h2>' . htmlspecialchars($row["Name"]) . '</h2>';
            echo '<p>' . htmlspecialchars($row["ItemName"]) . '</p>';
            echo '<p>' . htmlspecialchars($row["ItemType"]) . '</p>';
            echo '<p>' . htmlspecialchars($row["Description"]) . '</p>';
            echo '</div>';

            // Hidden details in a table format
            echo '<div id="details_' . $id . '" class="details-table">';
            echo '<table>';
            echo '<tr><td><strong>Name:</strong></td><td>' . htmlspecialchars($row["Name"]) . '</td></tr>';
            echo '<tr><td><strong>ID Number:</strong></td><td>' . htmlspecialchars($row["ID_Number"]) . '</td></tr>';
            echo '<tr><td><strong>Item Type:</strong></td><td>' . htmlspecialchars($row["ItemType"]) . '</td></tr>';
            echo '<tr><td><strong>Item Name:</strong></td><td>' . htmlspecialchars($row["ItemName"]) . '</td></tr>';
            echo '<tr><td><strong>Color:</strong></td><td>' . htmlspecialchars($row["ItemColor"]) . '</td></tr>';
            echo '<tr><td><strong>Description:</strong></td><td>' . htmlspecialchars($row["Description"]) . '</td></tr>';
            echo '<tr><td><strong>Date:</strong></td><td>' . date('F j, Y, g:i a', strtotime($row["Date"])) . '</td></tr>';
            echo '<tr><td><strong>Location:</strong></td><td>' . htmlspecialchars($row["Location"]) . '</td></tr>';

            // Add more rows as needed
            echo '</table>';
            echo '</div>';
        }
    } else {
        echo "0 results for the logged in users";
    }

    // Free result set
    $result->free_result();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Display</title>
    <style>
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 300px;
            float: left:center;
            justify-content:center;
            align-items;1
            cursor: pointer;
            background-color:#007bff;
            color:black;
        }

        .details-table {
            display: none;
            border: 2px solid white;
            color:white;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<script>
    function showDetails(id) {
        // Hide all details tables
        var detailsTables = document.querySelectorAll('.details-table');
        detailsTables.forEach(function(table) {
            table.style.display = 'none';
        });

        // Show the details table for the clicked card
        var detailsTable = document.getElementById('details_' + id);
        detailsTable.style.display = 'block';
    }
</script>

</body>
</html>
