<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Display</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            /* padding: 20px; */
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(0px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .card {
            max-width: 300px;
            width: 80%;
            height: 90%; /* Set a fixed height for all cards */
            border: 1px solid #ddd;
            padding: 15px;
            cursor: pointer;
            background-color: #007bff;
            color: black;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            position: relative;
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards;
            animation-delay: calc(var(--animation-order) * 0.1s);
        }
        .card-image {
            width: 100%;
            height: 200px; /* Fixed height for the image container */
            overflow: hidden; /* Hide overflowing content */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-image img {
            max-width: 100%;
            max-height: 100%; /* Ensure image fits within the container */
            width: auto; /* Maintain aspect ratio */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .details-table {
            display: none;
            position: absolute; /* Change to absolute */
            top: calc(100% - 125px); /* Position below the card */
            left: 0;
            width: calc(100% - 32px); /* Adjust width as needed */
            max-width: 300px; /* Maximum width */
            background-color: black;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #007bff;
            color: white;
            z-index: 1; /* Ensure it's above the card */
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards; /* Apply the animation */
            position: absolute; /* Position the details table absolutely */
            /* bottom: 0;
            left: 0; */
            /* width: 100%; */
        }

        .details-table.active {
            opacity: 1;
        }

        .card {
            position: relative;
        }
    
        .status-button {
            display: inline-block;
            margin-left:90px;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            background-color: red; /* Green color */
            color: white;
            cursor: pointer;
        }

        .status-found {
            background-color: green; 
        }
    </style>
</head>
<body>

<div class="card-container">
    <?php
        session_start();

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
    
        $sql = "SELECT ID, Name, ID_Number, ItemType, ItemName, ItemColor, Description, Date, Location,Image,Status FROM FoundItems WHERE ID_Number IN (SELECT Username FROM registration WHERE Username = '$username')";
        $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["ID"];
            $imagePath = $row["Image"];
            ?>

            <div class="card" style="position: relative;">
                <div onclick="toggleDetails('<?php echo $id; ?>')">
                <div class="card-image">
                <?php if ($imagePath) : ?>
                    <img src="LostUploads/<?php echo $imagePath; ?>" alt="Item Image">
                <?php endif; ?>
                </div>
                    <h2><?php echo htmlspecialchars($row["ItemType"]); ?></h2>
                    <p><strong>Name:</strong><?php echo htmlspecialchars($row["ItemName"]); ?></p>
                    <p><strong>Date:</strong><?php echo htmlspecialchars($row["Date"]); ?></p>
                    <button class="status-button <?php echo ($row['Status'] === 'Returned') ? 'status-found' : ''; ?>" onclick="changeStatus('<?php echo $id; ?>', this)">
                    <?php echo htmlspecialchars($row["Status"]); ?>
                </button>                    
                </div>
                <div id="details_<?php echo $id; ?>" class="details-table" style="display: none;">
                    <table>
                        <tr><td><strong>Name:</strong></td><td><?php echo htmlspecialchars($row["Name"]); ?></td></tr>
                        <tr><td><strong>ID Number:</strong></td><td><?php echo htmlspecialchars($row["ID_Number"]); ?></td></tr>
                        <tr><td><strong>Item Type:</strong></td><td><?php echo htmlspecialchars($row["ItemType"]); ?></td></tr>
                        <tr><td><strong>Item Name:</strong></td><td><?php echo htmlspecialchars($row["ItemName"]); ?></td></tr>
                        <tr><td><strong>Color:</strong></td><td><?php echo htmlspecialchars($row["ItemColor"]); ?></td></tr>
                        <tr><td><strong>Description:</strong></td><td><?php echo htmlspecialchars($row["Description"]); ?></td></tr>
                        <tr><td><strong>Date:</strong></td><td><?php echo date('F j, Y, g:i a', strtotime($row["Date"])); ?></td></tr>
                        <tr><td><strong>Location:</strong></td><td><?php echo htmlspecialchars($row["Location"]); ?></td></tr>
                        <!-- Add more rows as needed -->
                    </table>
                </div>
            </div>

            <?php
        }
    } else {
        echo "0 results for the logged-in users";
    }

    $result->free_result();
    $conn->close();
    ?>
</div>

<script>
    function toggleDetails(id) {
        var detailsTable = document.getElementById('details_' + id);

        if (detailsTable.style.display === 'block') {
            detailsTable.style.display = 'none';
            detailsTable.classList.remove('active');
        } else {
            document.querySelectorAll('.details-table').forEach(function(table) {
                if (table.id !== 'details_' + id) {
                    table.style.display = 'none';
                    table.classList.remove('active');
                }
            });

            detailsTable.style.display = 'block';
            detailsTable.classList.add('active');
        }
    }

    function changeStatus(id, button) {
        var detailsTable = document.getElementById('details_' + id);
        if (detailsTable.style.display === 'block') {
            detailsTable.style.display = 'none';
        } else {
            detailsTable.style.display = 'block';
        }
    }


        // // Send an AJAX request to update_status.php with the item ID
        // var xhr = new XMLHttpRequest();
        // xhr.open('POST', 'update_status.php', true);
        // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // xhr.onreadystatechange = function() {
        //     if (xhr.readyState === XMLHttpRequest.DONE) {
        //         if (xhr.status === 200) {
        //             // If the request is successful, change the button text and style
        //             button.innerHTML = 'Found';
        //             button.classList.add('status-found');
        //             button.disabled = true; // Disable the button after updating the status
        //         } else {
        //             // Handle error here
        //             console.error('Error:', xhr.status);
        //         }
        //     }
        // };
        // xhr.send('id=' + id); // Send the item ID in the request body
</script>
</body>
</html>




  