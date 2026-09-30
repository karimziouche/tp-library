<?php

session_start();

require_once 'db.php';
require_once 'Book.php';
require_once 'Author.php';

$search = $_GET['search'] ?? '';

$sql = "SELECT book.id, book.title, book.publication_date, book.author_id
        FROM book
        WHERE book.title LIKE :search";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des livres</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php require_once 'nav.php'; ?>
    <h1>Liste des livres</h1>
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
        <?php while ($book = $stmt->fetchObject('Book')) { ?>
        <?php
        $sqlAuthor = "SELECT id, firstname, lastname FROM author WHERE id = ?";
        $stmtAuthor = $pdo->prepare($sqlAuthor);
        $stmtAuthor->bindValue(1, $book->getAuthor_id(), PDO::PARAM_INT);
        $stmtAuthor->execute();

        $author = $stmtAuthor->fetchObject('Author');
        $book->setAuthor($author);
        ?>
        <tr>
            <td><?php echo $book->getId()?></td>
            <td><?php echo $book->getTitle()?></td>
            <td><?php echo $book->getAuthor()->getFirstName() . " " . $book->getAuthor()->getLastName(); ?></td>
            <td><?php echo $book->getPublication_date()?></td>
            <td>
                <a href="edit-book.php?id=<?php echo $book->getId(); ?>"> Modifier </a>
                <a href="delete-book.php?id=<?php echo $book->getId(); ?>"> Supprimer </a>
            </td>
        </tr>
        <?php } ?>
        </table>
    </body>
</html>