<?php

session_start();
$username = $_SESSION['username'];
//$recipe = $_SESSION['recipe'];

?>
<!DOCTYPE html>
<html lang="en">
<div class="home-page">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css_files/main-style.css">
<title>Welcome, <?php echo $username?></title>
</head>
<body>
	<div id="wrapper">
		<header>
            <div class="header-div">
            <h1 class="website-title">Recipe Jar!</h1>
                <nav class="desktop-nav-parent">
                    <ul>
                        <li><?php echo "Hello, ".ucfirst($_SESSION['username'])."!"; ?></li>&nbsp;
                        <li><a href="signout.php">Sign Out</a></li>
                    </ul>
                </nav>
            </div>
		</header>
    	<div id="main">
				<div class="box-container">
                    <ul class="buttons">
                        <li><a class="button" href="user_data/add_entry.php">Add</a></li>
                    </ul>

                        <?php
                        include "config.php";

                        $query = "SELECT * FROM tRecipes WHERE Username='".$username."'";

                        if ($r = mysqli_query($con, $query)) { // Run the query

                            // Retrieve and print every record
                            //$counter = 1;
                            while ($row = mysqli_fetch_array($r)) {

                                if (count($row) == 0){
                                    print '<p>You have no recipies!</p>';
                                }

                                print
                                    "<div class='recipe-box'>
                                        
                                        <fieldset class='home-fieldset'>
                                        
                                            <label>{$row['RecipeTitle']}</label><br>
                                            <label>{$row['CreationDate']}</label><br>
                                            
                                            <ul class='buttons'>
                                                
                                                <li><a class='button' href=\"user_data/edit_entry.php?RecipeID={$row['RecipeID']}\">View | Edit</a></li>
                                                <li><a class='button' href=\"user_data/delete_entry.php?RecipeID={$row['RecipeID']}\">Delete</a></li>
                                            </ul> 
                                        
                                        </fieldset>
                         
                                    </div>";

                            } // end while

                        }

                        mysqli_close($con);

                        ?>

				</div>
    	</div> <!-- END main -->

    	<footer>
    		<?php

    		  require('footer.php');

    	    ?>
    	</footer>
	</div>
</body>
</div>
</html>
