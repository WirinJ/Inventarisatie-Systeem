<?php

session_start();
unset($_SESSION["loggedInUser"]);
header("Location: login.php");

die("Uitgelogd, tot de volgende keer...");

?>