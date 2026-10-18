
<?php
session_start();
require('database.php');

$userName = trim(filter_input(INPUT_POST, 'userName') ?? '');
$emailAddress = trim(filter_input(INPUT_POST, 'emailAddress') ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

if ($userName == '' || $emailAddress == '' ||
    $password == '' || $confirmPassword == '') {

    $_SESSION['registration_error'] = 'Please complete all fields.';
    header('Location: registration_form.php');
    exit();
}

if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['registration_error'] = 'Please enter a valid email address.';
    header('Location: registration_form.php');
    exit();
}

if ($password != $confirmPassword) {

    $_SESSION['registration_error'] = 'Passwords do not match.';
    header('Location: registration_form.php');
    exit();
}

$query = 'SELECT userID FROM registrations
          WHERE userName = :userName
          OR emailAddress = :emailAddress';

$statement = $db->prepare($query);
$statement->bindValue(':userName', $userName);
$statement->bindValue(':emailAddress', $emailAddress);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();

if ($user != false) {

    $_SESSION['registration_error'] = 'Username or email address already exists.';
    header('Location: registration_form.php');
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = 'INSERT INTO registrations
             (userName, password, emailAddress)
          VALUES
             (:userName, :password, :emailAddress)';

$statement = $db->prepare($query);
$statement->bindValue(':userName', $userName);
$statement->bindValue(':password', $hashedPassword);
$statement->bindValue(':emailAddress', $emailAddress);
$statement->execute();
$statement->closeCursor();

$_SESSION['registration_success'] = 'Registration successful. You can now log in.';

header('Location: registration_form.php');
exit();
?>
