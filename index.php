<?php
    include('core/init.inc.php');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

    <div id="mainc">
    <h1>SPEND NOW SAVE NEVER</h1>
        <div id="reg">
            <a href="login.php"> Click here to login</a> <br/>
            <a href="register.php"> Click here to register</a>

        </div>

    <div id="header">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li><a href="shirts.php">SHIRTS</a></li>
        </ul>
    </div>

    <div id="posting">
        <?php
            $posts = getPosts();

            foreach ($posts as $post) {
                ?>
                <h2><a href="blogRead.php?postID=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                <h4>By <?php echo $post['user']; ?> on <?php echo $post['date'];?></h4>
                <h4>(<?php echo $post['total_comments'];?> comments, last comment: <?php echo $post['last_comment'];?>)</h4>
                <h4>Visits: <?php echo $post['visits']; ?></h4>


                <p><?php echo $post['preview']; ?></p>
                <hr/>
                <?php
            }
        ?>
    </div>
    </div>
</body>
</html>