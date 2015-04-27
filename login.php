<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login page</title>
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
<div>
<div id="loginbox">
    <h2>Login Page</h2>
    <a href="index.php">Click here to go back</a><br/><br/>
    <form action="checkLogin.php" method="POST">
        Enter Username: <input type="text" name="username" required="required" /> <br/>
        Enter password: <input type="password" name="password" required="required" /> <br/>
        <input type="submit" value="Login"/>
    </form>
</div>
</div>
</body>
</html>