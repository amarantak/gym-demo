<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $atype = $_POST['inputtype'];
    
  //  echo 'Details: '.$username.' '.$pwd;
    $pwd = crypt($username,$pwd);
  //  echo '<br>Encrypted: '.$pwd;
    //showmem();
    insertUser($dbConnect,$username,$pwd,$fname,$lname,$email,$atype);
   

    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Routine</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto+Condensed:ital,wght@0,300;0,400;1,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body onload = "bounce()">
    <div class="wrapper">
      <div class="logo">
        <a href="../index.php"><img src="../images/logo.png" class="logo" alt="GymHero Logo" /></a>
        <h6>Gym Hero</h6>
      </div>
    
      <div class="dashboard-cta">
           <div class="dashboard-content">
<?php


 ?>

           </div>
       </div>
    </div>
    <script>
        function bounce(){
            window.location.href = "dashboard.php";
        }
    </script>
  </body>
</html>
