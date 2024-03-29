<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>ReSoC - Actualités</title> 
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div id="wrapper">
        <aside>
            <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez les derniers messages de
                    tout le monde !</p>
            </section>
        </aside>
        <main>         
            <?php include 'connexionBd.php'; ?>
                     
            <?php           
            $laQuestionEnSql = "
                SELECT posts.content,
                posts.created,
                posts.user_id as author_id,
                users.alias as author_name,
                posts.id as postId,  
                count(DISTINCT likes.id) as like_number,  
                GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.id) AS taglist, 
                GROUP_CONCAT(DISTINCT tags.id) AS tagid
                FROM posts
                JOIN users ON  users.id=posts.user_id
                LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                LEFT JOIN likes      ON likes.post_id  = posts.id 
                GROUP BY posts.id
                ORDER BY posts.created DESC  
                LIMIT 5
                ";
            $lesInformations = $mysqli->query($laQuestionEnSql);            
            
                if ( ! $lesInformations)
                {
                echo("Échec de la requete : " . $mysqli->error);
                exit();
                }
            
                while ($post = $lesInformations->fetch_assoc())
                {
                //echo "<pre>" . print_r($post, 1) . "</pre>";
                ?>
                <article>
                    <h3>
                        <time><?php echo $post['created'] ?></time>
                    </h3>
                        <address><a href="wallOthers.php?user_id=<?php echo $post['author_id'] ?>"><?php echo $post['author_name'] ?></address>
                    <div>
                        <p><?php echo $post['content'] ?></p>
                    </div>
                    <footer><?php include 'footer.php';?></footer>
                </article>
                <?php
                }
                ?>
        </main>
    </div>
</body>
</html>
