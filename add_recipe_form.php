<!DOCTYPE html>
<html>

<head>
    <title>Recipe Manager - Add Recipe</title>
    <link rel="stylesheet" href="css/recipe.css">
</head>

<body>

    <header>
        <h1>Recipe Manager</h1>
    </header>

    <main>
        <h2>Add Recipe</h2>

        <form action="add_recipe.php" method="post">

            <label>Recipe Name:</label>
            <input type="text" name="recipeName">
            <br>

            <label>Category:</label>
            <input type="text" name="category">
            <br>

            <label>Main Ingredient:</label>
            <input type="text" name="mainIngredient">
            <br>

            <label>Cooking Time:</label>
            <input type="number" name="cookingTime">
            <br>

            <input type="submit" value="Add Recipe">

        </form>

        <p><a href="index.php">View Recipe List</a></p>
    </main>

    <footer>
        <p>&copy; 2026 Recipe Manager</p>
    </footer>

</body>

</html>