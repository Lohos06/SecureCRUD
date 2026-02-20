<?php 

require_once "./Utils/safeHeaders.php";
require_once "./Utils/sessionStart.php";

if(!isset($_SESSION['user_id'])) {
    header("Location: connection.php");
}

require_once "./Utils/BDDAdmin.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['biography'])) {

    $biography = trim($_POST['biography']);

    if (!empty($biography)) {

        $update = $pdo->prepare("UPDATE users SET biography = ? WHERE id = ?");
        $update->execute([$biography, $_SESSION['user_id']]);

    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/CSS/destyle.css" >
    <link rel="stylesheet" href="/CSS/variables.css" >
    <link rel="stylesheet" href="/CSS/font.css" >
    <link rel="stylesheet" href="/CSS/form.css" >
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
            <a href="/registration.php">Registration</a>
            <a href="/connection.php">Connection</a>
            <a href="/Utils/sessionDestory.php">Deconnexion</a>
        </nav>
    </header>
    <main>
        <section>
                <?php
                    if(isset($_SESSION['user_id'])) {
                        if($_SESSION['role'] === "admin") {
                            $users = $pdo->prepare('SELECT * FROM users');
                            $users->execute([]); 
                            echo "<table>
                                    <caption class='TableTitle'>
                                        Table of Users
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th scope='col'>Id</th>
                                            <th scope='col'>Pseudo</th>
                                            <th scope='col'>biography</th>
                                            <th scope='col'>role</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            foreach ($users as $user) {
                                if(isset($user)) {
                                    echo "
                                        <tr>
                                            <th scope='row'>" . $user["id"] . "</th>
                                            <td>" . $user["pseudo"] . "</td>
                                            <td>" . $user["biography"] . "</td>
                                            <td>" . $user["role"] . "</td>
                                        </tr>
                                    ";
                                }
                            }
                            echo "</tbody>
                                </table>";
                        } else {
                             $stmt = $pdo->prepare("SELECT biography FROM users WHERE id = ?");
                                $stmt->execute([$_SESSION['user_id']]);
                                $user = $stmt->fetch();

                                echo "<h2>Bienvenue " . htmlspecialchars($_SESSION['pseudo']) . " 🐱</h2>";
                                echo "<p><strong>Description :</strong> " . htmlspecialchars($user['biography']) . "</p>";
                                ?>

                                <form method="POST">
                                    <label for="biography">Modifier votre biographie :</label><br>
                                    <textarea name="biography" id="biography" required><?= htmlspecialchars($user['biography']) ?></textarea><br>
                                     <button type="submit" class="submit">Mettre à jour</button>
                                </form>

                            <?php
                            }}
                            ?>

 
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