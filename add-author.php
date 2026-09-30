<?php

require_once 'db.php';
require_once 'Author.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $author = new Author();
    $author->setFirstName($firstname);
    $author->setLastName($lastname);

    $sql = "INSERT INTO author (lastname, firstname) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $author->getLastName());
    $stmt->bindValue(2, $author->getFirstName());
    $stmt->execute();

    echo "Auteur ajouté avec succès !";
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajouter un auteur</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php require_once 'nav.php' ; ?>
    <h1>Ajouter un auteur</h1>
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="lastname">
            <br><br>
            <label>Prénom :</label>
            <input type="text" name="firstname">
            <br><br>
            <button type="submit">Ajouter l'auteur</button>
        </form>
    </body>
</html>