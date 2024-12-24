<?php
session_start();
include_once "db.php";

 $sql = "SELECT * FROM house WHERE status = 1 ORDER BY createdAt DESC LIMIT 4";
 $sql2 = "SELECT * FROM house WHERE status = 1 ORDER BY id DESC";
 $result = mysqli_query($db, $sql);
 $result2 = mysqli_query($db, $sql2);
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />

    <title>HOUSE RENTAL SYSTEM</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!--Resource Files for Slider-->
    <!-- Start WOWSlider.com HEAD section -->
    <link rel="stylesheet" type="text/css" href="assets/slider/engine1/style.css" />
    <script type="text/javascript" src="assets/slider/engine1/jquery.js"></script>
    <!-- End WOWSlider.com HEAD section -->
</head>

<body>
    <!--Header Starts HERE-->
    <header class="header">
        <div class="wrapper">
            <h1>Sweet Home</h1>
        </div>

    </header>
    <!--Header Ends HERE-->

    <!--Menu Starts HERE-->
    <nav class="menu">
        <div class="wrapper">
            <ul>
                <a href="index.html">
                    <li>Home</li>
                </a>
                <a href="about.html">
                    <li>About Us</li>
                </a>
                <a href="#">
                    <li>Houses</li>
                </a>
                <a href="contact.html">
                    <li>Contact Us</li>
                </a>
                <?php if (!isset($_SESSION['id'])) { ?>
                    <a href="login.php">
                    <li>Log In</li>
                </a>
                <?php } else if($_SESSION['role'] == 'admin'){ ?>
                    <a href="admin.php">
                    <li>House List</li>
                </a>
                    <?php } else{ ?>
                        <a href="addhouse.php">
                    <li>Add House</li>
                </a>
                    
                <p><?php if(isset($_SESSION['id']))  echo $_SESSION['name']; ?></p>
                <?php
                    } ?>
                
                    <?php if (isset($_SESSION['id'])) { ?>
                    <a href="logout.php">
                    <li>Log Out</li>
                </a>
                
                <?php } ?>
            </ul>
        </div>
    </nav>
    <!--Menu Ends HERE-->

    <!--slide-->
    <div class="slider">
        <div class="wrapper">
            <!-- slide body-->
            <div id="wowslider-container1">
                <div class="ws_images">
                    <ul>
                        <li><img src="assets/slider/data1/images/house03.jpg" alt="Sweet Home" title="Sweet Home"
                                id="wows1_0" /></li>
                        <li><a href="http://wowslider.net"><img src="assets/slider/data1/images/pexelsphoto186077.jpg"
                                    alt="jquery carousel" title="Luxury Houses for Rent" id="wows1_1" /></a></li>
                        <li><img src="assets/slider/data1/images/39f6e0639465c7e01eaa79e26ada2a48.jpg"
                                alt="Rent Houses at Affordable Price" title="Rent Houses at Affordable Price"
                                id="wows1_2" /></li>
                    </ul>
                </div>
                <div class="ws_bullets">
                    <div>
                        <a href="#" title="Sweet Home"><span><img src="assets/slider/data1/tooltips/house03.jpg"
                                    alt="Sweet Home" />1</span></a>
                        <a href="#" title="Luxury Houses for Rent"><span><img
                                    src="assets/slider/data1/tooltips/pexelsphoto186077.jpg"
                                    alt="Luxury Houses for Rent" />2</span></a>
                        <a href="#" title="Rent Houses at Affordable Price"><span><img
                                    src="assets/slider/data1/tooltips/39f6e0639465c7e01eaa79e26ada2a48.jpg"
                                    alt="Rent Houses at Affordable Price" />3</span></a>
                    </div>
                </div>
                <div class="ws_shadow"></div>
            </div>
            <script type="text/javascript" src="assets/slider/engine1/wowslider.js"></script>
            <script type="text/javascript" src="assets/slider/engine1/script.js"></script>
            <!-- slide  -->
        </div>
    </div>
    <!--SLIDER ENDS HERE-->

    <!--body-->
    <div class="main">
        <div class="wrapper">
            <h3>Recently Added</h3>

            <!--recent house-->
            <div class="clearfix">

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                <div class="houses">
                    <img src="uploads/<?php echo $row['housePic']; ?>" />
                    <span class="house-title"><?php echo $row['houseName']; ?></span><br />
                    <span class="house-added">Added Date: <?php echo $row['createdAt']; ?></span><br />
                    <span class="house-location">Location: <?php echo $row['houseAddress']; ?></span><br />
                    <a type="button" class="btn-book" href="viewdetails.php?houseId=<?php echo $row['id']; ?>">Book House</a>
                </div>
            <?php
                }
            }
            ?>
            </div>

            <h3>Luxurious Houses</h3>
            <!--Display House-->
            <div class="clearfix">

            <?php
            if (mysqli_num_rows($result2) > 0) {
                while ($row = mysqli_fetch_assoc($result2)) {
                    ?>

                <div class="houses">
                    <img src="uploads/<?php echo $row['housePic']; ?>" />
                    <span class="house-title"><?php echo $row['houseName']; ?></span><br />
                    <span class="house-added">Added Date: <?php echo $row['createdAt']; ?></span><br />
                    <span class="house-location">Location: <?php echo $row['houseAddress']; ?></span><br />
                    <a type="button" class="btn-book" href="viewdetails.php?houseId=<?php echo $row['id']; ?>">Book House</a>
                </div>
            <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
    <!-- Body -->

    <!--Footer-->
    <footer class="footer">
        <div class="wrapper">
            <p>&copy; <a href="#">Sweet Home</a>. All rights reserved 2024 </p>
        </div>
    </footer>
    <!--Footer Ends HERE-->
</body>

</html>