<html>
<head>
    <title>My first PHP Website</title>
</head>
<body>
<h2>Registration Page</h2>
    <a href="index.php">Click here to go back</a><br/><br/>
    <form action="register.php" method="POST">
        Enter Username: <input type="text" name="username" required="required" /> <br/>
        Enter password: <input type="password" name="password" required="required" /> <br/>
        <input type="submit" value="Register"/>
    </form>
</body>
</html>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']);

        $bool = true;

        //Connect to the server
        mysql_connect("localhost", "root", "") or die(mysql_error());

        //Connect to the database
        mysql_select_db("blog") or die("Cannot connect to database");

        //Query the users table
        $query = mysql_query("Select * from users");

        //Display all rows from query
        while ($row = mysql_fetch_array($query)) {
            $table_users = $row['username'];
            //Check if there are any matching fields
            if ($username == $table_users) {
                $bool = false;
                Print '<script>alert("Username has been taken!");</script>';
                Print '<script>window.location.assign("register.php");</script>';
            }
        }

        if ($bool) {
            mysql_query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
            Print '<script>alert("Successfully registered");</script>';
            Print '<script>window.location.assign("register.php");</script>';
        }
    }
?>