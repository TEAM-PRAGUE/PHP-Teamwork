<?php

   //Checks if the post is in the table
    function valid_postID($postID) {

        //Typecast the postID as integer (prevent SQL injections)
        $postID = (int)$postID;

        //Count the number of rows with that postID (possible values 0 or 1 because the postID is unique)
        $total = mysql_query("SELECT COUNT(`post_id`) FROM `posts` WHERE `post_id` = {$postID}");

        //Get the result for total rows (0 is the row number)
        $total = mysql_result($total, 0);

        //Compare the result against 1 to see if the post ID is valid
        if ($total != 1) {
            //Invalid post ID
            return false;
        } else {
            //Valid post ID
            return true;
        }
    }

    //Gets all blog posts
    function getPosts() {

        $sql =  "SELECT
                    `posts`.`post_id` AS `id`,
                    `posts`.`post_visits` AS `visits`,
                    `posts`.`post_title` AS `title`,
                    LEFT (`posts`.`post_body`, 512) AS `preview`,
                    `posts`.`post_user` AS `user`,
                    DATE_FORMAT(`posts`.`post_date`, '%d/%m/%Y %H:%i:%s') AS `date`,
                    `comments`.`total_comments`,
                    DATE_FORMAT(`comments`.`last_comment`, '%d/%m/%Y %H:%i:%s') AS `last_comment`
                    FROM `posts`
                    LEFT JOIN (
                      SELECT
                            `post_id`,
                            COUNT(`comment_id`) AS `total_comments`,
                            MAX(`comment_date`) AS `last_comment`
                        FROM `comments`
                        GROUP BY `post_id`
                    ) AS `comments`
                    ON `posts`.`post_id` = `comments`.`post_id`
                    ORDER BY `posts`.`post_date` DESC";

        //Query to get all posts
        $posts = mysql_query($sql);

        //Create array for all the query results
        $rows = array();

        //Loop over the query result and put the data in the rows array
        while (($row = mysql_fetch_assoc($posts)) !== false) {

            //Add new value to the rows array
            $rows[] = array (
                'id'                => $row['id'],
                'title'             => $row['title'],
                'preview'           => $row['preview'],
                'user'              => $row['user'],
                'date'              => $row['date'],
                'visits'            => $row['visits'],
                'total_comments'    => ($row['total_comments'] === null) ? 0 : $row['total_comments'],
                'last_comment'      => ($row['last_comment'] === null) ? 'No last comment' : $row['last_comment']
            );
        }

        return $rows;
    }

    //Gets a single post from the table
    function getPost($postID) {
        $postID = (int)$postID;

        $sql = "SELECT
                    `post_title` AS `title`,
                    `post_body` AS `body`,
                    `post_user` AS `user`,
                    `post_date` AS `date`,
                    `post_visits` AS `visits`
                 FROM `posts`
                 WHERE `post_id` = {$postID}";

        $post = mysql_query($sql);

        //Gets the result (creates array which will have 4 keys (title, body, user, date) and 4 values (post_title, post_body, post_user, post_date)
        $post = mysql_fetch_assoc($post);

        //Add the comments to the post
        $post['comments'] = getComments($postID);

        return $post;
    }

    //Adds a new blog post
    function addPost($name, $title, $body) {
        //Prevent SQL injections and XSS attacks and create new lines for the body
        $name = mysql_real_escape_string(htmlentities($name));
        $title = mysql_real_escape_string(htmlentities($title));
        $body = mysql_real_escape_string(nl2br(htmlentities($body)));

        //Insert the data into the table
        mysql_query("INSERT INTO `posts` (`post_user`, `post_title`, `post_body`, `post_date`) VALUES ('{$name}', '{$title}', '{$body}', NOW())");
    }
?>