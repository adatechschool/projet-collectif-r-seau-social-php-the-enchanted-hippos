<?php session_start();?>
<?php $currentUserId=$_SESSION['connected_id']; 
echo "<pre>" . print_r($currentUserId,1) . "</pre>"; 
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
        </ul>
    </nav>
