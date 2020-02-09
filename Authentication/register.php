<?php
    //Dependencies
    include("db.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $email = $_POST['email'];
    
    $register = $_POST['register'];

    //Register user
    if(isset($register))
    {
        //Check if user exists
        $sameNameQuery = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `username`='$username';");
        $sameNameCount = mysqli_num_rows($sameNameQuery);

        //Check if email exists
        $sameEmailQuery = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `email`='$email';");
        $sameEmailCount = mysqli_num_rows($sameEmailQuery);

        if($sameNameCount == 0 && $sameEmailCount == 0)
        {
            //Check if password is confirmed
            if($password == $confirm_password)
            {
                $registerUser = mysqli_query($db_connect, "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('$username', '$password', '$email');");
                if($registerUser)
                {
                    //Redirect to success page
                    echo '<script type="text/javascript">window.location="../successful-registration.html"</script>';
                }
                else
                {
                    echo '<script type="text/javascript">window.location="../index.html?message=Failed to register user on database side"</script>';
                }
                
            }
            else
            {
                echo '<script type="text/javascript">window.location="../index.html?message=Failed to register. Passwords do not match"</script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">window.location="../index.html?message=Failed to register user. Username or email exists"</script>';

        }
        
    }

?>