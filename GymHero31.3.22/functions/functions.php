<?php
function dbLink(){
    $db_user = 'mri';
    $db_pass = 'password';
    $db_host = 'localhost';
    $db = 'gymhero';

    try{
        $db = new PDO("mysql:host=$db_host;dbname=$db",$db_user,$db_pass);

    } catch (Exception $e){
        echo 'Unable to connect to database:'.$e;
        exit;
    }
    error_reporting(0);
    return $db;
}

function showMem(){
    echo 'Post memory:';
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    echo 'Get Memory:';
    echo '<pre>';
    print_r($_GET);
    echo '</pre>';
    echo 'Session Memory:';
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
}

function validateUser($dbConnect,$username,$pwd){
    $sql = 'SELECT * from users';
    foreach($dbConnect->query($sql) as $row){
        if($username == $row['username']){
            if($pwd == $row['password']){
                $_SESSION['userid']=$row['id'];
                $_SESSION['authUser'] = $username.','.$pwd;
                return $row['atype'];
            }
        }
    }
}


//Insert user more details

function insertUser($dbConnect,$username,$pwd,$fname,$lname,$email,$atype){
   // echo '<br>'.$username.' '.$pwd.' '.$fname.' '.$lname.' '.$email.' '.$atype;
    $sql = "INSERT INTO users (id,username,password,firstname,lastname,email,atype) VALUES (NULL, :un, :pw, :fn, :ln, :em, :aty)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":un",$username);
    $query->bindParam(":pw",$pwd);
    $query->bindParam(":fn",$fname);
    $query->bindParam(":ln",$lname);
    $query->bindParam(":em",$email);
    $query->bindParam(":aty",$atype);
    $result = $query->execute();
}


function insertClass($dbConnect,$details){
    $sql = "INSERT INTO classes (id,classname) VALUES (NULL, :details)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":details",$details);
    $result = $query->execute();
}


function viewData($dbConnect){
    listDetails($dbConnect,'staff');
    listDetails($dbConnect,'member');
    listDetails($dbConnect,'classes');
    echo '<div style="clear:both;"></div>';
  
}


function listDetails($dbConnect,$details){
   if($details == 'classes'){
       $c = "SELECT * from classes";
       echo '<div class="ctaBox">';
       echo '<h3>'.ucfirst($details).'</h3>';
       foreach($dbConnect->query($c) as $row){
           echo $row['classname'].'<br>';
       }
       echo '</div>';
   } else{
       $sql = "SELECT * FROM users";
       echo '<div class="ctaBox">';
       echo '<h3>'.ucfirst($details).'</h3>';
       foreach($dbConnect->query($sql) as $row){
            if($details == $row['atype']){
             echo $row['username'].'<br>';}
       }
       echo '</div>';
    }
}


function userDropDown($dbConnect,$usertype){
    $sql = "SELECT * FROM users";
    foreach($dbConnect->query($sql) as $row){
        if($row['atype'] == $usertype){
            echo '<option value="'.$row['id'].'">'.$row['username'].'</option>';
        }
    }
}

function classDropDown($dbConnect){
    $sql = "SELECT * FROM classes";
    foreach($dbConnect->query($sql) as $row){        
        echo '<option value="'.$row['id'].'">'.$row['classname'].'</option>';
    }
}

function insertStaff($dbConnect,$staffid,$classid){
    $sql = "INSERT INTO stafftoclass(id,staffID,classID) VALUES(NULL, :stid, :cid)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":stid",$staffid);
    $query->bindParam(":cid",$classid);        
    $query->execute();
}

function insertMember($dbConnect,$memberid,$classid){
    $sql = "INSERT INTO membertoclass(id,memberid,classid) VALUES(NULL, :mid, :cid)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":mid",$memberid);
    $query->bindParam(":cid",$classid);        
    $query->execute();
}

function viewClass($dbConnect,$atype){
    if($atype == 'staff'){
        $sql = "SELECT * FROM stafftoclass";
        foreach($dbConnect->query($sql) as $row){   
                               
            echo $name = getName($dbConnect,$row['staffid']);
            echo ' - ';
            echo $class = getClass($dbConnect,$row['classid']);
            //Note- Add the remove class link after you have shown all the data  just have '  -  ' first
            echo ' - <a href="del.php?tbl=stafftoclass&id='.$row['id'].'">Remove</a>';
            echo '<br>';
        }
    } else{
        $sql = "SELECT * FROM membertoclass";
        foreach($dbConnect->query($sql) as $row){                                    
            echo $name = getName($dbConnect,$row['memberid']);
            echo ' - ';
            echo $class = getClass($dbConnect,$row['classid']);
            //Note- Add the remove class link after you have shown all the data just have '  -  ' first
            echo ' - <a href="del.php?tbl=membertoclass&id='.$row['id'].'">Remove</a>';
            echo '<br>';
    }
}
}



function getName($dbConnect,$id){
    $sql = "SELECT * FROM users";
    foreach($dbConnect->query($sql) as $row){ 
        if($row['id'] == $id){
            return $row['username'];
        }
    } 
}
function getClass($dbConnect,$id){
    $sql = "SELECT * FROM classes";
    foreach($dbConnect->query($sql) as $row){ 
        if($row['id'] == $id){
            return $row['classname'];
        }
    } 
}


function viewClassIndividual($dbConnect,$username){
    $sql = "SELECT * from users";
    foreach ($dbConnect->query($sql) as $row){
        if($row['username'] == $username){
            $id = $row['id'];
            $accountType = $row['atype'];
            retrieveClass($dbConnect,$id,$accountType);
        }
      }
}

function retrieveClass($dbConnect,$id,$accountType){
    if($accountType == 'staff'){
        $sql = "SELECT * from stafftoclass";
        foreach ($dbConnect->query($sql) as $row){
            if($id == $row['staffid']){
                $classid = $row['classid'];
                $q = "SELECT * from classes";
                foreach($dbConnect->query($q) as $r){
                    if($classid == $r['id']){
                        echo '<br>'.ucfirst($r['classname']);
                    }
                }
            }
        }
    }else{
        $sql = "SELECT * from membertoclass";
        foreach ($dbConnect->query($sql) as $row){
            if($id == $row['memberid']){
                $classid = $row['classid'];
                $q = "SELECT * from classes";
                foreach($dbConnect->query($q) as $r){
                    if($classid == $r['id']){
                        echo '<br>'.ucfirst($r['classname']);
                    }
                }
            }
        }
    }
}



function viewMembersInClass($dbConnect,$username){
    $sql = "SELECT * from users";
    foreach ($dbConnect->query($sql) as $row){
        if($row['username'] == $username){
            $id = $row['id'];
            //get class
            $sql = "SELECT * from stafftoclass";
            foreach ($dbConnect->query($sql) as $row){
                if($id == $row['staffid']){
                    $classid = $row['classid'];
                    $q = "SELECT * from classes";
                    foreach($dbConnect->query($q) as $r){
                        if($classid == $r['id']){
                            echo '<br>'.ucfirst($r['classname']);
                            //search studenttoclass and find matching student id
                            $sql2 = "SELECT * FROM membertoclass";
                            foreach($dbConnect->query($sql2) as $r2){
                                if($classid == $r2['classid']){
                                    $memberid = $r2['memberid'];
                                    //use student id on users to find usernames
                                    $sql3 = "SELECT * FROM users";
                                    foreach($dbConnect->query($sql3) as $r3){
                                        if($memberid == $r3['id']){
                                            echo '<br>-- '.$r3['username'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

/******************Read Equipment*******************/

function viewEquipment($dbConnect){
    listDetail($dbConnect,'cardio');
    listDetail($dbConnect,'weights & bars');
    listDetail($dbConnect,'conditioning');
    listDetail($dbConnect,'strength machines');
    
}

function listDetail($dbConnect,$details){
    $sql = "SELECT * FROM equipment";
        echo '<div class="ctaBox">';
        echo '<h2>'.ucfirst($details).'</h2>'.'<br>';
        
        foreach($dbConnect->query($sql) as $row){
             if($details == $row['etype']){
              echo $row['name'].'<br>';
              echo '<div class="equip-desc">';
              echo $row['description'].'<br>';
              echo '<br>';
              echo '</div>';

            }
        }
        echo '</div>';
 }


/*******************Timetable/ Read classes and time********************************/
function viewTimetable($dbConnect){
    listDay($dbConnect,'monday');
    listDay($dbConnect,'tuesday');
    listDay($dbConnect,'wednesday');
    listDay($dbConnect,'thursday');
    listDay($dbConnect,'friday');
}

function listDay($dbConnect,$details){
    $sql = "SELECT * FROM timetable";
        echo '<div class="ctaBox">';
        echo '<h3>'.ucfirst($details).'</h3>'.'<br>';
        
        foreach($dbConnect->query($sql) as $row){
             if($details == $row['dayofweek']){
              echo $row['time'].'<br>';
              echo '<hr>';
              echo '<br>';
              echo '<div class="className">';
              echo $row['classname'].'<br>';
              echo '</div>';
              echo '<br>';
            }
        }
        echo '</div>';
 }

/*******************Add Routines********************************/


function addroutine($dbConnect,$tid,$rname){
    $sql = "INSERT INTO routinename (id,trainerid,name) VALUES (NULL, :tid, :rname)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":tid",$tid);
    $query->bindParam(":rname",$rname);
    $result = $query->execute();
}
//showMem();

function listRoutines($dbConnect){
    $sql = "SELECT * FROM routinename";
    foreach($dbConnect->query($sql) as $row) {
      echo $row['name'].' <a href="addworkout.php?id='.$row['id'].'&name='.$row['name'].'">Add workout</a><br>'.' <a href="editworkout.php?id='.$row['id'].'&name='.$row['name'].'">Edit workout</a><br>';
    }
  }
  //showMem();
  function addWorkouts($dbConnect,$workout,$equip,$sets,$reps,$min) {
    $sql = "INSERT INTO workout(id,workouts,equipment,sets,reps,min) VALUE (NULL,:wo,:eq,:se,:re,:mi)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":wo", $workout);
    $query->bindParam(":eq", $equip);
    $query->bindParam(":se", $sets);
    $query->bindParam(":re", $reps);
    $query->bindParam(":mi", $min);
    $query->execute();
    $insertid = $dbConnect->lastInsertId(); 
    return $insertid;
  }

  //showMem();
  function addWorkoutsToRoutine($dbConnect,$routineid,$addedid){
    $sql = "INSERT INTO routineworkouts(id,routineid,workoutid) VALUE (NULL,:rid,:wid)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":rid", $routineid);
    $query->bindParam(":wid", $addedid);
    $query->execute();
  }
  function listworkoutsforRoutines($dbConnect,$rid){
    $sql = "SELECT * FROM routineworkouts";
    foreach($dbConnect->query($sql) as $row) {
      if($row['routineid'] ==  $rid){
        getWorkout($dbConnect,$row['workoutid']);
      }
    }
  }
  function getWorkout($dbConnect,$wkid){
    $sql = "SELECT * FROM workout";
    foreach($dbConnect->query($sql) as $row) {    
      if($row['id'] == $wkid){
       // print_r($row);
        echo '<tr><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td></tr>';
      }
   }
}

  /***************************************************** */
/*Link Routine User */

function routineDropDown($dbConnect){
    $sql = "SELECT * FROM routinename";
    foreach($dbConnect->query($sql) as $row){        
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
}
function linkStaff($dbConnect,$staffid,$routineid){
    $sql = "INSERT INTO stafftoroutine(id,staffID,routineID) VALUES(NULL, :staff, :rid)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":staff",$staffid);
    $query->bindParam(":rid",$routineid);        
    $result = $query->execute();
}
function linkMember($dbConnect,$memberid,$routineid){
    $sql = "INSERT INTO membertoroutine(id,memberID,routineID) VALUES(NULL, :member, :rid)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":member",$memberid);
    $query->bindParam(":rid",$routineid);        
    $result = $query->execute();
}

function viewRoutine($dbConnect,$atype){
    if($atype == 'staff'){
        $sql = "SELECT * FROM routinename";
        foreach($dbConnect->query($sql) as $row){   
                               
            echo $name = getName($dbConnect,$row['staffid']);
            echo ' - ';
            echo $routine = getRoutine($dbConnect,$row['routineid']);
            //Note- Add the remove class link after you have shown all the data  just have '  -  ' first
            echo ' - <a href="del.php?tbl=routinename&id='.$row['id'].'">Remove</a>';

            echo '<br>';
        }
    } else{
        $sql = "SELECT * FROM membertoroutine";
        foreach($dbConnect->query($sql) as $row){                                    
            echo $name = getName($dbConnect,$row['memberid']);
            echo ' - ';
            echo $routine = getRoutine($dbConnect,$row['routineid']);
            //Note- Add the remove class link after you have shown all the data just have '  -  ' first
            echo ' - <a href="del.php?tbl=membertoroutine&id='.$row['id'].'">Remove</a>';
            echo '<br>';
    }
}
}

function getRoutine($dbConnect,$id){
    $sql = "SELECT * FROM routinename";
    foreach($dbConnect->query($sql) as $row){ 
        if($row['id'] == $id){
            return $row['name'];
        }
    } 
}

function addrtm($dbConnect,$sid,$mid,$rid){
    $sql = "INSERT INTO membertoroutine (id,staffid,memberid,routineid) VALUES (NULL, :sid, :mid, :rid)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":sid",$sid);
    $query->bindParam(":mid",$mid);
    $query->bindParam(":rid",$rid);        
    $result = $query->execute();
}

/***************************Members view Routines*******************************8 */
//showMem();

function viewRoutineIndividual($dbConnect,$username){
    $sql = "SELECT * from users";
    foreach ($dbConnect->query($sql) as $row){
        if($row['username'] == $username){
            $id = $row['id'];
            $accountType = $row['atype'];
            //echo $accountType;
            retrieveRoutine($dbConnect,$id,$accountType);
        }
      }
}

function retrieveRoutine($dbConnect,$id,$accountType){
    if($accountType == 'member'){
        $sql = "SELECT * from membertoroutine";
        foreach ($dbConnect->query($sql) as $row){
            if($id == $row['memberid']){
                $routineid = $row['routineid']; 
               // echo $routineid;   
                $q = "SELECT * from workout";
                foreach($dbConnect->query($q) as $r){
                    if($routineid == $r['id']){
                       
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
                    }
                }
            }
        }
    }
}


function listworkoutsforRoutines1($dbConnect,$rid){
    $sql = "SELECT * FROM routineworkouts";
    foreach($dbConnect->query($sql) as $row) {
      if($row['routineid'] ==  $rid){
        getWorkoutRemove($dbConnect,$row['workoutid']);
      }
    }
  }


  function getWorkoutRemove($dbConnect,$wkid){
    $sql = "SELECT * FROM workout";
    foreach($dbConnect->query($sql) as $row) {    
      if($row['id'] == $wkid){
       // print_r($row);
        echo '<tr><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td> 
        <td><a href="del.php?id='.$row['id'].'&tbl=routineworkouts">Remove</a></td></tr>';
      }
   }
}

function editWorkoutsforRoutines($dbConnect,$rid){
    $sql = "SELECT * FROM routineworkouts";
    foreach($dbConnect->query($sql) as $row) {
      if($row['routineid'] ==  $rid){
        grabRoutine($dbConnect,$row['workoutid']);
      }
    }
  }
  
function grabRoutine($dbConnect) {
    $sql = "SELECT * FROM workout";
    foreach ($dbConnect->query($sql) as $row) {
        echo '
        <form action="addworkout.php" method="post">
            <input type="hidden" name="editId" value="'.$row['id'].'">
            <input type="text" name="editWorkouts" value="'.$row['workouts'].'">
            <input type="submit" value="Edit Workout">
        </form>
        <br>';
    }
}
function updateRoutine($dbConnect,$editId,$editWorkouts,$editEquip,$editSets,$editReps,$editMin) {
    $sql = "UPDATE workouts SET workouts = :workouts WHERE id = :id";
    $sql = "UPDATE names SET equipment = :equipment WHERE id = :id";
    $sql = "UPDATE sets SET sets = :sets WHERE id = :id";
    $sql = "UPDATE reps SET reps = :reps WHERE id = :id";
    $sql = "UPDATE min SET min = :min WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindValue(":id", $editId);
    $query->bindValue(":workouts", $editWorkouts);
    $query->bindValue(":equipment", $editEquip);
    $query->bindValue(":sets", $editSets);
    $query->bindValue(":reps", $editReps);
    $query->bindValue(":min", $editMin);
    $query->execute();
}
?>