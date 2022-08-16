<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
    //showMem();
    if($_SESSION['authUser'] == NULL){
      $username = $_POST['username'];
      $pwd = $_POST['pwd'];
    } else {
      $x = explode(",",$_SESSION['authUser']);
      $username = $x[0];
      $pwd = $x[1];
    }
    
    $accountType = validateUser($dbConnect,$username,$pwd);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GymHero Dashboard</title>
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
            showMem();
                $routineid = $_POST['routineid'];
                $workout = $_POST['workout'];
                $equip = $_POST['equipment'];
                $sets = $_POST['sets'];
                $reps = $_POST['reps'];
                $min = $_POST['min'];
                $addedid = addWorkouts($dbConnect,$workout,$equip,$sets,$reps,$min);
                addWorkoutsToRoutine($dbConnect,$routineid,$addedid);
            ?>
           </div>
       </div>
    </div>
    <script>
        function bounce(){
            window.location.href="dashboard.php";
        }
    </script>
  </body>
</html>
