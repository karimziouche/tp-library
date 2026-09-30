<?php

session_start();

require_once "db.php";
require_once "Book.php";
require_once "Author.php";

$sql = "SELECT MIN(id) AS id, lastname, firstname
        FROM author
        GROUP BY lastname, firstname";
$stmt = $pdo->query($sql);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = $_POST["titre"];

    if (empty(trim($titre))) {
        echo "Le titre du livre est obligatoire.";
    } else {
        $date_publication= $_POST["date_publication"];
        $id_auteur = $_POST["id_auteur"];
        $book = new Book();
        $book->setTitle($titre);
        $book->setPublication_date($date_publication);
        $book->setAuthor_id($id_auteur);
        $sql = "INSERT INTO book (title, publication_date, author_id)
                VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $book->getTitle());
        $stmt->bindValue(2, $book->getPublication_date());
        $stmt->bindValue(3, $book->getAuthor_id(), PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = "Livre ajouter avec succès !";

        header('Location: list.php');
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajouter un livre</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <?php require_once 'nav.php'; ?>
        <h1>Ajouter un livre</h1>
        <form method="POST">
            <label for="titre">Titre :</label>
            <input 
                type="text"
                id="titre"
                name="titre"
            >
            <br><br>
            <label for="date_publication">Date de publication :</label>
            <input 
                type="date"
                id="date_publication"
                name="date_publication"
            >
            <br><br>
            <label for="id_auteur">Auteur :</label>
            <select id="id_auteur" name="id_auteur" required>
                <option value="">-- Choisir un auteur --</option>
            <?php while ($auteur = $stmt->fetchObject('Author')) { ?>
                <option value="<?=  $auteur->getId() ?>">
                    <?= htmlspecialchars($auteur->getLastName()) ?>
                    <?= htmlspecialchars($auteur->getFirstName()) ?>
                </option>
            <?php } ?>
        </select>
        <br><br>
        <button type="submit">Ajouter le livre</button>
        </form>
    </body>
</html>