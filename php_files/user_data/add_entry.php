<?php

session_start();
$username = $_SESSION['username'];


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome, <?php echo $username?></title>
    <link rel="stylesheet" type="text/css" href="./../../css_files/main-style.css">
</head>
<body>
<header>
    <div class="header-div">
        <h1 class="website-title">Recipe Jar!</h1>
        <nav class="desktop-nav-parent">
            <ul>
                <li><?php echo "Hello, ".ucfirst($_SESSION['username'])."!"; ?></li>&nbsp;&nbsp;
                <li><a href="../../php_files/signout.php">Sign Out</a></li>
            </ul>
        </nav>
    </div>
</header>
    <div id="wrapper">

        <main>

            <div class="recipe-container">
                <form action="" method="post">
                    <div class="recipe-input-container">

                        <input placeholder="Title" type="text" name="RecipeTitle" size="40" required><br>
                        <textarea placeholder="Ingredients" name="Ingredients" rows="15" cols="70" required></textarea><br>
                        <textarea placeholder="Instructions" name="Instructions" rows="15" cols="70" required></textarea><br>

                        <input type="submit" name="submit" value="Add!">
                        <ul class="buttons">

                            <li><a href="../../php_files/home.php" class="button">Back</a></li>

                        </ul>

                    </div>
                </form>
            </div>

                <?php

                include "../../php_files/config.php";

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    mysqli_set_charset($con, 'utf8');

                    $problem = FALSE;
                    if (!empty($_POST['RecipeTitle']) && !empty($_POST['Ingredients']) && !empty($_POST['Instructions'])) {
                        $recipeTitle = mysqli_real_escape_string($con, trim(strip_tags($_POST['RecipeTitle'])));
                        $ingredients = mysqli_real_escape_string($con, trim(strip_tags($_POST['Ingredients'])));
                        $instructions = mysqli_real_escape_string($con, trim(strip_tags($_POST['Instructions'])));

                    } else {
                        print '<p>Please fill all fields.</p>';
                        $problem = TRUE;
                    }
                    if (!$problem) {


                        $query = "INSERT INTO tRecipes (RecipeID, Username, RecipeTitle, Ingredients, CreationDate, Instructions) VALUES (0, '$username', '$recipeTitle', '$ingredients', NOW(), '$instructions')";


                        if (@mysqli_query($con, $query)) {

                            print '<p style="text-align: center">Recipe Added!</p>';

                        } else {

                            print '<p style="color: red;">Could not add the entry because:<br>' . mysqli_error($con) . '.</p><p>The query being run was: ' . $query . '</p>';

                        }
                    }
                    mysqli_close($con);
                }

                ?>

        </main>

    </div>
<footer>
    <?php

    require('../../php_files/footer.php');

    ?>
</footer>
</body>
</html>