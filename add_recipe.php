<?php
require('database.php');

$recipeName = filter_input(INPUT_POST, 'recipeName');
$category = filter_input(INPUT_POST, 'category');
$mainIngredient = filter_input(INPUT_POST, 'mainIngredient');
$cookingTime = filter_input(INPUT_POST, 'cookingTime');

$query = 'INSERT INTO recipes
             (recipeName, category, mainIngredient, cookingTime)
          VALUES
             (:recipeName, :category, :mainIngredient, :cookingTime)';

$statement = $db->prepare($query);
$statement->bindValue(':recipeName', $recipeName);
$statement->bindValue(':category', $category);
$statement->bindValue(':mainIngredient', $mainIngredient);
$statement->bindValue(':cookingTime', $cookingTime);
$statement->execute();
$statement->closeCursor();

header('Location: add_recipe_confirmation.php');
?>