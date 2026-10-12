
<?php
require('database.php');

$recipeID = filter_input(INPUT_GET, 'recipeID', FILTER_VALIDATE_INT);

if ($recipeID == null || $recipeID == false) {
    header('Location: index.php');
    exit();
}

$query = 'SELECT * FROM recipes
          WHERE recipeID = :recipeID';

$statement = $db->prepare($query);
$statement->bindValue(':recipeID', $recipeID);
$statement->execute();
$recipe = $statement->fetch();
$statement->closeCursor();

if ($recipe == false) {
    header('Location: index.php');
    exit();
}

$image_name = $recipe['recipeImage'];

if ($image_name == null || $image_name == '') {
    $image_name = 'placeholder_100.jpg';
}

$image_name = str_replace('_100.', '_400.', $image_name);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Manager - Recipe Details</title>
    <link rel="stylesheet" href="css/recipe.css">
</head>

<body>

    <header>
        <h1>Recipe Manager</h1>
    </header>

    <main>
        <h2>Recipe Details</h2>

        <h3>
            <?php echo htmlspecialchars($recipe['recipeName']); ?>
        </h3>

        <p>
            <img src="images/<?php echo htmlspecialchars($image_name); ?>"
                 alt="<?php echo htmlspecialchars($recipe['recipeName']); ?>">
        </p>

        <p>
            <strong>Recipe Name:</strong>
            <?php echo htmlspecialchars($recipe['recipeName']); ?>
        </p>

        <p>
            <strong>Category:</strong>
            <?php echo htmlspecialchars($recipe['category']); ?>
        </p>

        <p>
            <strong>Main Ingredient:</strong>
            <?php echo htmlspecialchars($recipe['mainIngredient']); ?>
        </p>

        <p>
            <strong>Cooking Time:</strong>
            <?php echo htmlspecialchars($recipe['cookingTime']); ?> minutes
        </p>

        <p>
            <a href="index.php">Back to Recipe List</a>
        </p>

    </main>

    <footer>
        <p>&copy; 2026 Recipe Manager</p>
    </footer>

</body>

</html>
