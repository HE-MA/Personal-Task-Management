<?php
session_start();
include 'auth.php';
include 'db.php';

$task_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Fetch task
$stmt = $conn->prepare("SELECT title, due_date, priority, category_id FROM tasks WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $task_id, $user_id);
$stmt->execute();
$stmt->bind_result($title, $due_date, $priority, $category_id);
if (!$stmt->fetch()) {
    echo "Task not found!";
    exit;
}
$stmt->close();

// Fetch categories
$categories = $conn->query("SELECT id, name FROM categories");

include 'header.php';
?>
<main>
    <h2>Edit Task</h2>
    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>
        <label>Priority:</label>
        <select name="priority" required>
            <option value="Low" <?= $priority == 'Low' ? 'selected' : '' ?>>Low</option>
            <option value="Medium" <?= $priority == 'Medium' ? 'selected' : '' ?>>Medium</option>
            <option value="High" <?= $priority == 'High' ? 'selected' : '' ?>>High</option>
        </select>
        <label>Category:</label>
        <select name="category_id" required>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $category_id ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
            <?php endwhile; ?>
        </select>
        <input type="date" name="due_date" value="<?= $due_date ?>" required>
        <button type="submit">Update Task</button>
    </form>
</main>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_title = trim($_POST['title']);
    $new_priority = $_POST['priority'];
    $new_category_id = intval($_POST['category_id']);
    $new_due_date = $_POST['due_date'];

    $stmt = $conn->prepare("UPDATE tasks SET title=?, due_date=?, priority=?, category_id=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sssiii", $new_title, $new_due_date, $new_priority, $new_category_id, $task_id, $user_id);
    $stmt->execute();
    header("Location: index.php");
    exit;  // This should just be "exit" without the "::" part.
}
?>
