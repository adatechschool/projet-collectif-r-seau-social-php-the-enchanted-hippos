<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
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
                    <p>Voici la liste des Êtres que l’utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?>
                        suit.
                    </p>
                </section>
            </aside>
            <main class='contacts'>
                <?php
                $userId = intval($_GET['user_id']);
                ?>
                <?php include 'connexionBd.php'; ?>
                <?php
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);

                while ($followedUser = $lesInformations->fetch_assoc())
                {
                    echo "<pre>" . print_r($followedUser,1) . "</pre>";
                ?>
                <article>
                    <img src="user.jpg" alt="blason"/>
                    <h3><a href="wallOthers.php?user_id=<?php echo $followedUser["id"] ?>" >
                        <?php echo $followedUser["alias"] ?></a>
                    </h3>
                    <p><?php echo $followedUser["id"] ?></p>                    
                </article>
              <?php 
                } ?>
            </main>
        </div>
    </body>
</html>
