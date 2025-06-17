
<?php
include('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="wrapper">
    <h2>Todo App</h2>

    <form action="action/insert.php" method="POST">
        <input type="text" name="title" placeholder="Add a task..." required>
        <button type="submit">Add</button>
    </form>

    <ul class="task-list">
        <?php
        $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if (!$result) {
            echo "<p style='color: red;'>Error fetching tasks: " . $conn->error . "</p>";
        } else {
            while ($task = $result->fetch_assoc()):
        ?>
        <li class="<?= $task['status'] === 'done' ? 'done' : '' ?>">
            <form action="action/complete.php" method="POST" class="task-form">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <button type="submit"><?= $task['status'] === 'done' ? '✅' : '🔲' ?></button>
            </form>
            <span><?= htmlspecialchars($task['title']) ?></span>
            <a href="action/remove.php?id=<?= $task['id'] ?>" class="delete-btn">🗑</a>
        </li>
        <?php endwhile; } ?>
    </ul>
</div>
</body>
</html>  