<?php
require 'config.php';

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    die("Ошибка удаления: " . $e->getMessage());
}
?>
