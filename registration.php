<?php

require_once "./Utils/sessionStart.php";

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (!isset($_SESSION['token_form_add']) || empty($_SESSION['token_form_add'])) {
    $_SESSION['token_form_add'] = bin2hex(random_bytes(32));
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

    <title>Registration</title>
</head>

<body>

<header>
    <h1>Secure User</h1>
    <nav>
        <a href="/index.php">HomePage</a>
        <a href="/registration.php">Registration</a>
        <a href="/connection.php">Connection</a>
        <a href="/Utils/sessionDestory.php">Deconnexion</a>
    </nav>
</header>

<main>
<section>

    <!-- Message ajax -->
    <div id="messageBox"></div>

    <form id="registerForm" method="post">

        <input type="hidden" name="token"
               value="<?= htmlspecialchars($_SESSION['token_form_add']); ?>">
        <label for="pseudo">Pseudo (needed)</label>
        <input type="text" name="pseudo" id="pseudo" required>
        <label for="password">Password (needed)</label>
        <input type="text" name="password" id="password" required>
        <label for="biography">Biography</label>
        <textarea name="biography" id="biography" required></textarea>
        <button type="submit" class="submit">S'inscrire</button>

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


<script src="/JS/register.js"></script>
</body>
</html>
