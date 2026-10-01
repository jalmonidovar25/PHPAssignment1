<?php
require('database.php');

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);

$query = 'SELECT * FROM recipes
          WHERE recipeID = :recipeID';
$statement = $db->prepare($query);
$statement->bindValue(':recipeID', $recipeID);
$statement->execute();
$recipe = $statement->fetch();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Manager - Update Recipe</title>
    <link rel="stylesheet" href="css/recipe.css">
</head>

<body>

    <header>
        <h1>Recipe Manager</h1>
    </header>

    <main>
        <h2>Update Recipe</h2>

        <form action="update_recipe.php" method="post">

            <input type="hidden"
                   name="recipeID"
                   value="<?php echo $recipe['recipeID']; ?>">

            <label>Recipe Name:</label>
            <input type="text"
                   name="recipeName"
                   value="<?php echo $recipe['recipeName']; ?>">
            <br>

            <label>Category:</label>
            <input type="text"
                   name="category"
                   value="<?php echo $recipe['category']; ?>">
            <br>

            <label>Main Ingredient:</label>
            <input type="text"
                   name="mainIngredient"
                   value="<?php echo $recipe['mainIngredient']; ?>">
            <br>

            <label>Cooking Time:</label>
            <input type="number"
                   name="cookingTime"
                   value="<?php echo $recipe['cookingTime']; ?>">
            <br>

            <input type="submit" value="Update Recipe">

        </form>

        <p><a href="index.php">View Recipe List</a></p>

    </main>

    <footer>
        <p>&copy; 2026 Recipe Manager</p>
    </footer>

</body>

</html>