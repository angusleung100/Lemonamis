<?php
    include('../Authentication/session.php');

    //Delete Post
    if(isset($_GET['id']))
    {
        $postID = $_GET['id'];

        //Retrieve Post Info
        $retrievePostInfo = mysqli_query($db_connect, "SELECT * FROM `posts` WHERE `id`='$postID';");
        $postInfo = mysqli_fetch_assoc($retrievePostInfo);

        if($postInfo['author'] == $userSession)
        {
            $deleteAction = mysqli_query($db_connect, "DELETE FROM `posts` WHERE `id`='$postID';");
            if($deleteAction)
            {
                echo '<script type="text/javascript">window.location="../Garden/profile.php?message=Deleted Post Successfully"</script>';
            }
            else
            {
                echo '<script type="text/javascript">window.location="../profile.php?message=Failed to delete from server side"</script>';
            }
        }
    }
?>