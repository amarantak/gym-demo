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
    $pwd = crypt($username,$pwd);
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
  <body>
    <div class="wrapper">
      <div class="logo">
        <a href="../index.php"><img src="../images/logo.png" class="logo" alt="GymHero Logo" /></a>
        <h6>Gym Hero</h6>
      </div>
    
      <div class="dashboard-cta">
           <div class="dashboard-content">
               <?php
               // Admin dashboard
                    if($accountType == 'admin'){
                        echo 'Welcome '.$username.'<br>';
                        echo '
                        <h3>Add Users</h3>
                            <form action="../pages/adduser.php" method="post">
                            <input type="text" name="username" placeholder ="Enter username">
                            <input type="text" name="password" placeholder ="Enter password">
                            <input type="text" name="firstname" placeholder ="Enter first name">
                            <input type="text" name="lastname" placeholder ="Enter last name">
                            <input type="text" name="email" placeholder ="Enter email">

                            <select name="inputtype">
                                <option value="member">Member</option>
                                <option value="staff">Staff</option>
                            </select>
                            <input type="hidden" name="action" value="add">
                            <input type="submit" value="Add Details">
                            </form>';
                            /********************************* */
                            echo'
                            <h3>Classes</h3>
                            <form action="../pages/addclass.php" method="post">
                            <input type="text" name="classname" placeholder ="Enter classname">
                            <input type="hidden" name="action" value="add">
                            <input type="submit" value="Add Class">
                            </form>';

                        viewData($dbConnect);
                        //First to be coded
                        echo '<hr><h3>Link Data</h3>';
                        echo 'Link Staff to class<br>';
                        echo '<form action="../pages/action.php" method="post">
                        <input type="hidden" name="action" value="link">
                        <select name="staff">';
                        userDropDown($dbConnect,'staff');                        
                        echo'</select>                        
                        <select name="class">';
                        classDropDown($dbConnect);
                        echo'<input type="submit" value="Link staff to class">
                        </form>';
                        //second to be coded
                        echo '<br>Link Member to class<br>';
                        echo '<form action="../pages/action.php" method="post">                        
                        <input type="hidden" name="action" value="link">
                        <select name="member">';
                        userDropDown($dbConnect,'member');                        
                        echo'</select>                        
                        <select name="class">';
                        classDropDown($dbConnect);
                        echo'<input type="submit" value="Link member to class">
                        </form>';
                        //After the form, get the action page coded
                        //Code after data is in db
                        echo '<br><hr><h3>View linked data</h3>';
                        echo'<h5>Staff assigned to class</h5>';
                        viewClass($dbConnect,'staff');
                        echo'<br><h5>Member assigned to class</h5>';
                        viewClass($dbConnect,'member');
                        /********************************************* */   
                        // Staff Dashboard                     
                      } else if($accountType == 'staff'){
                        echo '<h3>Welcome Staff</h3> '.$username.'<br>';
                        echo '<br>';
                        echo '<h3>Classes</h3>';
                        echo '<hr>';
                        viewClassIndividual($dbConnect,$username);
                        echo '<br><br><h3>Members in Class</h3>';
                        echo '<hr>';
                        echo '<br>';
                        viewMembersInClass($dbConnect,$username);
                        echo '<br><br>';
                        echo '<h3>Create a Routine</h3>';
                        echo '<hr>';
                        echo '<br>';
                        //showMem();
                        echo '
                        <form method="post" action="addRoutine.php">
                        <input type="hidden" name="trainerid" value="'.$_SESSION['userid'].'">
                        <input type="text" name="routineName" placeholder="Enter Routine Name">
                        <input type="submit" value="Register Routine Name">
                        </form>
                        ';
                        listRoutines($dbConnect);
                        echo '<br>';
                        echo 'Link Routines to members<br>';
                        echo '<hr>';
                        echo '<form action="../pages/linkrtm.php" method="post">
                        <input type="hidden" name="action" value="link">
                        <select name="staff">';
                        userDropDown($dbConnect,'staff');                        
                        echo'</select>  
                        <select name="member">';
                        userDropDown($dbConnect,'member');                        
                        echo'</select>                                             
                        <select name="routine">';
                        routineDropDown($dbConnect);
                        echo'<input type="submit" value="Link member to routine">
                        </form>';

                        echo '<br><hr><h3>Routines Assigned</h3>';
                        echo '<br>';
                        echo'<br><h5>Member assigned to routine</h5>';
                        viewRoutine($dbConnect,'member');
                        echo '<table>';
               
                      // Member dashboard
                    }else if($accountType == 'member'){
                        echo '<h3>Welcome member</h3> '.$username.'<br>';
                        echo '<br>';
                        echo '<h3>Classes</h3>';
                        echo '<hr>';
                        viewClassIndividual($dbConnect,$username).'<br>';
                        echo '<br><br>';
                        echo'<h3>Routines assigned</h3>';
                        echo '<hr>';
                        echo '<br>';
                        viewRoutineIndividual($dbConnect,$username);
                    }else{
                        echo 'Invalid Login';
                    }

                   
               ?>
           </div>
       </div>


    </div>
  </body>
</html>
