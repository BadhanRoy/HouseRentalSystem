<?php
    $db = mysqli_connect("localhost","root","","house_rental");
    if(!$db){
        echo mysqli_error($db);
    }
?>