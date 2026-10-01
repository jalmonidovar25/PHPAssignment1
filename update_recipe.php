<?php
session_start();
require('database.php');

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);
$recipeName = filter_input(INPUT_POST, 'recipeName');
$category = filter_input(INPUT_POST, 'category');
$mainIngredient = filter_input(INPUT_POST, 'mainIngredient');
$cookingTime = filter_input(INPUT_POST, 'cookingTime', FILTER_VALIDATE_INT);

if ($recipeID == null || $recipeName == null ||
    $category == null || $mainIngredient == null ||
    $cookingTime == null) {

    $_SESSION["update_error"] = "Invalid recipe data. Check all fields and try again.";

    header("Location: update_error.php");
    exit();
}

$query = 'UPDATE recipes
          SET recipeName = :recipeName,
              category = :category,
              mainIngredient = :mainIngredient,
              cookingTime = :cookingTime
          WHERE recipeID = :recipeID';

$statement = $db->prepare($query);
$statement->bindValue(':recipeName', $recipeName);
$statement->bindValue(':category', $category);
$statement->bindValue(':mainIngredient', $mainIngredient);
$statement->bindValue(':cookingTime', $cookingTime);
$statement->bindValue(':recipeID', $recipeID);
$statement->execute();
$statement->closeCursor();

header('Location: update_recipe_confirmation.php');
?>