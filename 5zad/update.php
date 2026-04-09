<?php
require 'config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$group_id = $_POST['group_id'];

try {
    $stmt = $pdo->prepare("
        UPDATE students 
        SET name = :name, group_id = :group_id 
        WHERE id = :id
    ");
    
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'group_id' => $group_id
    ]);
    
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    die("Ошибка обновления: " . $e->getMessage());
}
?>
