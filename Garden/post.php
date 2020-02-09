<?php include('../Authentication/session.php'); ?>


<?php

  if(isset($_POST['post']))
  {
    $postContent = $_POST['content'];
  
    $postAuthor = $userSession;

    $postQuery = mysqli_query($db_connect, "INSERT INTO `posts`(author, content) VALUES ('$postAuthor', '$postContent');");
    
    if($postQuery)
    {
      echo '<script type="text/javascript">window.location="../Garden/front.php"</script>';
    }
    else
    {
      echo '<script type="text/javascript">window.location="../Garden/front.php?message=Failed To Post On Server Side"</script>';
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Meta -->
  <meta charset="utf-8">
  <title>Lemonamis - Write a post</title>
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
        <tr><td>> Settings</td></tr>
        <tr><td>> <a href="../Authentication/logout.php">Logout</a></td></tr>
        </tbody>
      </table>
        
      </div>
      <div class="nine columns">
        <form action="post.php" method="POST">
            <label>Content: </label>
            <input class="u-full-width" type="text" name="content">
            <input type="submit" class="button-primary" value="Post" name="post">
        </form>
      </div>
    </div>
  </div>

</body>
</html>
