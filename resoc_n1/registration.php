<?php 
session_start();?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Connexion</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
        <a href='admin.php'><img src="resoc.jpg" alt="Logo de notre réseau social"/></a>
    <nav id="menu">
        <a href="news.php">Actualités</a>
        <a href="wall.php?user_id=<?php echo $currentUserId ?>">Mur</a>
        <a href="feed.php?user_id=<?php echo $currentUserId ?>">Flux</a>
        <a href="tags.php?tag_id=1">Mots-clés</a>
    </nav>
    <nav id="user">
        <a href="#">▾ Profil</a>
        <ul>
            <li><a href="settings.php?user_id=<?php echo $currentUserId ?>">Paramètres</a></li>
            <li><a href="followers.php?user_id=<?php echo $currentUserId ?>">Mes suiveurs</a></li>
            <li><a href="subscriptions.php?user_id=<?php echo $currentUserId ?>">Mes abonnements</a></li>
            <li> <?php if( isset($_SESSION['connected_id']) && $_SESSION['connected_id'] !== null ) : ?>
                    <a href="logout.php">Se déconnecter</a>
                <?php else : ?>
                    <a href="login.php">Se connecter</a>
                <?php endif; ?></li>
        </ul>
    </nav>

        </header>

    <div id="wrapper" >

        <aside>
            <h2>Bienvenue sur "Mon Petit Coin Douillet"</h2>
            <p>Le réseau social pour les fan·es de Tiny House !</p>
        </aside>
        <main>
            <article>
                <h2>Inscription</h2>
                <?php
                $enCoursDeTraitement = isset($_POST['email']);
                if ($enCoursDeTraitement)
                {
                    $new_email = $_POST['email'];
                    $new_alias = $_POST['pseudo'];
                    $new_passwd = $_POST['motpasse'];

                    include 'connexionBd.php';

                    $new_email = $mysqli->real_escape_string($new_email);
                    $new_alias = $mysqli->real_escape_string($new_alias);
                    $new_passwd = $mysqli->real_escape_string($new_passwd);
                    $new_passwd = md5($new_passwd);

                    $lInstructionSql = "INSERT INTO users (id, email, password, alias) "
                            . "VALUES (NULL, "
                            . "'" . $new_email . "', "
                            . "'" . $new_passwd . "', "
                            . "'" . $new_alias . "'"
                            . ");";

                    $ok = $mysqli->query($lInstructionSql);
                    if ( ! $ok)
                    {
                        echo "L'inscription a échouée : " . $mysqli->error;
                    } else
                    {
                        echo "Votre inscription est un succès : " . $new_alias;
                        echo " <a href='login.php'>Connectez-vous.</a>";
                    }
                }
                ?>                     
                <form action="registration.php" method="post">
                    <input type='hidden'name='???' value='achanger'>
                    <dl>
                        <dt><label for='pseudo'>Pseudo</label></dt>
                        <dd><input type='text'name='pseudo'></dd>
                        <dt><label for='email'>E-Mail</label></dt>
                        <dd><input type='email'name='email'></dd>
                        <dt><label for='motpasse'>Mot de passe</label></dt>
                        <dd><input type='password'name='motpasse'></dd>
                    </dl>
                    <input type='submit'>
                </form>
            </article>
        </main>
    </div>
</body>
</html>
