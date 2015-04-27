<?php
    include('core/init.inc.php');
    //Process the input form for the comment (Check if the comment is submited)
    if (isset($_GET['postID'], $_POST['user'], $_POST['body'])) {
        if (addComment($_GET['postID'], $_POST['user'], $_POST['body'])) {

            //Redirect to the current page
            header("Location: blogRead.php?postID={$_GET['postID']}");
        } else {
            header("Location: index.php");
        }

        //Kill the script because we don't wont to execute the below code after redirection
        die();
    }
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Read the post</title>
</head>
<body>
    <div>
        <?php

        //Check if the post ID is specified and valid
        if (isset($_GET['postID']) === false || valid_postID($_GET['postID']) === false){
            echo 'Invalid post ID.';
        } else {


            //mysql_query("UPDATE posts SET post_visits = post_visits + 1 WHERE post_id = {$_GET['postID']}");
            mysql_query("UPDATE `posts` SET `post_visits` = `post_visits` + 1 WHERE `post_id` = {$_GET['postID']}");
            //Get the post data
            $post = getPost($_GET['postID']);

            ?>

            <h2><?php echo $post['title']; ?></h2>
            <h4>By <?php echo $post['user']; ?> on <?php echo $post['date']; ?> (<?php echo count($post['comments']); ?> comments)</h4>

            <hr/>

            <p><?php echo $post['body'];?></p>

            <hr/>

            <p>Comments</p>
            <?php

            foreach ($post['comments'] as $comment) {
                ?>
                <h4>By <?php echo $comment['user']; ?> on <?php echo $comment['date']; ?></h4>
                <p><?php echo $comment['body']; ?></p>
                <hr/>
                <?php
            }

            ?>
            <p>Add new comment</p>
            <form action="" method="post">
                <p>
                    <label for="user">Name</label>
                    <input type="text" name="user" id="user"/>
                </p>

                <p>
                    <textarea name="body" cols="60" rows="20"></textarea>
                </p>

                <p>
                    <input type="submit" value="Add comment"/>
                </p>
            </form>

            <?php
        }
        ?>
    </div>
</body>
</html>