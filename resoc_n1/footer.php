   

    <form method="post"> 
    <input type="submit" name="<?php echo $post["postId"] ?>" class="button" value="J'♥"/> 
    <?php echo "<pre>" . print_r($_POST) . "</pre>" ?>;
    </form>



   <?php 
    if(isset($_POST[$post["postId"]])) { 
    echo "Post aimé";

    echo "<pre>" . print_r($post, 1) . "</pre>";

    $idDuPost = $post["postId"];


    $sql = "SELECT * FROM likes WHERE user_id = $currentUserId AND post_id = $idDuPost";
    $isLiked = $mysqli->query($sql);
    

    if ($isLiked->num_rows > 0) {
    }
    else {
   
    $ajoutjaime = "INSERT INTO likes "
                                . "(id, user_id, post_id) "
                                . "VALUES (NULL, "
                                . $currentUserId . ", "
                                . $idDuPost . ");"
                                ; 


    $ok = $mysqli->query($ajoutjaime);
    if ( ! $ok){
     echo "Post liké" . $mysqli->error;
    } else
    {
     echo "Post non liké";
    }
    }
}




?>
 <small>♥ <?php echo $post['like_number'] ?>
</small>

    

        <?php 
            $tagArray = explode(",", $post['taglist']);
            $tagIdArray = explode(",", $post['tagid']);
                for ($i = 0; $i < sizeof($tagArray); $i++) {
                echo '<a href="tags.php?tag_id=' . $tagIdArray[$i] . '">';
                echo "#" . $tagArray[$i] . " " . "</a>";
                }
        ?>