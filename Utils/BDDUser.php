<?php 
require_once "loadEnv.php";

$DB_HOST = "localhost";
$DB_NAME = "secureuser";
$DB_USER = "User";
$DB_PSW = $_ENV['DB_USER'];

try {
    $pdo = new PDO(
        'mysql:host=' . $DB_HOST . ';
        dbname=' . $DB_NAME . ';
        charset=utf8',
        $DB_USER,
        $DB_PSW
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur BDD : ' . $e->getMessage());
}
?>