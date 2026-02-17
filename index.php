<?php 

// $users = $pdo->prepare('SELECT * FROM users');
// $users->execute([]);

// foreach ($users as $user) {
//     if(isset($user)) {
//         echo $user;
//     }
// }


// Protectin des headers dpour l'exterieur

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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/CSS/destyle.css" >
    <link rel="stylesheet" href="/CSS/variables.css" >
    <link rel="stylesheet" href="/CSS/font.css" >
    <link rel="stylesheet" href="/CSS/header.css" >
    <link rel="stylesheet" href="/CSS/footer.css" >

    <title>HomePage</title>
    <meta name="description" content="A page to see what you are meant to">

</head>
<body>
    <header>
        <h1>Secure User</h1>
        <nav>
            <a href="/index.php">HomePage</a>
            <a href="/registration.php">registration</a>
            <a href="/connection.php">connection</a>
        </nav>
    </header>
    <main>
        
    </main>
    <footer>
        <p>Contact : Admin@gmail.com</p>
        <div class="authors">
            <h3>developpers :</h3>
            <p>Yasminemfth</p>
            <p>Lohos</p>
        </div>
    </footer>
</body>
</html>