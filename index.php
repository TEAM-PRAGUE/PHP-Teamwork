<?php
    include('core/init.inc.php');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <div id="reg">
        <a href="login.php"> Click here to login</a> <br/>
        <a href="register.php"> Click here to register</a>
    </div>
    <div>
        <?php
            $posts = getPosts();

            foreach ($posts as $post) {
                ?>
                <h2><a href="blogRead.php?postID=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                <h4>By <?php echo $post['user']; ?> on <?php echo $post['date'];?></h4>
                <h4>(<?php echo $post['total_comments'];?> comments, last comment: <?php echo $post['last_comment'];?>)</h4>
                <h4>Visits: <?php echo $post['visits']; ?></h4>

                <hr/>

                <p><?php echo $post['preview']; ?></p>
                <?php
            }
        ?>
    </div>
</body>
</html>