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
            <a href="inscription.php">inscription</a>
            <a href="connexion.php">connexion</a>
        </nav>
    </header>
<body>
  <form action="traitement.php" method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token_article_add']; ?>">
    <label for="pseudo">Titre</label>
    <input type="text" name="pseudo" id="pseudo">
    <br>
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug">
    <br>
    <label for="content">Contenu</label>
    <textarea name="content" id="content"></textarea>
    <br>
    <button type="submit">Ajouter</button>
  </form>
</body>

</html>