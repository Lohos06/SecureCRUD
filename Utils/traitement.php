<?php

require_once "sessionStart.php";
require_once "BDDAdmin.php";

header('Content-Type: application/json');

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';


/* verif token */

if (
    !isset($_POST['token']) ||
    !isset($_SESSION['token_form_add']) ||
    !hash_equals($_SESSION['token_form_add'], $_POST['token'])
) {
    echo json_encode(['status' => 'error', 'message' => 'Token invalide.']);
    exit();
}

unset($_SESSION['token_form_add']);


/* Validation champs */

if (empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['biography'])) {
    echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont obligatoires.']);
    exit();
}

$pseudo = htmlspecialchars(trim($_POST['pseudo']));
$plainPassword = $_POST['password'];
$biography = htmlspecialchars(trim($_POST['biography']));


/* verif pseudo */

$check = $pdo->prepare("SELECT id FROM users WHERE pseudo = ?");
$check->execute([$pseudo]);

if ($check->rowCount() > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Pseudo déjà utilisé.']);
    exit();
}


/* validation mp complexe */

$password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/';

if (!preg_match($password_pattern, $plainPassword)) {
    echo json_encode(['status' => 'error', 'message' => 'Mot de passe trop faible.']);
    exit();
}


/* hash mp */

$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);


/* Insertion BDD */

try {

    $insert = $pdo->prepare(
        'INSERT INTO users (pseudo, password, biography)
         VALUES (:pseudo, :password, :biography)'
    );

    $insert->execute([
        'pseudo' => $pseudo,
        'password' => $hashedPassword,
        'biography' => $biography
    ]);

} catch (PDOException $e) {

    if ($e->getCode() == 23000) {
        echo json_encode(['status' => 'error', 'message' => 'Pseudo déjà utilisé.']);
        exit();
    }

    echo json_encode(['status' => 'error', 'message' => 'Erreur serveur.']);
    exit();
}


echo json_encode(['status' => 'success', 'message' => 'Inscription réussie !']);
exit();
