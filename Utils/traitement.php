<?php

require_once "sessionStart.php";
require_once "BDDAdmin.php";

/* verif token*/

if (
    !isset($_POST['token']) ||
    !isset($_SESSION['token_form_add']) ||
    !hash_equals($_SESSION['token_form_add'], $_POST['token'])
) {
    die('Erreur : Token invalide');
}

unset($_SESSION['token_form_add']);


/*validation champs*/

if (empty($_POST['pseudo'])) {
    die('Le pseudo est obligatoire');
}

if (empty($_POST['password'])) {
    die('Le mot de passe est obligatoire');
}

if (empty($_POST['biography'])) {
    die('La biographie est obligatoire');
}

$pseudo = htmlspecialchars(trim($_POST['pseudo']));
$plainPassword = $_POST['password'];
$biography = htmlspecialchars(trim($_POST['biography']));

/* Validation mp */
$password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/';

if (!preg_match($password_pattern, $plainPassword)) {
    die('Le mot de passe doit contenir au moins 8 caractères avec : 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.');
}


/* connexion bdd*/

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


/* verif pseudo*/

$check = $pdo->prepare("SELECT id FROM users WHERE pseudo = ?");
$check->execute([$pseudo]);

if ($check->rowCount() > 0) {
    die("Pseudo déjà utilisé.");
}


/* hash mp*/

$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);


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

echo 'Inscription faite avec succès';
