
<?php
session_start();
require('database.php');

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];

    $query = 'SELECT * FROM recipes
              WHERE userID = :userID';

    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $recipes = $statement->fetchAll();
    $statement->closeCursor();
} else {
    $recipes = array();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Manager - Home</title>
    <link rel="stylesheet" href="css/recipe.css">
</head>

<body>

    <header>
        <h1>Recipe Manager</h1>

        <?php if (isset($_SESSION['userID'])) : ?>

            <p>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['userName']); ?>!
            </p>

            <p>
                <a href="logout.php" style="color: white;">Logout</a>
            </p>

        <?php else : ?>

            <p>
                <a href="login_form.php" style="color: white;">Login</a>
                |
                <a href="registration_form.php" style="color: white;">Register</a>
            </p>

        <?php endif; ?>

    </header>

    <main>
        <h2>Recipe List</h2>

        <?php if (isset($_SESSION['userID'])) : ?>

            <?php if (count($recipes) > 0) : ?>

                <table>
                    <tr>
                        <th>Image</th>
                        <th>Recipe Name</th>
                        <th>Category</th>
                        <th>Main Ingredient</th>
                        <th>Cooking Time</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>

                    <?php foreach ($recipes as $recipe) : ?>
                        <tr>
                            <td>
                                <?php if ($recipe['recipeImage'] != null) : ?>
                                    <img src="images/<?php echo htmlspecialchars($recipe['recipeImage']); ?>"
                                         alt="<?php echo htmlspecialchars($recipe['recipeName']); ?>">
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="recipe_details.php?recipeID=<?php echo $recipe['recipeID']; ?>">
                                    <?php echo htmlspecialchars($recipe['recipeName']); ?>
                                </a>
                            </td>

                            <td><?php echo htmlspecialchars($recipe['category']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['mainIngredient']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['cookingTime']); ?> minutes</td>

                            <td>
                                <a href="recipe_details.php?recipeID=<?php echo $recipe['recipeID']; ?>">
                                    View Details
                                </a>
                            </td>

                            <td>
                                <form action="update_recipe_form.php" method="post">
                                    <input type="hidden"
                                           name="recipeID"
                                           value="<?php echo $recipe['recipeID']; ?>">

                                    <input type="submit" value="Update">
                                </form>
                            </td>

                            <td>
                                <form action="delete_recipe.php" method="post">
                                    <input type="hidden"
                                           name="recipeID"
                                           value="<?php echo $recipe['recipeID']; ?>">

                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            <?php else : ?>

                <p>You have no recipes yet.</p>

            <?php endif; ?>

            <p><a href="add_recipe_form.php">Add Recipe</a></p>

        <?php else : ?>

            <p>Please login to view your recipes.</p>

        <?php endif; ?>

    </main>

    <footer>
        <p>&copy; 2026 Recipe Manager</p>
    </footer>

</body>

</html>
