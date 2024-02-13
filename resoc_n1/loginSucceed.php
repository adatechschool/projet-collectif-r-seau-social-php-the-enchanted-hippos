
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
        <?php include 'header.php';?>
        </header>

        <div id="wrapper" >

            <aside>
                <h2>Présentation</h2>
                <p>Bienvenue sur notre réseau social.</p>
            </aside>
            <main>

            <?php
            $lInstructionSql = "SELECT alias "
                                . "FROM users "
                                . "WHERE "
                                . "id = '" . $currentUserId . "'" 
                                ;
                        // Etape 6: Vérification de l'utilisateur
                        $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
                        $res = $mysqli->query($lInstructionSql);
                        $user = $res->fetch_assoc();
                ?>

                <article>
                    <h2>Connexion réussie ! <br>
                    Bienvenue <?php echo $user['alias']?> sur ton réseau social préféré !
                    </h2>      

                </article>
            </main>
        </div>
    </body>
</html>

