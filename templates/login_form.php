<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="form-container">
    
    <h2>Login</h2>

        <p class="feedback">
            <?php echo $message; ?>
        </p>
    
    <form method="post" action="login.php">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>    

</div>

</body>

</html>

