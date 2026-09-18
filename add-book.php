<?php

session_start();

require_once "db.php";

$sql = "SELECT * FROM author";
$stmt = $pdo->query($sql);
$auteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = $_POST["titre"];

    if (empty(trim($titre))) {
        echo "Le titre du livre est obligatoire.";
    } else {
        $date_publication= $_POST["date_publication"];
        $id_auteur = $_POST["id_auteur"];
        $sql = "INSERT INTO book (title, publication_date, author_id)
                VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $titre,
            $date_publication,
            $id_auteur
        ]);

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
            
            <?php foreach ($auteurs as $auteur) { ?>
        
                <option value="<?=  $auteur["id"] ?>">
                    <?= htmlspecialchars($auteur["lastname"]) ?>
                    <?= htmlspecialchars($auteur["firstname"]) ?>
                </option>
                
            <?php } ?>

        </select>

        <br><br>

        <button type="submit">Ajouter le livre</button>

        </form>

    </body>
</html>