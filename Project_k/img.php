<?php
$msg = "";
// If upload button is clicked ...
if (isset($_POST['upload'])) {
    // Path to store the uploaded image
    $target = "images/" . basename($_FILES['image']['name']);

    // Establish database connection (Replace credentials with your own)
    $con = mysqli_connect("localhost", "root", "", "signupforms");

    // Check if the connection was successful
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Get the data submitted from the form 
    $image = $_FILES['image']['name'];
    $text = $_POST['image_text']; // Change to 'image_text'

    // SQL query with prepared statement to prevent SQL injection
    $sql = "INSERT INTO images (image, text) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $image, $text);
    mysqli_stmt_execute($stmt);

    // Check if the image was successfully uploaded
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <style type="text/css">
        /* CSS styles */
    </style>
</head>
<body>
    <div id="content">
        <form method="POST" action="img.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea 
                    id="text" 
                    cols="40" 
                    rows="4" 
                    name="image_text" 
                    placeholder="Say something about this image..."></textarea>
            </div>
            <div>
                <button type="submit" name="upload">POST</button>
            </div>
        </form>
    </div>
</body>
</html>





<?php
$con = mysqli_connect("localhost","root","","signupforms");
if($_SERVER['REQUEST_METHOD']=='POST'){
    // include 'connect.php';
    $name = $_POST['Name'];
    $idnumber = $_POST['ID_Number'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $itemname = $_POST['ItemName'];
    $itemtype = $_POST['ItemType'];
    $itemcolor = $_POST['ItemColor'];
    $description = $_POST['Description'];
    $date = $_POST['Date'];
    $location = $_POST['Location'];
    $image = $_POST['Image'];
    $sql = "insert into `LostItems`(Name,ID_number,Email,Phone,ItemName,ItemType,ItemColor,Description,Date,Location,Image)
    values('$name','$idnumber','$email','$phone','$itemname','$itemtype','$itemcolor','$description','$date','$location','$image')";
    $result = mysqli_query($con, $sql);    
    if($result){
        echo "Data Entered Successfully";
    }else{
        die(mysqli_error($con));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="lostings.css">
    <title>Lost and Found Inquiry</title>
</head>
<head>
<body>
<div class="para">
      <p >What Have'u LOST Today</p>
      <p >let Us Know and let's find it</p>
      <p >TOGETHER</p>
</div>   


<h1>Lost Item Inquiry Form</h1>
<div class="container" id="mydiv">
    <form action="lostings.php" method="post" enctype="multipart/form-data>
    <table>
    <tr><td> <label for="name"> Name:</label></td>
    <td><input type="text" id="name" name="Name" required></td></tr>
    <tr><td><label for="ID">ID Number:</label></td>
    <td> <input type="text" id="id" name="ID_Number" required ></td></tr>
    
    <tr><td> <label for="email">Email:</label></td>
    <td><input type="text" id="name" name="Email" required></td></tr>
    
    <tr><td><label for="mobile">Phone:</label></td>
    <td> <input type="text" id="mobile" name="Phone" required ></td></tr>
    
    <tr><td><label for="item_name">Item Name:</label></td>
    <td> <input type="text" id="item_name" name="ItemName" required></td></tr>

    <tr><td><label for="item_type">Item type:</label></td>
    <td> <input type="text" id="item_name" name="ItemType" ></td></tr>
       
    <tr><td><label for="item_color">Item color:</label></td>
    <td> <input type="text" id="item_color" name="ItemColor" required></td></tr>

    <tr><td> <label for="description">Description:</label></td>
    <td> <textarea id="description" name="Description" rows="4"></textarea></td></tr>

    <tr><td>  <label for="date_lost">Date Lost:</label></td>
    <td> <input type="date" id="date_lost" name="Date" required></td></tr> 

    <tr><td> <label for="location_lost">Location Lost:</label></td>
    <td> <input type="text" id="location_lost" name="Location" required></td></tr>

    <tr><td> <label for="location_lost">Image:</label></td>
    <td><input type="file" name="image"></td></tr>

    <tr><td> </td><td><div class="btn-container">
    <input type="submit" value="Submit Inquiry" name="upload"  class="btn"></td></tr>

    </div>
    </table>
    </form>
</div>


</body>
</html>