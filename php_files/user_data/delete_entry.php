<!DOCTYPE html>
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

        if (isset($_GET['RecipeID']) && is_numeric($_GET['RecipeID']) ) { // Display the entry in a form:

            $query = "SELECT * FROM tRecipes WHERE RecipeID={$_GET['RecipeID']}";
            if ($r = mysqli_query($con, $query)) {
                $row = mysqli_fetch_array($r);

            print
            '<form action="delete_entry.php" method="post">
                <div class="recipe-input-container">
                
                <input style="border-style: none" READONLY placeholder="Title" type="text" name="RecipeTitle" size="40" value="' . htmlentities($row['RecipeTitle']) . '" required><br>
                <textarea style="border-style: none" readonly placeholder="Ingredients" name="Ingredients" rows="15" cols="70" required>'.htmlentities($row['Ingredients']).'</textarea><br>
                <textarea style="border-style: none" readonly placeholder="Instructions" name="Instructions" rows="15" cols="70" required>'.htmlentities($row['Instructions']).'</textarea><br>
                
                <input type="hidden" name="RecipeID" value="' . $_GET['RecipeID'] . '">
                <input class="button" type="submit" name="submit" value="Delete">
                <ul class="buttons">
                    <li class="button"><a href="../../php_files/home.php" class="button">Back</a></li>
                </ul>  
                
                </div>
            </form>';
            } else {
                print
                    '<p style="color: red;">Could not retrieve entry because:<br>' .
                    mysqli_error($con) . '.</p><p>The query being run was: ' . $query . '</p>';
            }
        } elseif (isset($_POST['RecipeID']) && is_numeric($_POST['RecipeID'])) {

            $query = "DELETE FROM tRecipes WHERE RecipeID={$_POST['RecipeID']} LIMIT 1";
            $r = mysqli_query($con, $query);

            if (mysqli_affected_rows($con) == 1) {
                print
                    '<p style="text-align: center">Recipe Deleted</p>
                
                    <ul class="buttons">
                    
                    <li><a href="../../php_files/home.php" class="button">Back</a></li>
                    
                    </ul>
                
                ';
            } else {
                print '<p style="color: red;">Could not delete entry because:<br>' .
                    mysqli_error($con) . '.</p><p>The query being run was alex: ' . $query . '</p>';
            }
        } else {
            print '<p style="color: red;">Error has occurred.</p>';
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