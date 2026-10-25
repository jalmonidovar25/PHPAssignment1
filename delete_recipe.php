
<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: login_form.php');
    exit();
}

require('database.php');

$userID = $_SESSION['userID'];

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);

if ($recipeID != false) {
    $query = 'DELETE FROM recipes
              WHERE recipeID = :recipeID
              AND userID = :userID';

    $statement = $db->prepare($query);
    $statement->bindValue(':recipeID', $recipeID);
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $statement->closeCursor();
}

header('Location: index.php');
exit();
?>
