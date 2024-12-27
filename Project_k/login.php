<?php
$Login = 0;
$Invalid = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "select * from `registration` where Username = '$username' and Password = '$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $Login = 1;
            session_start();
            $_SESSION['Username'] = $username;
            header('location:dsb.php');
        } else {
            $Invalid = 1;
            echo "Invalid Credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script>
    <title>Login - Lost and Found System</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>Login</h1>
            <p>Sign in to your Lost and Found System account</p>
        </header>
        <div class="form-container">
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" name="Username" placeholder="Enter Your Username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="Password" placeholder="Enter Your Password"  required>
                    <span class="password-toggle" onclick="togglePasswordVisibility()">Show</span>
                </div>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="lotrsi.php">Sign up here</a></p>
        <p>Login as Admin <a href="adminlogin.php">Click Here here</a></p>
    </div>
</div>


    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordToggle = document.querySelector(".password-toggle");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.textContent = "Hide";
            } else {
                passwordField.type = "password";
                passwordToggle.textContent = "Show";
            }
        }
    </script>
</body>

</html>
