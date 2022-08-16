<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $accountType = validateUser($dbConnect,$username,$pwd);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GymHero Contact</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto+Condensed:ital,wght@0,300;0,400;1,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <div class="wrapper">
      <div class="logo">
        <a href="../index.php"><img src="../images/logo.png" class="logo" alt="GymHero Logo" /></a>
        <h6>Gym Hero</h6>
      </div>
    
      <section id="contact">
      <div class="contact-box">
        <div class="contact-links">
          <h2>CONTACT</h2>
          <div class="links">
            <div class="link">
              <a
                ><img
                  src="https://i.postimg.cc/m2mg2Hjm/linkedin.png"
                  alt="linkedin"
              /></a>
            </div>
            <div class="link">
              <a
                ><img
                  src="https://i.postimg.cc/YCV2QBJg/github.png"
                  alt="github"
              /></a>
            </div>
            <div class="link">
              <a
                ><img
                  src="https://i.postimg.cc/W4Znvrry/codepen.png"
                  alt="codepen"
              /></a>
            </div>
            <div class="link">
              <a
                ><img src="https://i.postimg.cc/NjLfyjPB/email.png" alt="email"
              /></a>
            </div>
          </div>
        </div>
        <div class="contact-form-wrapper">
          <form>
            <div class="form-item">
            <input id="name" type="text" name="mytext" tabindex="1" required/>
              <label for="name">Name:</label>
            </div>
            <div class="form-item">
              <input type="text" name="email" required />
              <label>Email:</label>
            </div>
            <div class="form-item">
              <textarea class="" name="message" required></textarea>
              <label>Message:</label>
            </div>
            <button class="submit-btn">Send</button>
          </form>
        </div>
      </div>
    </section>


    </div>
  </body>
</html>
