<?php

require_once "sessionStart.php";

/* verif token*/
if (
    !isset($_POST['token']) ||
    !isset($_SESSION['token_form_add']) ||
    !hash_equals($_SESSION['token_form_add'], $_POST['token'])
) {
    die('Erreur : Token invalide');
}


unset($_SESSION['token_form_add']);


/* validation champs*/

if (empty($_POST['pseudo'])) {
    die('<p>Le pseudo est obligatoire</p>');
}

if (empty($_POST['password'])) {
    die('<p>Le mot de passe est obligatoire</p>');
}

if (empty($_POST['biography'])) {
    die('<p>La biography est obligatoire</p>');
}

$pseudo = htmlspecialchars($_POST['pseudo']);
$plainPassword = $_POST['password'];
$biography = htmlspecialchars($_POST['biography']);


/* hash mp*/

$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

echo "<p>$plainPassword devient $hashedPassword</p>";

if (password_verify($plainPassword, $hashedPassword)) {
    echo '<p>Les deux mots de passe correspondent</p>';
} else {
    echo '<p>Les deux mots de passe ne correspondent pas</p>';
}


/* connexion bdd */

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=secureuser;charset=utf8',
        'root',
        ''
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur BDD : ' . $e->getMessage());
}


/* insertion bdd*/

$insert = $pdo->prepare(
    'INSERT INTO users (pseudo, password, biography)
     VALUES (:pseudo, :password, :biography)'
);

$insert->execute([
    'pseudo' => $pseudo,
    'password' => $hashedPassword,
    'biography' => $biography
]);

echo '<p>Inscription faite avec succès</p>';
