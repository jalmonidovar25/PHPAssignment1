
<?php
session_start();
require('database.php');

$userName = trim($_POST['userName'] ?? '');
$password = $_POST['password'] ?? '';

if ($userName == '' || $password == '') {

    $_SESSION['login_error'] = 'Please enter your username and password.';

    header('Location: login_form.php');
    exit();
}

$query = 'SELECT * FROM registrations
          WHERE userName = :userName';

$statement = $db->prepare($query);
$statement->bindValue(':userName', $userName);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();

if ($user != false && password_verify($password, $user['password'])) {

    session_regenerate_id(true);

    $_SESSION['userID'] = $user['userID'];
    $_SESSION['userName'] = $user['userName'];

    header('Location: index.php');
    exit();

} else {

    $_SESSION['login_error'] = 'Invalid username or password.';

    header('Location: login_form.php');
    exit();
}
?>
