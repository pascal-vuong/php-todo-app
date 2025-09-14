<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My To-Do List</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="form-container">

        <!-- Header -->
        <div class="dashboard-header">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        </div>

        <!-- Task form -->
        <div class="task-form">
            <h3>Add a new task:</h3>
            <form method="post" action="index.php">
                <input type="text" name="task" placeholder="Enter your task..." required>
                <button type="submit">Add Task</button>
            </form>
        </div>
    
        <!-- Message box -->
        <?php if (!empty($message)): ?>
            <div class="message-box">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Task list -->
        <div class="task-list">
            <h3>Task List:</h3>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <div class="task-item-title">
                            <?php echo htmlspecialchars($task["task"]); ?>
                        </div>
                        <div class="task-status">
                            <?php echo $task["completed"] ? "✅ Done" : "⏳ Pending"; ?>
                        </div>
                        <div class="task-actions">
                            <?php if (!$task["completed"]): ?>
                                <a href="index.php?complete=<?php echo $task['id']; ?>">Mark as Done</a>
                            <?php endif; ?>
                            <a href="index.php?delete=<?php echo $task['id']; ?>"
                               class="delete-link"
                               onclick="return confirm('Are you sure you want to delete this task?');">
                                Delete
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Logout at bottom -->
        <div class="logout-footer">
            <a href="logout.php">Logout</a>
        </div>
        
    </div>

</body>
</html>
