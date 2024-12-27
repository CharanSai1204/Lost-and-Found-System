<?php

$Success = 0;
$User = 0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];




    $sql = "select * from `registration` where Username = '$username'";
    $result = mysqli_query($con,$sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            echo "User Already Exists";
            $User=1;
        }
        else{
            $sql = "insert into `registration`(FirstName,LastName,Email,Username,Password)
            values('$firstname','$lastname','$email','$username','$password')";
            $result = mysqli_query($con,$sql);
            if($result){
                //echo "Signup Successful";
                $Success = 1;
                session_start();
                $_SESSION['Username']=$username;
                header('location:signinsuccess.php');
            }else{
                die(mysqli_error($con));
            }
        }
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="lotrsi.css">
    <title>Sign Up - Lost and Found System</title>
</head>
<body>


    <div class="container">
        <header>
            <h1>Sign Up</h1>
            <p>Create your Lost and Found System account</p>
        </header>
        <div class="form-container">
        <form action="lotrsi.php" method="post">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="FirstName"
                       placeholder="Enter Your First Name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="LastName"
                       placeholder="Enter Your Last Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="Email" 
                       placeholder="Enter Your Email Name"required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="Username" name="Username" 
                       placeholder="Enter Your Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="Password" name="Password" 
                       placeholder="Enter Your Password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Log in here</a></p>
        </div>
    </div>

  <?php
  if($User){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Ohh No Sorryyy!!!</strong> User Already Exists!! 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  ?>

<?php
  if($Success){
    echo '<div class="alert alert-sucess alert-dismissible fade show" role="alert">
    <strong>Hurrayyyy!!!</strong> You Are Successfully Signed Up!!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  ?>
</body>
</html> 