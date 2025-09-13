<?php
session_start();
require 'db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$message = "";

// Handle new task submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
    $task = trim($_POST["task"]);

    if ($task !== "") {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task) 
                               VALUES (?, ?)");
        if ($stmt->execute([$_SESSION["user_id"], $task])) {
            header("Location: index.php?added=1");
            exit;
        } else {
            $message = "❌ Failed to add task.";
        }
    }
}

// Show message if redirected after adding
if (isset($_GET["added"])) {
    $message = "✅ Task added successfully!";
}

// Handle marking a task as complete
if (isset($_GET["complete"])) {
    $taskId = (int) $_GET["complete"];

    $stmt = $pdo->prepare("UPDATE tasks
                           SET completed = 1
                           WHERE id = ? AND user_id = ?");
    $stmt->execute([$taskId, $_SESSION["user_id"]]);

    // Redirect to avoid re-triggering on refresh
    header("Location: index.php");
    exit;
}

// Handle deleting a task
if (isset($_GET["delete"])) {
    $taskId = (int) $_GET["delete"];

    $stmt = $pdo->prepare("DELETE FROM tasks
                           WHERE id = ? AND user_id = ?");
    $stmt->execute([$taskId, $_SESSION["user_id"]]);

    // Redirect to avoid re-triggering on refresh
    header("Location: index.php?deleted=1");
    exit;
}

// Show message if task was deleted
if (isset($_GET["deleted"])) {
    $message = "🗑️ Task deleted successfully!";
}

// Fetch tasks for the logged-in user
$stmt = $pdo->prepare("SELECT id, task, completed, created_at 
                       FROM tasks 
                       WHERE user_id = ? 
                       ORDER BY created_at DESC");
$stmt->execute([$_SESSION["user_id"]]);
$tasks = $stmt->fetchAll();

// Load the HTML template
include 'templates/index_view.php';

?>

