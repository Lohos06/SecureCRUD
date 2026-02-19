<?php
ob_start();

require_once "sessionStart.php";
require_once "BDDAdmin.php";

header('Content-Type: application/json');

$errors = [];

/*partie inscription*/

/* verif token */
if (
    !isset($_POST['token']) ||
    !isset($_SESSION['token_form_add']) ||
    !hash_equals($_SESSION['token_form_add'], $_POST['token'])
) {
    $errors[] = "Token invalide.";
}

$pseudo = trim($_POST['pseudo'] ?? '');
$plainPassword = $_POST['password'] ?? '';
$biography = trim($_POST['biography'] ?? '');

/* Validation champs */
if (empty($pseudo)) {
    $errors[] = "Pseudo obligatoire.";
}

if (empty($plainPassword)) {
    $errors[] = "Mot de passe obligatoire.";
}

if (empty($biography)) {
    $errors[] = "Biographie obligatoire.";
}

/* verif pseudo */
if (!empty($pseudo)) {
    $check = $pdo->prepare("SELECT id FROM users WHERE pseudo = ?");
    $check->execute([$pseudo]);

    if ($check->rowCount() > 0) {
        $errors[] = "Pseudo déjà utilisé.";
    }
}

/* validation mp */
$password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/';

if (!empty($plainPassword) && !preg_match($password_pattern, $plainPassword)) {
    $errors[] = "Mot de passe trop faible.Veuillez fire en osrte qu'il y'a 8 caractere dont une majuscule,minuscule charactere speciaux et chiffre";
}

/* S'il y a des erreurs on renvoie les 2erreur */
if (!empty($errors)) {
    ob_clean();
    echo json_encode([
        'status' => 'error',
        'errors' => $errors
    ]);
    exit();
}

/* hash mp */
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

/* insertion */
$insert = $pdo->prepare(
    'INSERT INTO users (pseudo, password, biography)
     VALUES (:pseudo, :password, :biography)'
);

$insert->execute([
    'pseudo' => htmlspecialchars($pseudo),
    'password' => $hashedPassword,
    'biography' => htmlspecialchars($biography)
]);

/* regeneration token */
$_SESSION['token_form_add'] = bin2hex(random_bytes(32));

ob_clean();
echo json_encode([
    'status' => 'success',
    'message' => 'Inscription réussie !',
    'newToken' => $_SESSION['token_form_add']
]);

exit();

