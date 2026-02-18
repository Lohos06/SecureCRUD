<?php 

require_once "./Utils/safeHeaders.php";
require_once "./Utils/sessionStart.php";

require_once "./Utils/loadEnv.php";
require_once "./Utils/BDDAdmin.php";

// echo $_ENV['DB_Admin'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/CSS/destyle.css" >
    <link rel="stylesheet" href="/CSS/variables.css" >
    <link rel="stylesheet" href="/CSS/font.css" >
    <link rel="stylesheet" href="/CSS/header.css" >
    <link rel="stylesheet" href="/CSS/section.css" >
    <link rel="stylesheet" href="/CSS/footer.css" >

    <link rel="stylesheet" href="/CSS/table.css" >

    <title>HomePage</title>
    <meta name="description" content="A page to see what you are meant to">

</head>
<body>
    <header>
        <h1>Secure User</h1>
        <nav>
            <a href="/index.php">HomePage</a>
            <a href="/registration.php">registration</a>
            <a href="/connection.php">connection</a>
        </nav>
    </header>
    <main>
        <section>
            <table>
                <caption class="TableTitle">
                    Table of Users
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Password</th>
                        <th scope="col">biography</th>
                        <th scope="col">role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = $pdo->prepare('SELECT * FROM users');
                    $users->execute([]); 
                    foreach ($users as $user) {
                        if(isset($user)) {
                            echo "
                                <tr>
                                    <th scope='row'>" . $user["id"] . "</th>
                                    <td>" . $user["pseudo"] . "</td>
                                    <td>" . $user["password"] . "</td>
                                    <td>" . $user["biography"] . "</td>
                                    <td>" . $user["id"] . "</td>
                                </tr>
                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>Contact : Admin@gmail.com</p>
        <div class="authors">
            <h3>developpers :</h3>
            <p>Yasminemfth</p>
            <p>Lohos</p>
        </div>
    </footer>
</body>