<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Logged user</title>
    <link rel="stylesheet" href="style.css"/>
</head>
    <?php
        session_start(); //starts the session
        if($_SESSION['user']){ // checks if the user is logged in
        }
        else{
            header("location: index.php"); // redirects if user is not logged in
        }
        $user = $_SESSION['user']; //assigns user value
    ?>
<body>
<div id="log">
    <h2>Home Page</h2>
    <div id="header">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li><a href="shirts.php">SHIRTS</a></li>
        </ul>
    </div>
    <a href="logout.php">Click here to go logout</a><br/><br/>
    <p>You are logged!</p>
</div>
</body>
</html>
    