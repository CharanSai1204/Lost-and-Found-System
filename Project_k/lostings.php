<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "signupforms");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Handling file upload
    $image = $_FILES['image']['name'];
    $target_dir = "LostUploads/"; // Change this to your desired directory
    $target_file = $target_dir . basename($_FILES['image']['name']);

    // Move uploaded file to the specified directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO `LostItems` (Name, ID_number, Email, Phone, ItemName, ItemType, ItemColor, Description, Date, Location, Image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $name, $idnumber, $email, $phone, $itemname, $itemtype, $itemcolor, $description, $date, $location, $image);

        if (mysqli_stmt_execute($stmt)) {
            echo '<div class="success-message">Data Entered Successfully</div>'; 
           } else {
            echo "Error: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error uploading file";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: black;
    text-align: center;
    color:white;
  
}


.success-message {
    color: green; /* Change this to the desired color for the success message */
    font-weight: bold;
}



@keyframes fadeInUp {
from {
opacity: 0;
transform: translateY(100px);
}
to {
opacity: 1;
transform: translateY(0);
}
}



.container {
    background-color: black;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    /* margin: 10px auto; */
    /* padding: 10px; */
    /* border-style: solid;
    border-color: #007bff; */
    position: relative;
    /* margin-left: 770px; */
}

label {
    position:static;
    /* display: block; */
    color: white;
    margin-top: 10px;
    text-align: left;
}

input[type="text"],
textarea,
input[type="date"] {
    width: 130%;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
}

textarea {
    resize: vertical;
}

.btn-container {
    text-align: center;
    margin-top: 20px;
}

.btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

    .success-message {
            color: green; /* Change this to the desired color for the success message */
            font-weight: bold;
            font-size:30px;
        }


    .para{
        width:300px;
        height:500px;
        font-size:40px;
        padding-right:70px;
        padding-left:-250px;

    }

    .whole_con{
        display:flex;
        flex-direction:rows;
        align-items:center;
        justify-content:center;
    }


    h1{
        margin-right:50px;
    }
    </style>
    <title>Lost and Found Inquiry</title>
</head>

<body>
<h1>Lost Item Inquiry Form</h1>

<div class="whole_con">

<div class="para">
        <p>What Have'u LOST Today</p>
        <p>let Us Know and let's find it</p>
        <p>TOGETHER</p>
    </div>


    <div class="container" id="mydiv">
        <form action="lostings.php" method="post" enctype="multipart/form-data">
            <table>
            <tr>
                    <td><label for="name"> Name:</label></td>
                    <td><input type="text" id="name" name="Name" required></td>
                </tr>
                <tr>
                    <td><label for="ID">ID Number:</label></td>
                    <td><input type="text" id="id" name="ID_Number" required ></td>
                </tr>


                <tr>
                    <td> <label for="email">Email:</label></td>
                    <td><input type="text" id="name" name="Email" required></td>
                </tr>
                
                <tr>
                    <td><label for="mobile">Phone:</label></td>
                    <td> <input type="text" id="mobile" name="Phone" required ></td>
                </tr>
                
                <tr>
                    <td><label for="item_name">Item Name:</label></td>
                    <td> <input type="text" id="item_name" name="ItemName" required></td>
                </tr>
            
                <tr>
                    <td><label for="item_type">Item type:</label></td>
                    <td> <input type="text" id="item_name" name="ItemType" ></td>
                </tr>
                   
                <tr>
                    <td><label for="item_color">Item color:</label></td>
                    <td> <input type="text" id="item_color" name="ItemColor" required></td>
                </tr>
            
                <tr>
                    <td> <label for="description">Description:</label></td>
                    <td> <textarea id="description" name="Description" rows="4"></textarea></td>
                </tr>
            
                <tr>
                    <td><label for="date_lost">Date Lost:</label></td>
                    <td> <input type="date" id="date_lost" name="Date" required></td>
                </tr> 
            
                <tr>
                    <td><label for="location_lost">Location Lost:</label></td>
                    <td> <input type="text" id="location_lost" name="Location" required></td>
                </tr>


                <tr>
                    <td><label for="image">Image:</label></td>
                    <td><input type="file" name="image" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="btn-container">
                            <input type="submit" value="Submit Inquiry" name="upload" class="btn">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>



</div>

</body>

</html>
