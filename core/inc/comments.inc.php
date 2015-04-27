<?php

    //Gets all comments for a blog post
    function getComments ($postID) {
        $postID = (int)$postID;

        $sql = "SELECT
                    `comment_body` AS `body`,
                    `comment_user` AS `user`,
                    DATE_FORMAT(`comment_date`, '%d/%m/%Y %H:%i:%s') AS `date`
                FROM `comments`
                WHERE `post_id` = {$postID}";

        //Perform the query
        $result = mysql_query($sql);

        //Define array
        $comments = array();
        //Loop over the results
        while (($row = mysql_fetch_assoc($result)) !== false){
            //Push the row (current comment) to the array
            $comments[] = $row;
        }

        return $comments;
    }

    //Adds a comment
    function addComment($postID, $user, $body) {

        //Validate the ID of the post
        if(valid_postID($postID) === false) {
            return false;
        }

        //Prevent SQL injections and XSS attacks
        $postID = (int)$postID;
        $user = mysql_real_escape_string(htmlentities($user));
        $body = mysql_real_escape_string(nl2br(htmlentities($body)));


        mysql_query("INSERT INTO `comments` (`post_id`, `comment_user`, `comment_body`, `comment_date`) VALUES ({$postID}, '{$user}', '{$body}', NOW())");

        //By default function return NULL so if the query succeeded we must return true (if doesn't the function returns false)
        return true;
    }

?>
