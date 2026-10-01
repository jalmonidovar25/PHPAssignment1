<?php
session_start();
require('database.php');
require('image_util.php');

$recipeName = filter_input(INPUT_POST, 'recipeName');
$category = filter_input(INPUT_POST, 'category');
$mainIngredient = filter_input(INPUT_POST, 'mainIngredient');
$cookingTime = filter_input(INPUT_POST, 'cookingTime', FILTER_VALIDATE_INT);

$image_dir = __DIR__ . '/images';
$image = $_FILES['recipeImage'];
$image_name = $image['name'];

if ($recipeName == null || $category == null ||
    $mainIngredient == null || $cookingTime == null ||
    $image_name == null) {

    $_SESSION["add_error"] = "Invalid recipe data. Check all fields and try again.";

    header("Location: add_error.php");
    exit();
}

$image_temp = $image['tmp_name'];
$image_path = $image_dir . DIRECTORY_SEPARATOR . $image_name;

move_uploaded_file($image_temp, $image_path);

process_image($image_dir, $image_name);

$query = 'INSERT INTO recipes
             (recipeName, category, mainIngredient, cookingTime, recipeImage)
          VALUES
             (:recipeName, :category, :mainIngredient, :cookingTime, :recipeImage)';

$statement = $db->prepare($query);
$statement->bindValue(':recipeName', $recipeName);
$statement->bindValue(':category', $category);
$statement->bindValue(':mainIngredient', $mainIngredient);
$statement->bindValue(':cookingTime', $cookingTime);
$statement->bindValue(':recipeImage', $image_name);
$statement->execute();
$statement->closeCursor();

header('Location: add_recipe_confirmation.php');
?>