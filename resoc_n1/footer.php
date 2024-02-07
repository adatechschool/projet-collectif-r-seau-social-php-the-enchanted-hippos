
<small>♥ <?php echo $post['like_number'] ?></small>
    <?php
        $tagArray = explode(",", $post['taglist']);
        $tagIdArray = explode(",", $post['tagid']);
            for ($i = 0; $i < sizeof($tagArray); $i++) {
            echo '<a href="tags.php?tag_id=' . $tagIdArray[$i] . '">';
            echo "#" . $tagArray[$i] . " " . "</a>";
            }
    ?>
