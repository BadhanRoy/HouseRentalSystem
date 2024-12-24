<?php
    session_start();
    include_once "db.php";

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST['submit'])) {
        $houseName = $_POST['houseName'];
        $housePic = $_FILES['housePic'];
        $houseAddress = $_POST['houseAddress'];
        $houseDetails = $_POST['houseDetails'];
        $houseRent = $_POST['houseRent'];
        $houseContact = $_POST['houseContact'];

        $housePicName = $housePic['name'];
        $housePicTmpName = $housePic['tmp_name'];
        $housePicSize = $housePic['size'];
        $housePicType = $housePic['type'];
        $housePicExtension = explode('.', $housePicName);
        $housePicExtension = strtolower(end($housePicExtension));

        if ($housePicType != "image/jpeg" && $housePicType != "image/png" && $housePicType != "image/jpg") {
            $error = "File type must be JPEG, PNG, or JPG";
        } else {
            $housePicName = time(). "_". $housePic['name'];
            move_uploaded_file($housePicTmpName, "uploads/" . $housePicName);

            $sql = "INSERT INTO house (houseName, housePic, houseAddress, houseDetails, houseRent, houseContact) VALUES ('$houseName', '$housePicName', '$houseAddress', '$houseDetails', '$houseRent', '$houseContact')";
            if (mysqli_query($db, $sql)) {
                header("Location: viewdetails.php?houseId=" . mysqli_insert_id($db));
            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>House Rental Advertisement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, 
        .form-group textarea, 
        .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Post Your House for Rent</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="houseName">House Name:</label>
            <input type="text" id="houseName" name="houseName" placeholder="Enter the name of the house" required>
        </div>
        <div class="form-group">
            <label for="houseDetails">Rent:</label>
            <input type="number" id="houseRent" name="houseRent" placeholder="Enter the house rent" required>
        </div>
        <div class="form-group">
            <label for="housePic">House Picture:</label>
            <input type="file" id="housePic" name="housePic" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="houseAddress">House Address:</label>
            <input type="text" id="houseAddress" name="houseAddress" placeholder="Enter the house address" required>
        </div>
       
        <div class="form-group">
            <label for="houseContact">Contact Number:</label>
            <input type="text" id="houseContact" name="houseContact" placeholder="Enter the house contact" required>
        </div>
        <div class="form-group">
            <label for="houseDetails">House Details:</label>
            <textarea id="houseDetails" name="houseDetails" rows="5" placeholder="Enter house details such as number of rooms, facilities, etc." required></textarea>
        </div>
        <p class="error"><?php if (isset($error)) { echo $error; } ?></p>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit Ad">
        </div>
    </form>
</div>

</body>
</html>
