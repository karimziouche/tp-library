<?php

session_start();

require_once 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM book WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id' => $id
]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

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
    $stmt->execute([
        'title' => $title,
        'publication_date' => $publication_date,
        'id' => $id
    ]);

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
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <h1>Modifier le livre</h1>
    <form method="POST">
        <label>Titre :</label>
        <input type="text"
               name="title"
               value="<?= $book['title'] ?>">

        <br><br>
        
        <label>Date de publication :</label>
        <input type="date"
               name="publication_date"
               value="<?= $book['publication_date'] ?>">

        <br><br>

        <button type="submit">Modifier</button>

    </form>
</body>
</html>