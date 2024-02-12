<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnés </title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <?php include 'header.php'; ?>
        </header>
        <div id="wrapper">          
            <aside>
                <img src = "user.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?></p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                $userId = intval($_GET['user_id']);
                ?>
                // Etape 2: se connecter à la base de donnée
                <?php include 'connexionBd.php'; ?>
                // Etape 3: récupérer le nom de l'utilisateur
                <?php
                $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql); 
                while ($followingUser = $lesInformations->fetch_assoc())
                {
                    echo "<pre>" . print_r($followingUser,1) . "</pre>";
                ?>
                <article>
                    <img src="user.jpg" alt="blason"/>
                    <h3>
                        <a href="wallOthers.php?user_id=<?php echo $followingUser["id"] ?>" >
                        <?php echo $followingUser["alias"] ?></a>
                    </h3>
                        <p><?php echo $followingUser["id"] ?></p>                    
                </article>
              <?php } ?>
            </main>
        </div>
    </body>
</html>