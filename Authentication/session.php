<?php
    include('db.php');

    session_start();

    //Check if user is logged in
    if(!$_SESSION['username'])
    {
        header('Location: ../index.html?message=No User Signed In');
    }
    
    //Set user to logged in state
    $userSession = $_SESSION['username'];
    $userInfoQuery = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `username`='$userSession' LIMIT 1;");
    $userInfo = mysqli_fetch_assoc($userInfoQuery);
?>