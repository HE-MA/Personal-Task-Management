<?php
session_start();
include 'auth.php';
include 'db.php';
include 'header.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT tasks.*, categories.name AS category_name FROM tasks 
        LEFT JOIN categories ON tasks.category_id = categories.id 
        WHERE tasks.user_id = ? ORDER BY due_date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<main>
    <h2>Your Tasks</h2>
    <ul class="task-list">
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($row['title']) ?></strong><br>
                Priority: <?= $row['priority'] ?><br>
                Category: <?= htmlspecialchars($row['category_name']) ?><br>
                Due: <?= $row['due_date'] ?><br>
                <a href="edit_task.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                <form method="POST" action="delete_task.php" style="display:inline;">
                    <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                    <button type="submit" onclick="return confirm('Delete this task?')">🗑 Delete</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</main>
