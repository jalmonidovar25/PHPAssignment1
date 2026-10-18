
<?php
session_start();

$login_error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Manager - User Login</title>
    <link rel="stylesheet" href="css/recipe.css">
</head>

<body>

    <header>
        <h1>Recipe Manager</h1>
    </header>

    <main>
        <h2>User Login</h2>

        <?php if ($login_error != '') : ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($login_error); ?>
            </p>
        <?php endif; ?>

        <form action="login_user.php" method="post">

            <label>Username:</label>
            <input type="text" name="userName" required>
            <br>

            <label>Password:</label>
            <input type="password" name="password" required>
            <br>

            <input type="submit" value="Login">

        </form>

        <p>
            Don't have an account?
            <a href="registration_form.php">Register Here</a>
        </p>

        <p><a href="index.php">Back to Recipe List</a></p>

    </main>

    <footer>
        <p>&copy; 2026 Recipe Manager</p>
    </footer>

</body>

</html>
