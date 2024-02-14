    <!-- formulaire pour créer un bouton "like"
    récupère l’id du post grâce à la requête SQL présente sur les pages concernées-->
    <form method="post"> 
        <input type="submit" name="<?php echo $post["postId"] ?>" class="button" value="J'♥"/> 
    </form>

    <!-- récupère l’id du post grâce à la super variable $_POST  -->
   <?php 
    if(isset($_POST[$post["postId"]])) { 
    
    //stock l’id du post pour le réutiliser plus tard
    $idDuPost = $post["postId"];

    //requête pour savoir si il existe déjà un like sur ce post en comparant les user_id et post_id et vérifier si la ligne existe
    $sql = "SELECT * FROM likes WHERE user_id = $currentUserId AND post_id = $idDuPost";
    $isLiked = $mysqli->query($sql);
    
    //si le nombre est supérieur à 0 le like existe si oui : pas de surlike possible. Si non : rajoute une ligne dans la table likes
    if ($isLiked->num_rows > 0) {
    }
    else {
   
    $ajoutjaime = "INSERT INTO likes "
                                . "(id, user_id, post_id) "
                                . "VALUES (NULL, "
                                . $currentUserId . ", "
                                . $idDuPost . ");"
                                ; 

    //envoie la requête et rafraîchit la page
    $ok = $mysqli->query($ajoutjaime);
    header("Refresh:0");
    }
}?>

 <small>♥ <?php echo $post['like_number'] ?></small>
 
<!-- affiche les tag en explosant les string récupérées de la requête et en bouclant dessus -->
<?php 
    $tagArray = explode(",", $post['taglist']);
    $tagIdArray = explode(",", $post['tagid']);
    for ($i = 0; $i < sizeof($tagArray); $i++) {
        echo '<a href="tags.php?tag_id=' . $tagIdArray[$i] . '">';
        echo "#" . $tagArray[$i] . " " . "</a>";
    }
?>