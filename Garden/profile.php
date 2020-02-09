<?php include('../Authentication/session.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Meta -->
  <meta charset="utf-8">
  <title>Lemonamis - <?php echo $userSession; ?>'s Profile</title>
  <meta name="description" content="uOttaHack 3 Project... because we can :)">
  <meta name="author" content="Team Lemonamis">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="../images/lemonamis-logo.png">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/skeleton.css">

  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

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
        

      
      </div>
      <div class="nine columns">
        <h3><?php echo $userSession; ?>'s Posts</h3>
        <hr>
        <table class="u-full-width" style="display: block; overflow-y: auto; height: 600px;">
        
        <?php
          $retrieveUserPosts = mysqli_query($db_connect, "SELECT * FROM `posts` WHERE `author`='$userSession';");
          
          if(mysqli_num_rows($retrieveUserPosts) == 0)
          {
            echo "<h2>No posts to show!</h2>";
          }
          
          while($postMeta = mysqli_fetch_assoc($retrieveUserPosts))
          {
            echo "<tr>";
            echo "<td>";
            echo "<b>" . $userSession . ": </b>";
            echo "<p>" . $postMeta['content'] . "</p>";
            echo "<a href='delete-post.php?id=" . $postMeta['id'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
            
          }
        ?>
        
        </table>
      </div>
    </div>
  </div>

</body>
</html>
