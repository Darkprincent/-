<?php
require 'config.php';

$groups = $pdo->query("SELECT id, name FROM groups")->fetchAll();

$filter_group_id = $_GET['group_id'] ?? null;

$sql = "
    SELECT 
        groups.name AS group_name,
        subjects.name AS subject_name,
        teachers.name AS teacher_name
    FROM subjects
    JOIN groups ON subjects.group_id = groups.id
    JOIN teachers ON subjects.teacher_id = teachers.id
";

if ($filter_group_id) {
    $sql .= " WHERE groups.id = :group_id";
}

$sql .= " ORDER BY groups.name, subjects.name";

$stmt = $pdo->prepare($sql);

if ($filter_group_id) {
    $stmt->execute(['group_id' => $filter_group_id]);
} else {
    $stmt->execute();
}

$schedule = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Расписание</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Расписание занятий</h1>
    
    <form method="GET">
        <label>Фильтр по группе:</label>
        <select name="group_id" onchange="this.form.submit()">
            <option value="">Все группы</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group['id'] ?>" 
                    <?= $group['id'] == $filter_group_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($group['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
    
    <table>
        <tr>
            <th>Группа</th>
            <th>Предмет</th>
            <th>Преподаватель</th>
        </tr>
        <?php foreach ($schedule as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['group_name']) ?></td>
            <td><?= htmlspecialchars($item['subject_name']) ?></td>
            <td><?= htmlspecialchars($item['teacher_name']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
