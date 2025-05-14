<?php
session_start();
include 'auth.php';
include 'db.php';
include 'header.php';

// Fetch categories
$categories = $conn->query("SELECT id, name FROM categories");
?>
<main>
    <h2>Add New Task</h2>
    <form method="POST" action="handle_add_task.php">
        <input type="text" name="title" placeholder="Title" required>
        <label>Priority:</label>
        <select name="priority" required>
            <option value="Low">Low</option>
            <option value="Medium" selected>Medium</option>
            <option value="High">High</option>
        </select>
        <label>Category:</label>
        <select name="category_id" required>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endwhile; ?>
        </select>
        <input type="date" name="due_date" required>
        <button type="submit">Add Task</button>
    </form>
</main>
