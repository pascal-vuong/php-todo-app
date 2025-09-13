<?php
// Connect to the database
require 'db_connect.php';

// Message for user feedback
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Check if username is already taken
    $stmt = $pdo->prepare("SELECT id
                           FROM users
                           WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        $message = "❌ Username already taken.";
    } else {
        // Hash the password securely before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password) 
                               VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            $message = "✅ Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $message = "❌ Something went wrong. Try again.";
        }
    }
}

// Load HTML template
include 'templates/register_form.php';
?>