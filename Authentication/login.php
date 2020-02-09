<?php
    //Dependencies
    include("db.php");

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    //$confirm_password = $_POST['confirm-password'];
    $login = $_POST['login'];

    //Login user
    if(isset($login))
    {
        $loginQuery = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `username`='$username';");
        $loginQueryReturn = mysqli_fetch_assoc($loginQuery);

        if($loginQueryReturn['username'] == $username & $loginQueryReturn['password'] == $password)
        {
            $_SESSION['username'] = $username;  //Set user
            echo '<script type="text/javascript">window.location="../Garden/front.php"</script>';
        }
        else
        {
            echo "Failed, wrong credentials"; 
        }
    }

?>