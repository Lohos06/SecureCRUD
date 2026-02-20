<?php

require_once "./Utils/sessionStart.php";

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

/* toekn connexion */
if (!isset($_SESSION['token_connexion_add']) || empty($_SESSION['token_connexion_add'])) {
    $_SESSION['token_connexion_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/CSS/destyle.css">
    <link rel="stylesheet" href="/CSS/variables.css">
    <link rel="stylesheet" href="/CSS/font.css">
    <link rel="stylesheet" href="/CSS/header.css">
    <link rel="stylesheet" href="/CSS/section.css">
    <link rel="stylesheet" href="/CSS/footer.css">
    <link rel="stylesheet" href="/CSS/form.css">

    <title>Connexion</title>
    <meta name="description" content="Page de connexion sécurisée">
</head>

<body>

<header>
    <h1>Secure User</h1>
    <nav>
        <a href="/index.php">HomePage</a>
        <a href="/registration.php">SignUp</a>
        <a href="/connection.php">Login</a>
        <a href="/Utils/sessionDestory.php">Log out</a>
    </nav>
</header>

<main>
<section>
    
    <div id="responseMessage"></div>
    <h2>Login</h2>
    
    <form id="loginForm" method="post"> <!-- a la place de faire le link avec traitement conenction via l'url on fait avec le js ci dessous-->
        <input type="hidden" name="token" value="<?= $_SESSION['token_connexion_add']; ?>">

        <label for="pseudo">Pseudo(needed)</label>
        <input type="text" name="pseudo" id="pseudo" required>

        <label for="password">Password(needed)</label>
        <input type="password" name="password" id="password" required>

         <button type="submit" class="submit">Login</button>
    </form>
</section>
</main>

<footer>
    <p>Contact : Admin@gmail.com</p>
    <div class="authors">
        <h3>Developpers :</h3>
        <p>Yasminemfth</p>
        <p>Lohos</p>
    </div>
</footer>

<script src="/JS/Connection.js"></script>
</body>
</html>
