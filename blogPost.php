<?php
    include('core/init.inc.php');

    //Check if the form is submited
    if (isset($_POST['user'], $_POST['title'], $_POST['body'])){
        addPost($_POST['user'], $_POST['title'], $_POST['body']);

        //Redirect to index.php
        header("Location: index.php");

        //Kill the script so we don't execute the below code after redirection
        die();
    }
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Add new post</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<div id="header">
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="contact.php">CONTACT</a></li>
        <li><a href="shirts.php">SHIRTS</a></li>
    </ul>
</div>
    <form action="" method="post">
        <p>
            <label for="user">Name</label>
            <input type="text" name="user" id="user"/>
        </p>
        <p>
            <label for="title">Title</label>
            <input type="text" name="title" id="title"/>
        </p>
        <p>
            <textarea name="body" cols="60" rows="20"></textarea>
        </p>
        <p>
            <input type="submit" value="Add post"/>
        </p>
    </form>
</body>
</html>