<?php
// photolensdb connection
    $servername="localhost";
    $uername="root"; // Your MySQL username
    $password=""; // Your MySQL password
    $dbname="photolensdb"; // The name of your database

    $conn = mysqli_connect($servername,$uername,$password,$dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
