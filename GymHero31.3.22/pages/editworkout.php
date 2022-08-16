<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
    //showMem();
    
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
  <body onload = "bounce1()">
    <div class="wrapper">
      <div class="logo">
        <a href="../index.php"><img src="../images/logo.png" class="logo" alt="GymHero Logo" /></a>
        <h6>Gym Hero</h6>
      </div>
    
      <div class="dashboard-cta">
           <div class="dashboard-content">
            <?php
                echo '<h1>'.$_GET['name'].'</h1>';
                $routineid = $_GET['id'];
                echo '<table>';
                echo '
                <tr>
                <th>Exercise</th>
                <th>Equipment</th>
                <th>Sets</th>
                <th>Reps</th>
                <th>Min</th>
                <th>Remove</th>
                
                </tr>';
               listworkoutsforRoutines1($dbConnect,$routineid);
               echo '</table>';
               echo '<br>';
            ?>
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
