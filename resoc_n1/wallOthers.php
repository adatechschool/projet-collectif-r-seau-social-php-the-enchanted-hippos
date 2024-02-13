<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mur</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <?php include 'header.php'; ?>
        </header>
        <div id="wrapper">
            <?php            
            $userId =intval($_GET['user_id']);
            ?>
            <?php include 'connexionBd.php'; ?>

            <aside>
                <?php                               
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();                
                //echo "<pre>" . print_r($user, 1) . "</pre>";
                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les messages de : <?php echo $user['alias'] ?>
                        (n° <?php echo $userId ?>)
                    </p>
                    
                    <?php 
                        if(isset($_POST['Suivre'])) { 
                            $ajoutAbonnementSql = "INSERT INTO followers "
                                . "(id, followed_user_id, following_user_id) "
                                . "VALUES (NULL, "
                                . $userId . ", "
                                . $currentUserId . ");"
                                ; 

                                $ok = $mysqli->query($ajoutAbonnementSql);
                                if ( ! $ok)
                                {
                                    echo "Impossible d'ajouter l'abonnement" . $mysqli->error;
                                } else
                                {
                                    echo "Abonnement réalisé";
                                }
                            }
                         ?>
                    <!-- formulaire pour créer le bouton "suivre"  -->
                    <form method="post"> 
                        <input type="submit" name="Suivre" class="button" value="Suivre" /> 
                    </form>
                    
                </section>
            </aside>
            <main>

                <?php              
                $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name,
                    posts.id as postId, 
                    COUNT(likes.id) as like_number, 
                    GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.id) AS taglist, 
                    GROUP_CONCAT(DISTINCT tags.id) AS tagid
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }

                while ($post = $lesInformations->fetch_assoc())
                {
                    //echo "<pre>" . print_r($post, 1) . "</pre>";
                    ?>                
                    <article>
                        <h3>
                            <time datetime='2020-02-01 11:12:13' ><?php echo $post['created'] ?></time>
                        </h3>
                        <address>par <?php echo $post['author_name'] ?></address>
                        <div>
                            <p><?php echo $post['content'] ?></p>
                        </div>                                            
                        <footer><?php include 'footer.php';?></footer>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
