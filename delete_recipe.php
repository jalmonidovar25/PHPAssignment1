<?php
require('database.php');

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);

if ($recipeID != false) {

    $query = 'SELECT recipeImage FROM recipes
              WHERE recipeID = :recipeID';
    $statement = $db->prepare($query);
    $statement->bindValue(':recipeID', $recipeID);
    $statement->execute();
    $recipe = $statement->fetch();
    $statement->closeCursor();

    if ($recipe && $recipe['recipeImage'] != null) {

        $image_name = $recipe['recipeImage'];
        $i = strrpos($image_name, '.');
        $name = substr($image_name, 0, $i);
        $ext = substr($image_name, $i);

        $image_dir = __DIR__ . '/images/';

        $original = $image_dir . $image_name;
        $image_100 = $image_dir . $name . '_100' . $ext;
        $image_400 = $image_dir . $name . '_400' . $ext;

        if (file_exists($original)) {
            unlink($original);
        }

        if (file_exists($image_100)) {
            unlink($image_100);
        }

        if (file_exists($image_400)) {
            unlink($image_400);
        }
    }

    $query = 'DELETE FROM recipes
              WHERE recipeID = :recipeID';

    $statement = $db->prepare($query);
    $statement->bindValue(':recipeID', $recipeID);
    $statement->execute();
    $statement->closeCursor();
}

header('Location: index.php');
?>