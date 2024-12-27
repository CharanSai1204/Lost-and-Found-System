<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:lotrsi.php');
}
?>

<?php
echo"You are Successfully Signed Up";
?>