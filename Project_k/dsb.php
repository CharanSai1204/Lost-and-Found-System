<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    // Redirect to the login page or display an error message
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body, h1, h2, h3, p, ul {
    margin: 0;
    padding: 0;
}

body {
            font-family: 'Arial', sans-serif;
            background-color: black;
        }

        section {
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #007bff;
            color:black;
            display: flex;
            justify-content: space-between; /* Align items horizontally */
            align-items: start; /* Center items vertically */
        }

        .nav-links {
            display: flex;
            justify-content: flex-end; /* Align items to the right */
        }

        .nav-link {
            text-decoration: none;
            color:black;
            padding: 10px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .nav-link:hover {
            background-color:black;
            color: white;  
            border-radius: 10px;      
        }

        /* Main content styling */
        .main {
            padding: 20px;
        }

        .s1 {
            flex: 2;
            background-color:black;
            padding: 20px;
        }

        /* Typography for headings */
        h2 {
            color: white;
            padding-bottom: 20px;
        }
        
        h1{
            color: white;
            margin-bottom: 10px;
        }

        p{
            text-align:center;
        }

        /* Additional styling for the header */
        section > div > h2 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-bottom: 0px;
        }



        /* Adjustments for the dashboard to appear on the left side */
        .container {
            display: flex;
            flex-direction: row;
            height: 100vh; /* Full height */
        }

        .dashboard {
            position: fixed; /* Fix the dashboard on the left */
            top: 0;
            bottom: 0; /* Occupy full height */
            overflow-y: auto; /* Enable vertical scrolling if needed */
            width: 200px; 
            background-color: #007bff;
            color:white;
            display: flex;
            flex-direction:column;
            padding: 20px;
            align-items: start;
        }

        .main-content {
            flex: 1; /* Allow the content to take remaining space */
            padding: 20px;
            margin-left: 240px; /* Adjust margin to accommodate the fixed dashboard */
            overflow-y: auto;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%; /* Make the image circular */
            object-fit: cover;
            border: 2px solid #fff; /* Optional: Add a border */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard">
            <h2><font color="black">Lost and Found Dashboard</font></h2>

            <!-- Display user's profile picture and username -->
            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "signupforms");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch profile image path for the logged-in user
            $username = $_SESSION['Username'];
            $sql = "SELECT Image FROM registration WHERE Username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $imagePath = $row["Image"];

                if (!empty($imagePath)) {
                    echo '<img src="' . $imagePath . '" alt="Profile Picture" class="profile-image">';
                } else {
                    // If no image uploaded, display a default image
                    echo '<img  alt="Default Profile Picture" class="profile-image">';
                }
            } else {
                // If user not found or no image available, display default image
                echo '<img  alt="Default Profile Picture" class="profile-image">';
            }
            ?>

            <p><?php echo $_SESSION['Username']; ?></p>

            <!-- Your existing sidebar content -->
            <a href="lostings.php" class="nav-link"></i> Report Lostings</a><br>
            <a href="foundings.php" class="nav-link"></i> Report Foundings</a><br>
            <a href="lostcard.php" class="nav-link"></i> My Lostings </a><br>
            <a href="foundcard.php" class="nav-link"></i> My Foundings</a><br>
            <a href="profile.php" class="nav-link"></i> profile</a><br>
            <!-- Logout link -->
            <a href="logout.php">Logout</a>
        </div>

        <div class="main-content">
            <!-- Your main content goes here -->
            <center><h1>Welcome to the LOTR <?php echo $_SESSION['Username'];?> You Are Successfully Logged In</h1></center>
            <section class="s1">
                <div class="main">
                    <!-- Content loaded dynamically by jQuery/AJAX -->
                </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".nav-link").click(function (e) {
                e.preventDefault();
                var page = $(this).attr("href");
                $.ajax({
                    url: page,
                    success: function (data) {
                        $('.main').html(data); // Update the content div
                    },
                    error: function () {
                        alert("An error occurred while loading content.");
                    }
                });
            });
        });
    </script>
</body>
</html>
