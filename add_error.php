<?php
session_start();
?>

<!DOCTYPE html>

<html>

    <head>
        <title>Recipe Manager - Add Error</title>
        <link rel="stylesheet" type="text/css" href="css/recipe.css" />
    </head>

    <body>

        <?php include("header.php"); ?>

        <main>
            <h2>Add Error</h2>

            <p>Error Message: <?php echo $_SESSION["add_error"]; ?> </p>

            <p><a href="add_recipe_form.php">Add Recipe</a></p>
            <p><a href="index.php">View Recipe List</a></p>
        </main>

        <?php include("footer.php"); ?>

    </body>

</html>