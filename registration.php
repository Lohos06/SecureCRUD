<?php
session_start();

if (!isset($_SESSION['token_article_add']) || empty($_SESSION['token_article_add'])) {
  $_SESSION['token_article_add'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
</head>
    <header>
        <nav>
            <a href="index.php">HomePage</a>
            <a href="registration.php">inscription</a>
            <a href="connection.php">connection</a>
        </nav>
    </header>
<body>
  <form action="traitement.php" method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token_article_add']; ?>">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo">
    <br>
    <label for="password">Password</label>
    <input type="text" name="password" id="password">
    <label for="biography">Biography</label>
    <textarea name="biography" id="biography"></textarea>
    <br>
    <button type="submit">Inscrire</button>
  </form>
</body>

</html>