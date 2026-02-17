<?php 

// $users = $pdo->prepare('SELECT * FROM users');
// $users->execute([]);

// foreach ($users as $user) {
//     if(isset($user)) {
//         echo $user;
//     }
// }


// Protectin des headers pour l'exterieur

// ne pas pouvoir afficher le site dans les i-frames en dehors de notre site
header("X-Frame-Options: SAMEORIGIN"); 

// le naviguateur respecte strictement les types de fichiers
// et donc ne les devines pas si mal parametrés (sert a ne pas avoir de programmes deguisés)
header("X-Content-Type-Options: nosniff");

// envoie seulement l'url snas les parametres si connection avec un autre site 
// (empeche la recuperation de parametres sensibles par ce site)
header("Referrer-Policy: strict-origin-when-cross-origin");

// empeche le chargement de ressources externes et le js dans le html
header("Content-Security-Policy: default-src 'self'");  





// protection de la session


// parametrage des cookies de sessions
session_set_cookie_params([
  "lifetime" => 0, // suppression du cookie a la fermeture de l'onglet
  "path"     => "/", // cookie accessible sur toute les pages
  "secure"   => true, // envoie les cookies que en https donc encryptés
  "httponly" => true, // les cookies ne peuvent pas etre lus par du js
  "samesite" => "Strict" // n'evnoie pas le cokie si ne viens pas du site
]);

// regenere l'id de la sessiona sa creation pour ne pas qu'on puisse utiliser d'ancien id de session
session_start();
session_regenerate_id(true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">HomePage</a>
            <a href="registration.php">Registration</a>
            <a href="connection.php">Connection</a>
        </nav>
    </header>
</body>
</html>