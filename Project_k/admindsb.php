<!-- <?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location:adminlogin.php");
    exit();
}
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <style>
        /* Your existing CSS styles */
        /* ... */
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

        /* Additional styling for the header */
        section > div > h2 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-bottom: 20px;
        }



        /* Adjustments for the dashboard to appear on the left side */
        .container {
            display: flex;
            flex-direction: row;
            height: 100vh; /* Full height */
            position:relative;
        }

        .dashboard {
            position: fixed; /* Fix the dashboard on the left */
            top: 0;
            bottom: 0; /* Occupy full height */
            overflow-y: auto; /* Enable vertical scrolling if needed */
            width: 200px; /* Set a fixed width for the dashboard */
            z-index: 1; 
            background-color: #007bff;
            color:white;
            display: flex;
            flex-direction:column;
            padding: 20px;
            align-items: start;
            
        }

        .main-content {
            flex: 1; /* Allow the content to take remaining space */
            padding: 45px;
            margin-left: 240px; /* Adjust margin to accommodate the fixed dashboard */
            overflow-y: auto; 
        }


        .welcome {
           background-color: black;
           color: white;
           position: sticky;
           top: -48px;/* Ensure the div spans the full width */
           z-index: 1000; /* Set a positive z-index value */
           text-align: center; /* Center the content horizontally */
           padding:5px;
         }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard">
            <h2><font color="black">Lost and Found</font></h2>
            <!-- Your existing sidebar content -->
            <a href="adminfoundcard.php" class="nav-link"></i> Found Item</a><br>
            <a href="adminlostcard.php" class="nav-link"></i> Lost Item</a><br>
            <a href="" class="nav-link"></i> Membership</a><br>
            <a href="contactUs.html" class="nav-link"></i> Contact Us</a><br>
            <!-- Logout link -->
            <a href="logout.php">Logout</a>
        </div>

        <div class="main-content">
            <!-- Your main content goes here -->
            <div class="welcome">
            <center><h2>Welcome to the LOTR ADMIN <?php echo $_SESSION['username'];?> You Are Successfully Logged In</h2></center>
            </div>
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
