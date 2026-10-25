
<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: login_form.php');
    exit();
}

require('database.php');

$recipeID = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);
$userID = $_SESSION['userID'];

if (!$recipeID) {
    header('Location: index.php');
    exit();
}

$query = 'SELECT * FROM recipes
          WHERE recipeID = :recipeID
          AND userID = :userID';

$statement = $db->prepare($query);
$statement->bindValue(':recipeID', $recipeID);
$statement->bindValue(':userID', $userID);
$statement->execute();
$recipe = $statement->fetch();
$statement->closeCursor();

if ($recipe == false) {
    header('Location: index.php');
    exit();
}
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

        <form action="update_recipe.php" method="post" enctype="multipart/form-data">

            <input type="hidden"
                   name="recipeID"
                   value="<?php echo $recipe['recipeID']; ?>">

            <label>Recipe Name:</label>
            <input type="text"
                   name="recipeName"
                   value="<?php echo htmlspecialchars($recipe['recipeName']); ?>">
            <br>

            <label>Category:</label>
            <input type="text"
                   name="category"
                   value="<?php echo htmlspecialchars($recipe['category']); ?>">
            <br>

            <label>Main Ingredient:</label>
            <input type="text"
                   name="mainIngredient"
                   value="<?php echo htmlspecialchars($recipe['mainIngredient']); ?>">
            <br>

            <label>Cooking Time:</label>
            <input type="number"
                   name="cookingTime"
                   value="<?php echo $recipe['cookingTime']; ?>">
            <br>

            <label>Current Image:</label>
            <img src="images/<?php echo htmlspecialchars($recipe['recipeImage']); ?>"
                 alt="<?php echo htmlspecialchars($recipe['recipeName']); ?>">
            <br>

            <label>New Image:</label>
            <input type="file"
                   name="recipeImage"
                   accept="image/jpeg,image/png,image/gif">
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
