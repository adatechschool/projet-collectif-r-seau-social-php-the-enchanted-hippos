
<?php 
session_start();

if (isset($_SESSION['connected_id']) && $_SESSION['connected_id'] !== null) {
    $currentUserId = $_SESSION['connected_id']; 
} else {
    header('Location: accesDenied.php');
    exit();
}
?>

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
