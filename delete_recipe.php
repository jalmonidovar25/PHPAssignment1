<?php
require('database.php');

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);

if ($recipeID != false) {
    $query = 'DELETE FROM recipes
              WHERE recipeID = :recipeID';

    $statement = $db->prepare($query);
    $statement->bindValue(':recipeID', $recipeID);
    $statement->execute();
    $statement->closeCursor();
}

header('Location: index.php');
?>