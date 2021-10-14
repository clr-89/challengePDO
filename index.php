<?php

require_once 'connec.php';

$pdo = new PDO(DSN, USER, PASS);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $statement->execute();
}

$query = 'SELECT * FROM friend';
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Friends</title>

<body>
    <?php foreach ($friends as $friend): ?>
        <ul>
            <li><?= $friend['firstname'] . $friend['lastname'] ?></li>
        </ul>
    <?php endforeach ?>

    <form action="/" method="POST">
        <label for="firstname">Firstname</label>
        <input id="firstname" type="text" name="firstname">
        <label for="lastname">Lastname</label>
        <input id="lastname" type="text" name="lastname">
        <button>Ajouter</button>
    </form>



</body>
</html>



