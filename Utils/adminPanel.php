<?php

require_once "BDDAdmin.php";

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
                <th scope='col'>supprimer</th>
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
                <td><form action='Utils/DeleteUser.php' method='POST'>
                        <input type='hidden' name='id' value=" . $user['id'] . ">
                        <input type='submit' value='Supprimer'>
                    </form>
                </td>
            </tr>
        ";
    }
}
echo "</tbody>
    </table>";

?>