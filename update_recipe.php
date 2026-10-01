<?php
session_start();
require('database.php');
require('image_util.php');

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);
$recipeName = filter_input(INPUT_POST, 'recipeName');
$category = filter_input(INPUT_POST, 'category');
$mainIngredient = filter_input(INPUT_POST, 'mainIngredient');
$cookingTime = filter_input(INPUT_POST, 'cookingTime', FILTER_VALIDATE_INT);
$oldImage = filter_input(INPUT_POST, 'oldImage');

if ($recipeID == null || $recipeName == null ||
    $category == null || $mainIngredient == null ||
    $cookingTime == null) {

    $_SESSION["update_error"] = "Invalid recipe data. Check all fields and try again.";

    header("Location: update_error.php");
    exit();
}

$image = $_FILES['recipeImage'];
$image_name = $image['name'];

if ($image_name == null) {
    $image_name = $oldImage;
} else {
    $image_dir = __DIR__ . '/images';
    $image_temp = $image['tmp_name'];
    $image_path = $image_dir . DIRECTORY_SEPARATOR . $image_name;

    move_uploaded_file($image_temp, $image_path);

    process_image($image_dir, $image_name);
}

$query = 'UPDATE recipes
          SET recipeName = :recipeName,
              category = :category,
              mainIngredient = :mainIngredient,
              cookingTime = :cookingTime,
              recipeImage = :recipeImage
          WHERE recipeID = :recipeID';

$statement = $db->prepare($query);
$statement->bindValue(':recipeName', $recipeName);
$statement->bindValue(':category', $category);
$statement->bindValue(':mainIngredient', $mainIngredient);
$statement->bindValue(':cookingTime', $cookingTime);
$statement->bindValue(':recipeImage', $image_name);
$statement->bindValue(':recipeID', $recipeID);
$statement->execute();
$statement->closeCursor();

header('Location: index.php');
?>