<?php 
session_start();
include_once "db.php";

if (isset($_GET['houseId'])) {
    $houseId = $_GET['houseId'];
    $sql = "SELECT * FROM house WHERE id = $houseId";
    $result = mysqli_query($db, $sql);
    $house = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .house-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .details {
            padding: 20px;
        }

        .details h2 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }

        .details p {
            margin: 10px 0;
            font-size: 18px;
            color: #555;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="uploads/<?php echo $house['housePic']; ?>" alt="House Picture" class="house-image">
    <div class="details">
        <h2><?php echo $house['houseName']; ?></h2>
        <p><strong>Address:</strong> <?php echo $house['houseAddress']; ?></p>
        <p><strong>Details:</strong> <?php echo $house['houseDetails']; ?></p>
        <p><strong>Rent:</strong> $<?php echo $house['houseRent']; ?>/month</p>
        <p><strong>Contact:</strong> <?php echo $house['houseContact']; ?></p>
        <a href="index.php" class="back-button">Back to Listings</a>
    </div>
</div>

</body>
</html>
