<?php

require_once "sessionStart.php";

if(isset($_SESSION['user_id'])) {
    if($_SESSION['role'] === "admin") {
        require_once "BDDAdmin.php";
        $user_id = $_POST['id'];

        $role = $pdo->prepare("SELECT role FROM users WHERE id = ?");
        $role->execute([$user_id]);
        $role = $role->fetch(PDO::FETCH_ASSOC);
        $role = $role['role'];

        if($role == "admin") {
            echo "peut pas supprimer : Admin";
            echo "<br>";
            echo "<br>";
            echo "<a href='/index.php'>HomePage</a>";
        } else {
            $delete = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $delete->execute([$user_id]);
            header('Location: /index.php');
        }
}}




?>