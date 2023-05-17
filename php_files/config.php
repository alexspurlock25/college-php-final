<?php

    session_start();

$con = mysqli_connect('ucfsh.ucfilespace.uc.edu', 'spurloag', 'Alex0897@uc', 'spurloag');
    // Check connections
    if (!$con) {

        die("connection failed: ".mysqli_connect_error());

    }
?>