<?php

session_start();

require_once 'db.php';
require_once 'Book.php';

$id = $_GET['id'];

$sql = "SELECT * FROM book WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$book = $stmt->fetchObject('Book');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];

    if (empty(trim($title))) {
        echo "Le titre de livre est obligatoire.";
    } else {
    $publication_date = $_POST['publication_date'];
    $sql = "UPDATE book
            SET title = :title,
                publication_date = :publication_date
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':publication_date', $publication_date);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['message'] = "Livre modifier avec succès !";

    header('Location: list.php');
    exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le livre</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <h1>Modifier le livre</h1>
    <form method="POST">
        <label>Titre :</label>
        <input type="text"
               name="title"
               value="<?= $book->getTitle() ?>">

        <br><br>
        
        <label>Date de publication :</label>
        <input type="date"
               name="publication_date"
               value="<?= $book->getPublication_date() ?>">

        <br><br>

        <button type="submit">Modifier</button>

    </form>
</body>
</html>