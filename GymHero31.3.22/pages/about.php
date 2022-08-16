<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GymHero - About</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto+Condensed:ital,wght@0,300;0,400;1,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <div class="grid-container">
      <div class="logo">
        <a href="../index.php"><img src="../images/logo.png" class="logo" alt="GymHero Logo" /></a>
        <h6>Gym Hero</h6>
      </div>
      <nav>
        <ul>
          <li><a href="about.php" class="current">About</a></li>
          <li><a href="equipment.php">Equipment</a></li>
          <li><a href="timetable.php">Timetable</a></li>
          <li><a href="login.php">Clients Login</a></li>
        </ul>
      </nav>
      <div class="cta2-image">
      <div class="about-text">
        <div class="text-content">
          <h1>About</h1>
        </div>
      </div>
      </div>

      <div class="content">
        <img src="../images/about.jpg" alt="Image of a people with ropes" />
        <div class="content-text">
          <h3>Our Story</h3>

          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat
            aspernatur, ducimus quod reiciendis modi cum ipsam, sit, fugiat sed
            suscipit molestias accusamus animi natus reprehenderit.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
          </p>
        </div>
      </div>

      <footer>
        <div class="footer-container">
          <div class="column contact">
            <h4>Contact</h4>
            <a href="contact.php">Contact Form</a>
          </div>
          <div class="column svg">
            <h4>Follow Us</h4>
            <div class="social">
              <div class="facebook">
                <img
                  src="../images/facebook.svg"
                  class="logo"
                  alt="Facebook Logo"
                />
              </div>
              <div class="youtube">
                <img src="../images/youtube.svg" class="logo" alt="Youtube Logo" />
              </div>
              <div class="instagram">
                <img
                  src="../images/instagram.svg"
                  class="logo"
                  alt="Instagram Logo"
                />
              </div>
            </div>
          </div>
          <div class="column access">
            <h4>Staff</h4>
            <a href="login.php">Staff Login</a>
          </div>
        </div>
        <div class="copyright">
          <p>&copy;2022 GymHero</p>
        </div>
      </footer>
    </div>
  </body>
</html>
