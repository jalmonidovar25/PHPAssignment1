
<?php
session_start();

$registration_error = $_SESSION['registration_error'] ?? '';
$registration_success = $_SESSION['registration_success'] ?? '';

unset($_SESSION['registration_error']);
unset($_SESSION['registration_success']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Manager - User Registration</title>
    <link rel="stylesheet" href="css/recipe.css">
</head>

<body>

    <header>
        <h1>Recipe Manager</h1>
    </header>

    <main>
        <h2>User Registration</h2>

        <?php if ($registration_error != '') : ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($registration_error); ?>
            </p>
        <?php endif; ?>

        <?php if ($registration_success != '') : ?>
            <p style="color: green;">
                <?php echo htmlspecialchars($registration_success); ?>
            </p>
        <?php endif; ?>

        <form action="register_user.php" method="post">

            <label>Username:</label>
            <input type="text" name="userName" required>
            <br>

            <label>Email Address:</label>
            <input type="email" name="emailAddress" required>
            <br>

            <label>Password:</label>
            <input type="password" name="password" required>
            <br>

            <label>Confirm Password:</label>
            <input type="password" name="confirmPassword" required>
            <br>

            <input type="submit" value="Register">

        </form>

        <p><a href="index.php">Back to Recipe List</a></p>

    </main>

    <footer>
        <p>&copy; 2026 Recipe Manager</p>
    </footer>

</body>

</html>
