<!DOCTYPE html>
<html>
<head>
    <title>My To-Do List</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
    <a href="logout.php">Logout</a>

    <h3>Add a new task</h3>
    <form method="post" action="index.php">
        <input type="text" name="task" required>
        <button type="submit">Add Task</button>
    </form>

    <p><?php echo $message; ?></p>

    <h3>Your Tasks</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo htmlspecialchars($task["task"]); ?>
                (<?php echo $task["completed"] ? "✅ Done" : "⏳ Pending"; ?>)

                <?php if (!$task["completed"]): ?>
                    <!-- Show complete button only if task is pending -->
                    <a href="index.php?complete=<?php echo $task['id']; ?>">Mark as Done</a>
                <?php endif; ?>

                <a href="index.php?delete=<?php echo $task['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this task?');">
                    Delete
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
