<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute(['id' => $id]);
$student = $stmt->fetch();

$groups = $pdo->query("SELECT id, name FROM groups")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Редактировать студента</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h1>Редактировать студента</h1>
    
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">
        
        <label>Имя студента:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br><br>
        
        <label>Группа:</label><br>
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group['id'] ?>" 
                    <?= $group['id'] == $student['group_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($group['name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <button class="btn btn-primary" type="submit">Сохранить</button>
        <a class="btn btn-warning" href="index.php">Отмена</a>
    </form>
</body>
</html>
