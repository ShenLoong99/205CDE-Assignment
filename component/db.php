<?php
    //step 1: Establish database connection
    DEFINE("DB_HOST", 'localhost');
    DEFINE("DB_USER", 'root');
    DEFINE("DB_PASS", '');
    DEFINE("DB_NAME", 'mangakakalot');
    // Create connection
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>