<?php
require 'config.php';

$name = $_POST['name'];
$group_id = $_POST['group_id'];

try {
    $stmt = $pdo->prepare("
        INSERT INTO students (name, group_id) 
        VALUES (:name, :group_id)
    ");
    
    $stmt->execute([
        'name' => $name,
        'group_id' => $group_id
    ]);
    
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    die("Ошибка добавления: " . $e->getMessage());
}
?>
