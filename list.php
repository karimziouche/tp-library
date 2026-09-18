<?php

session_start();

require_once 'db.php';

$sql = "SELECT book.id, book.title, book.publication_date, author.lastname, author.firstname
        FROM book
        JOIN author ON book.author_id = author.id";
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des livres</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
    <?php require_once 'nav.php'; ?>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <form method="GET">
        <label>Titre :</label>
        <input type="text" name="search">
        <button type="submit">Rechercher</button>
    </form>
    <br>
        <table>
            <tr>
                <th>Id </th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date de publication</th>
                <th>Action</th>
            </tr>
        <?php foreach($books as $book) { ?>
        <tr>
            <td><?php echo $book["id"]?></td>
            <td><?php echo $book["title"]?></td>
            <td><?php echo $book["firstname"] . " " . $book["lastname"]; ?></td>
            <td><?php echo $book["publication_date"]?></td>
            <td>
                <a href="edit-book.php?id=<?php echo $book["id"]; ?>"> Modifier </a>
                <a href="delete-book.php?id=<?php echo $book["id"]; ?>"> Supprimer </a>
            </td>
        </tr>
        <?php } ?>
        </table>
    </body>
</html>