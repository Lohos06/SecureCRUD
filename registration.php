<?php

require_once "./Utils/sessionStart.php";

if (!isset($_SESSION['token_form_add']) || empty($_SESSION['token_form_add'])) {
  $_SESSION['token_form_add'] = bin2hex(random_bytes(32));
}
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
    <link rel="stylesheet" href="/CSS/form.css" >

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
      <form action="Utils/traitement.php" method="post">
        <input type="hidden" name="token" value="<?= $_SESSION['token_form_add']; ?>">
        <label for="pseudo">Pseudo (needed)</label>
        <input type="text" name="pseudo" id="pseudo" required>
        <label for="password">Password (needed)</label>
        <input type="text" name="password" id="password" required>
        <label for="biography">Biography</label>
        <textarea name="biography" id="biography"></textarea>
        <button type="submit" class="submit">S'Inscrire</button>
      </form>
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