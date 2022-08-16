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
    <title>Add Workout</title>
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
    
      <div class="dashboard-cta"><hr>
<a href="dashboard.php">[ Dashboard ]</a>

           <div class="dashboard-content">
            <?php
                $routineid = $_GET['id'];
                $routineName = $_GET['name'];
                echo 'Add workout sessions to '.$routineName.'<br>';
                echo '<form method="post" action="awresult.php">
                <input type="hidden" name="routineid" value="'.$routineid.'">
                <input type="text" name="workout" placeholder="Enter workout Name">
                <input type="text" name="equipment" placeholder="Enter equipment">
                <input type="text" name="sets" placeholder="Enter sets">
                <input type="text" name="reps" placeholder="Enter reps">
                <input type="text" name="min" placeholder="Enter min">
                <input type="submit" value="Add">
                </form>
                ';
                echo '<table>';
                echo '
                <tr>
                <th>Exercise</th>
                <th>Equipment</th>
                <th>Sets</th>
                <th>Reps</th>
                <th>Min</th>
                </tr>';
               listworkoutsforRoutines($dbConnect,$routineid);
               echo '</table>';
               //echo '<br>';
                //echo 'Edit Routine '.$routineName.'<br>';
               //editWorkoutsforRoutines($dbConnect,$rid);
               //updateRoutine($dbConnect,$editId,$editWorkouts,$editEquip,$editSets,$editReps,$editMin);
          
            ?>
           </div>
       </div>
    </div>

  </body>
</html>
