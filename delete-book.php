<?php

require_once 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM book WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id' => $id
]);

header('Location: list.php');
exit;