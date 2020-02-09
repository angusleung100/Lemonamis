<?php

//Database Credentials
$db_user = "root";
$db_pass = "";
$db_host = "localhost";
$db_name = "lemonamis";

//Connection
$db_connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("MySQL failed to connect :P");

?>