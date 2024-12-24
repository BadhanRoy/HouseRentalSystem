<?php
session_start();
include_once "db.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $houseId = intval($_POST['houseId']);
    $status = intval($_POST['status']); 
    mysqli_query($db, "UPDATE house SET status = '$status' WHERE id = '$houseId'");
}

$sql = "SELECT * FROM house WHERE status = 2";
$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .btn {
            padding: 8px 16px;
            margin: 5px;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }
        .accept {
            background-color: #4CAF50;
            color: white;
        }
        .reject {
            background-color: #f44336;
            color: white;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Panel - Landlord Details</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Landlord ID</th>
                <th>Information</th>
                <th>House Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>    
                    <td>Contact: <?php echo $row['houseContact']; ?></td>
                    <td><?php echo $row['houseName']; ?>, Location: <?php echo $row['houseAddress']; ?></td>
                    <td>
                    <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="houseId" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn accept">Accept</button>
                        </form>
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="houseId" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="3">
                            <button type="submit" class="btn reject">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
</div>

</body>
</html>
