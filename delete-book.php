<?php

session_start();

require_once 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM book WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id' => $id
]);

$_SESSION['message'] = "Livre supprimé avec succès !";

header('Location: list.php');
exit;