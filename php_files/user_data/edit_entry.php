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
                <li><?php echo "Hello, ".ucfirst($_SESSION['username'])."!"; ?></li>&nbsp;
                <li><a href="../../php_files/signout.php">Sign Out</a></li>
            </ul>
        </nav>
    </div>
</header>

    <div id="wrapper">
        <main>
            <div class="recipe-container">
                <?php
                include "../../php_files/config.php";

                mysqli_set_charset($con, 'utf8');
                if (isset($_GET['RecipeID']) && is_numeric($_GET['RecipeID']) ) {

                    $query = "SELECT RecipeTitle, Ingredients, CreationDate, Instructions FROM tRecipes WHERE RecipeID={$_GET['RecipeID']}";
                    if ($r = mysqli_query($con, $query)) {
                        $row = mysqli_fetch_array($r);

                        print
                            '<form action="edit_entry.php" method="post">
                                <div class="recipe-input-container">
                                
                                    <input placeholder="Title" type="text" name="RecipeTitle" size="40" value="' . htmlentities($row['RecipeTitle']) . '" required><br>
                                    <textarea placeholder="Ingredients" name="Ingredients" rows="15" cols="70" required>'.htmlentities($row['Ingredients']).'</textarea><br>
                                    <textarea placeholder="Instructions" name="Instructions" rows="15" cols="70" required>'.htmlentities($row['Instructions']).'</textarea><br>
                                    
                                    <input type="hidden" name="RecipeID" value="' . $_GET['RecipeID'] . '">
                                    <input class="button" type="submit" name="submit" value="Confirm">
                                    <ul class="buttons">
                                        <li class="button"><a href="../../php_files/home.php" class="button">Back</a></li>
                                    </ul>    
                                
                                </div>
	                          </form>';
                    } else {
                        print '<p style="color: red;">Could not retrieve the entry because:<br>' .
                            mysqli_error($con) . '.</p><p>The query being run was: ' . $query . '</p>';
                    }
                } elseif (isset($_POST['RecipeID']) && is_numeric($_POST['RecipeID'])) {

                    $problem = FALSE;
                    if (!empty($_POST['RecipeTitle']) && !empty($_POST['Ingredients'])  && !empty($_POST['Instructions'])) {
                        $recipeTitle = mysqli_real_escape_string($con, trim(strip_tags($_POST['RecipeTitle'])));
                        $ingredients = mysqli_real_escape_string($con, trim(strip_tags($_POST['Ingredients'])));
                        $instructions = mysqli_real_escape_string($con, trim(strip_tags($_POST['Instructions'])));

                    } else {
                        print '<p>Please fill out all fields.</p>';
                        $problem = TRUE;
                    }
                    if (!$problem) {

                        $query = "UPDATE tRecipes SET RecipeTitle='$recipeTitle', Ingredients='$ingredients', Instructions='$instructions' WHERE RecipeID={$_POST['RecipeID']}";
                        $r = mysqli_query($con, $query);

                        if (mysqli_affected_rows($con) == 1) {
                            print
                                '<p style="text-align: center">Recipe Updated!</p>
                                    
                                    <ul class="buttons">
                                    
                                        <li><a href="../../php_files/home.php" class="button">Back</a></li>
                                    
                                    </ul>
                                    
                                    
                                ';
                        } else {
                            print '<p>Could not update. Try again.</p>';
                        }
                    }
                } else {
                    print '<p style="color: red;">An Error has occurred. Try again later.</p>';
                }
                mysqli_close($con);
                ?>


            </div>
        </main>

    </div>
<footer>
    <?php

    require('../../php_files/footer.php');

    ?>
</footer>

</body>
</html>
