<?php

require_once "BDDUser.php";
require_once "sessionStart.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['biography'])) {

    $biography = trim($_POST['biography']);

    if (!empty($biography)) {
        $update = $pdo->prepare("UPDATE users SET biography = ? WHERE id = ?");
        $update->execute([$biography, $_SESSION['user_id']]);
    }
}

header("Location: /index.php")

?>