
<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: login_form.php');
    exit();
}

require('database.php');
require('image_util.php');

$userID = $_SESSION['userID'];

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

$query = 'SELECT recipeImage FROM recipes
          WHERE recipeID = :recipeID
          AND userID = :userID';

$statement = $db->prepare($query);
$statement->bindValue(':recipeID', $recipeID);
$statement->bindValue(':userID', $userID);
$statement->execute();
$recipe = $statement->fetch();
$statement->closeCursor();

if ($recipe == false) {
    $_SESSION["update_error"] = "Recipe not found.";
    header("Location: update_error.php");
    exit();
}

$image_name = $recipe['recipeImage'];
$image_dir = __DIR__ . '/images';

if (isset($_FILES['recipeImage']) &&
    $_FILES['recipeImage']['error'] == UPLOAD_ERR_OK) {

    $image = $_FILES['recipeImage'];
    $image_temp = $image['tmp_name'];

    $image_info = getimagesize($image_temp);

    if ($image_info == false ||
        !in_array($image_info[2], array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF))) {

        $_SESSION["update_error"] = "Please select a JPEG, PNG, or GIF image.";
        header("Location: update_error.php");
        exit();
    }

    $extension = image_type_to_extension($image_info[2]);
    $new_image_name = uniqid('recipe_', true) . $extension;
    $image_path = $image_dir . DIRECTORY_SEPARATOR . $new_image_name;

    if (!move_uploaded_file($image_temp, $image_path)) {
        $_SESSION["update_error"] = "The image could not be uploaded.";
        header("Location: update_error.php");
        exit();
    }

    process_image($image_dir, $new_image_name);

    $i = strrpos($new_image_name, '.');
    $image_name = substr($new_image_name, 0, $i) . '_100' .
                  substr($new_image_name, $i);
}

$query = 'UPDATE recipes
          SET recipeName = :recipeName,
              category = :category,
              mainIngredient = :mainIngredient,
              cookingTime = :cookingTime,
              recipeImage = :recipeImage
          WHERE recipeID = :recipeID
          AND userID = :userID';

$statement = $db->prepare($query);
$statement->bindValue(':recipeName', $recipeName);
$statement->bindValue(':category', $category);
$statement->bindValue(':mainIngredient', $mainIngredient);
$statement->bindValue(':cookingTime', $cookingTime);
$statement->bindValue(':recipeImage', $image_name);
$statement->bindValue(':recipeID', $recipeID);
$statement->bindValue(':userID', $userID);
$statement->execute();
$statement->closeCursor();

header('Location: update_recipe_confirmation.php');
exit();
?>
