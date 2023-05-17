<?php

    session_start();
    $login_time = $_SESSION['login_time'];
    $username = $_SESSION['username'];
    session_unset();
    session_destroy();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="signout-page">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css_files/main-style.css">
    <title>Goodbye, <?php $username?>!</title>
  </head>
  <body>

  <header>
      <div class="header-div">
          <h1 class="website-title">Recipe Jar!</h1>
      </div>
  </header>

      <main>

        <?php 
        
          print "<p style='margin-top:10em; text-align:center;'>".ucfirst($username)." signed out!</p>";
          print '<p style="text-align: center">Login Time: '. $login_time .'</p>';
          print '<p style="text-align: center">Logout Time: '.date("h:i") .'</p>';
          print '<ul class="buttons">
                  <li><a class="button" href="login-form.php">To Login</a></li>
                </ul>';
        
        ?>

      </main>

    <footer>
      <?php
        require('footer.php');
      ?>
    </footer>

  </body>
</html>
