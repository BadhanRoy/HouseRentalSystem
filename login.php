<?php
session_start();
include_once "db.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $error = "";

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, md5($_POST['password']));

    $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: index.php");
    }else{
        $error = "Wrong email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />

    <title>Sweet Home</title>
    <!--ADING CSS HERE-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <!--Header Starts HERE-->
    <header class="header">
        <div class="wrapper">
            <h1>Sweet Home</h1>
        </div>

    </header>
    <!--Header Ends HERE-->



    <!--Main Body Starts HERE-->
    <div class="main">
        <div class="wrapper">


            <!--Contact Detail Entry-->
            <div class="booking-details">
                <h3>Log In</h3>
                <form action="" method="POST">
                    <span class="name">Username</span>
                    <input type="text" name="username" placeholder="Username Please" required="true" /><br />

                    <span class="name">Password</span>
                    <input type="password" name="password" placeholder="Password Please" required="true" /><br />
                    <p class="error"><?php if(isset($error)) { echo $error; }  ?></p>
                    <input type="submit" name="submit" placeholder="LOG IN" />
                    <input type="reset" name="reset" placeholder="RESET" /><br />
                    <a href="index.html">Go Home</a>
                </form>
            </div>
        </div>
    </div>
    <!--Main Body Ends HERE-->

    <!--Footer Starts HERE-->
    <footer class="footer">
        <div class="wrapper">
            <p>&copy; <a href="#">Sweet Home</a>. All rights reserved 2024.</p>
        </div>
    </footer>
    <!--Footer Ends HERE-->
</body>

</html>