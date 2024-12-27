<?php
$Login=0;
$Invalid=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from `adminlogin` where username = '$username' and password = '$password'";
    $result = mysqli_query($con,$sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            $Login = 1;
            session_start();
            $_SESSION['username']=$username;
            header('location:admindsb.php');
        }
        else{
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
            <p>Login in to your Lost and Found Admin System account</p>
        </header>
        <form action="adminlogin.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" name="username" 
                placeholder="Enter Your Username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password"
                placeholder="Enter Your Password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="lotrsi.php">Sign up here</a></p>
        
    </div>
</body>
</html>
