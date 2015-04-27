<?php
    mysql_connect("localhost", "root", "") or die(mysql_error());
    mysql_select_db('blog');
    include('inc/posts.inc.php');
    include('inc/comments.inc.php');
?>
