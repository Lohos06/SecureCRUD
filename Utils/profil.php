<?php

require_once "BDDUser.php";

$stmt = $pdo->prepare("SELECT biography FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

echo "<h2>Bienvenue " . htmlspecialchars($_SESSION['pseudo']) . " 🐱</h2>";
echo "<p><strong>Description :</strong> " . htmlspecialchars($user['biography']) . "</p>";
echo "
<form action='/Utils/biographyUpdate.php' method='POST'>
    <label for='biography'>Modifier votre biographie :</label><br>
    <textarea name='biography' id='biography' required>"
    . htmlspecialchars($user['biography']) .
    "</textarea><br>
    <button type='submit' class='submit'>Mettre à jour</button>
</form>
";
?>