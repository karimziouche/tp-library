<?php

require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];

    $sql = "INSERT INTO author (lastname, firstname) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lastname, $firstname]);

    echo "Auteur ajouté avec succès !";
}

?>

<H1>Ajouter un auteur</H1>

<form method="POST">

<label>Nom :</label>
<input type="text" name="lastname">

<br><br>

<label>Prénom :</label>
<input type="text" name="firstname">

<br><br>

<button type="submit">Ajouter l'auteur</button>

</form>