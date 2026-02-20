<?php

require_once "./Utils/sessionStart.php";

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
        <a href="/registration.php">Registration</a>
        <a href="/connection.php">Connection</a>
    </nav>
</header>

<main>
<section>

<?php if (isset($_SESSION['pseudo'])): ?>
    <h2>Bienvenue <?= htmlspecialchars($_SESSION['pseudo']) ?> 🐱</h2> <!--recup le pseudo pour l'afficher -->
    <p>Vous êtes connecté.</p>
<?php else: ?>

    <h2>Connexion</h2>

    <form id="loginForm" method="post"> <!-- a la place de faire le link avec traitement conenction via l'url on fait avec le js ci dessous-->
        <input type="hidden" name="token" value="<?= $_SESSION['token_connexion_add']; ?>">

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>

         <button type="submit" class="submit">Se connecter</button>
    </form>

    <div id="responseMessage"></div>

<?php endif; ?>

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

<script>
document.getElementById("loginForm")?.addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("Utils/TraitementConnection.php", { /*connexion au connexion traitement*/
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const messageDiv = document.getElementById("responseMessage");

        if (data.status === "success") {/*si on est bien co message vert */
            messageDiv.innerHTML = "<p style='color:green'>" + data.message + "</p>";
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            messageDiv.innerHTML = "<p style='color:red'>" + data.errors.join("<br>") + "</p>";
        }
    });
});
</script>

</body>
</html>
