<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pre_launch";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>