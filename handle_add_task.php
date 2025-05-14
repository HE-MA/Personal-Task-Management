<?php
session_start();
include 'auth.php';
include 'db.php';

$title = trim($_POST['title']);
$priority = $_POST['priority'];
$category_id = intval($_POST['category_id']);
$due_date = $_POST['due_date'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("INSERT INTO tasks (title, due_date, priority, category_id, user_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $title, $due_date, $priority, $category_id, $user_id);
$stmt->execute();

header("Location: index.php");
exit;
?>
