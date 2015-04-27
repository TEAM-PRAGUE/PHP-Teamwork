<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Logged user</title>
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
    <h2>Home Page</h2>

    <a href="logout.php">Click here to go logout</a><br/><br/>
    <p>You are logged!</p>

</body>
</html>
    