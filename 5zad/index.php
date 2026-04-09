<?php
require 'config.php';

$stmt = $pdo->query("
    SELECT students.id, students.name, groups.name AS group_name
    FROM students
    LEFT JOIN groups ON students.group_id = groups.id
");

$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Список студентов</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .actions a { margin-right: 10px; text-decoration: none; }
    </style>
</head>
<body style="background-color: #e7c4ff;">
    <h1>Список студентов</h1>
    
    <a class="btn btn-info" href="add.view.php">➕ Добавить студента</a>
    <a class="btn btn-light" href="schedule.php">Imfo</a>
    
    <table style="background-color: #554830;">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Группа</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= $student['group_name'] ?? '—' ?></td>
            <td class="actions">
                <a class="btn btn-secondary" href="edit.php?id=<?= $student['id'] ?>">✏️</a>
                <a class="btn btn-danger" href="delete.php?id=<?= $student['id'] ?>" 
                    onclick="return confirm('Удалить студента?')">🗑️</a>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

