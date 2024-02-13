 
<?php
session_start();

//Détruit toutes les variables de session
$_SESSION = array();

//Détruit les cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//Détruit la session.
session_destroy();
  
header('Location: login.php');
 
exit();
?>