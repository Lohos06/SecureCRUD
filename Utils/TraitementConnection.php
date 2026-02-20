<?php
ob_start();

require_once "sessionStart.php";
require_once "BDDAdmin.php";

header('Content-Type: application/json');

$errors = [];

/* Vérif token*/
if (
    !isset($_POST['token']) ||
    !isset($_SESSION['token_connexion_add']) ||
    !hash_equals($_SESSION['token_connexion_add'], $_POST['token'])
) {
    $errors[] = "Token invalide.";
}

/* Récupération champs*/
$pseudo = trim($_POST['pseudo'] ?? '');
$plainPassword = $_POST['password'] ?? '';

/* Validation des champs */

if (empty($pseudo)) {
    $errors[] = "Pseudo obligatoire.";
}

if (empty($plainPassword)) {
    $errors[] = "Mot de passe obligatoire.";
}

/* si y a déjà des erreurs*/
if (!empty($errors)) {
    ob_clean();
    echo json_encode([
        'status' => 'error',
        'errors' => $errors
    ]);
    exit();
}

/* Recherche user */

$stmt = $pdo->prepare("SELECT id, pseudo, role, biography, password FROM users WHERE pseudo = ?");
$stmt->execute([$pseudo]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

/* verif identifiants */
if (!$user || !password_verify($plainPassword, $user['password'])) {

    ob_clean();
    echo json_encode([
        'status' => 'error',
        'errors' => ["Pseudo ou Password incorrects."]
    ]);
    exit();
}

/* youhou connexion réussi*/
$_SESSION['user_id'] = $user['id'];
$_SESSION['pseudo'] = $user['pseudo'];
$_SESSION['role'] = $user['role'];
$_SESSION['biography'] = $user['biography'];

/* régénération token */
$_SESSION['token_connexion_add'] = bin2hex(random_bytes(32));

ob_clean();
echo json_encode([
    'status' => 'success',
    'message' => 'Connexion réussie !',
    'newToken' => $_SESSION['token_connexion_add']
]);

exit();
