<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            height: 100vh;
        }

        .profile-image {
            width: 130px;
            height: 130px;
            border-radius: 50%; /* Make the image circular */
            object-fit: cover;
            border: 2px solid #fff; /* Optional: Add a border */
        }
        .card {
            width:500px;
            background-color: #007bff;
            box-shadow: 0 4px 8px ;
            border-radius: 8px;
            padding:20px;
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items:start;
        }

        h2 {
            color: black;
        }

        p {
            color: black;
        }

        strong {
            font-weight: bold;
            color: black;
        }

        /* Add more specific styles or adjust as needed */

        /* Center the card in the middle of the page */
        .center-card {
            display: flex;
            justify-content: left;
            align-items:left;
            height: vh;
        }
    </style>

</head>
<body>
    <div class="center-card">
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

        $sql = "SELECT id, FirstName, LastName, Email, Username, Image FROM registration WHERE Username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $imagePath = $row["Image"];
        ?>
                <div class="card">
                    <?php if (!empty($imagePath)) { ?>
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Profile Picture" class="profile-image">
                    <?php } else { ?>
                        <!-- If no profile picture is available, display a default placeholder image or leave it empty -->
                        <div class="profile-image"></div>
                    <?php } ?>
                    <form action="upload_image.php" method="post" enctype="multipart/form-data" class="profile-image-input">
                        <input type="file" name="profile_image" accept="image/*"><br>
                        <input type="submit" value="Submit" name="submit">
                    </form>
                    <h2><?php echo htmlspecialchars($row["FirstName"]); ?></h2>
                    <p><strong>FirstName:</strong> <?php echo htmlspecialchars($row["FirstName"]); ?></p>
                    <p><strong>LastName:</strong> <?php echo htmlspecialchars($row["LastName"]); ?></p>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($row["Username"]); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row["Email"]); ?></p>
                    <!-- You can include more details here based on your database columns -->
                </div>
        <?php
            }
        }
        ?>
        <!-- Form for uploading profile picture -->
    </div>
</body>
</html>
