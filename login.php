<?php
// Start the session to track logged-in users
session_start();

// Connect to the database
require 'db_connect.php';

// Message for user feedback
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Look up the user in the database
    $stmt = $pdo->prepare("SELECT id, password
                           FROM users
                           WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Password matches → log the user in
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $username;

        // Redirect to task dashboard (home page)
        header("Location: index.php");
        exit;
    } else {
        $message = "❌ Invalid username or password.";
    }
}

// Load the HTML form template
include 'templates/login_form.php';
?>