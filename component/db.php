<?php
    //step 1: Establish database connection
    DEFINE("DB_HOST", 'localhost');
    DEFINE("DB_USER", 'root');
    DEFINE("DB_PASS", '');
    DEFINE("DB_NAME", 'mangakakalot');
    // Create connection
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Set charset to UFT8
    mysqli_set_charset($con, "utf8");
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>