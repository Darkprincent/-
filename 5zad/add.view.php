<?php
require 'config.php';

$groups = $pdo->query("SELECT id, name FROM groups")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Добавить студента</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h1>Добавить студента</h1>
    
    <form method="POST" action="add.php">
        <label>Имя студента:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Группа:</label><br>
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group['id'] ?>">
                    <?= htmlspecialchars($group['name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <button class="btn btn-primary" type="submit">Добавить</button>
        <a class="btn btn-warning" href="index.php">Отмена</a>
    </form>
</body>
</html>