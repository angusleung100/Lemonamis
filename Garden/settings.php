<?php include('../Authentication/session.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Meta -->
  <meta charset="utf-8">
  <title>Lemonamis - Settings</title>
  <meta name="description" content="uOttaHack 3 Project... because we can :)">
  <meta name="author" content="Team Lemonamis">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="../images/lemonamis-logo.png">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/skeleton.css">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

</head>
<body>

  <div class="container">
    
    <!-- Header -->
    <div class="row" style="margin-top: 2%;">
      <div class="two columns">
      <a href="front.php"><img src="../images/lemonamis-logo.png" width="100%"></a>
      </div>
      <div class="ten columns" style="margin-top: 1%">
        
        <h3>Lemonamis</h3>
      
      </div>
    
    </div>

    <?php
      //Retrieve total posts
      $totalPostsQuery = mysqli_query($db_connect, "SELECT * FROM `posts` WHERE `author`='$userSession';");
      $totalPostsRetrieve = mysqli_num_rows($totalPostsQuery);
    ?>
    
    
    <div class="row" style="margin-top: 50px;">
      <div class="three columns">
      <table class="u-full-width">
        <img src="../images/no-pic.png" height="200px" width="200px" style="text-align: center;">
        <tbody>
        <tr><td><b>Name: </b><?php echo $userInfo['username']; ?></td></tr>
        <tr><td><b>Total Posts: </b> <?php echo $totalPostsRetrieve; ?></td></tr>
        <tr><td><b>Popularity: </b></td></tr>
        <!-- <tr><td><b>Total Friends: </b></td></tr> -->
        <tr><td>> <a href="../Garden/post.php">Create Post</a></td></tr>
        <!-- <tr><td>> Add Friend</td></tr> -->
        <tr><td>> <a href="../Garden/profile.php">Profile</a></td></tr>
        <tr><td>> <a href="../Garden/settings.php">Settings</a></td></tr>
        <tr><td>> <a href="../Authentication/logout.php">Logout</a></td></tr>
        </tbody>
      </table>
        
      <?php
        //Update Settings

        if(isset($_POST['update-settings']))
        {
          $newEmail = $_POST['email'];
          $newPassword = $_POST['password'];
          $confirmPassword = $_POST['confirm-password'];
          $newPicture = $_POST['picture'];

          if(isset($newEmail) && ($newEmail != $userInfo['email']))
          {
            $updateEmailQuery = mysqli_query($db_connect, "UPDATE `users` SET `email`='$newEmail' WHERE `username`='$userSession'");
            if($updateEmailQuery)
            {
              echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Settings Updated Successfully"</script>';
            }
            else
            {
              echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Failed to update settings on server side"</script>';
            }
          }

          if($newPassword != "")
          {
            if($newPassword == $confirmPassword)
            {
              $updatePasswordQuery = mysqli_query($db_connect, "UPDATE `users` SET `password`='$newPassword' WHERE `username`='$userSession'");
              if($updatePasswordQuery)
              {
                echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Settings Updated Successfully"</script>';
              }
              else
              {
                echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Failed to update settings on server side"</script>';

              }
            }
            else
            {
              echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Failed to update settings. Passwords do not match."</script>';

            }
          }
          
          if($newPicture != "")
          {
            $updatePictureQuery = mysqli_query($db_connect, "UPDATE `users` SET `profile_picture`='$newPicture' WHERE `username`='$userSession'");
              if($updatePictureQuery)
              {
                echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Settings Updated Successfully"</script>';
              }
              else
              {
                echo '<script type="text/javascript">window.location="../Garden/settings.php?message=Failed to update settings on server side"</script>';

              }
          }
        }

      ?>
      
      </div>
      <div class="nine columns">
        <h3>Settings</h3>
        <hr>
        <form action="settings.php" method="POST">
          <div class="twelve columns">
            <label>Email:</label>
            <input class="u-full-width" type="text" name="email" value="<?php echo $userInfo['email']; ?>">
            <label>New Profile Picture URL:</label>
            <input class="u-full-width" type="text" name="picture" value="">
            <label>New Password:</label>
            <input class="u-full-width" type="password" name="password" value="">
            <label>Confirm New Password:</label>
            <input class="u-full-width" type="password" name="confirm-password" value="">
            <input type="submit" class="button-primary" value="Update Settings" name="update-settings">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
