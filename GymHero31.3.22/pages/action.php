<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
  // showMem();
  $action = $_POST['action'];

  if($action == 'add'){
      $details = $_POST['details'];
      $inputtype = $_POST['inputtype'];  
      $pwd = $details;
      if($inputtype =="class"){
         insertClass($dbConnect,$details);
      }else {
          $output = insertUser($dbConnect,$username,$pwd,$fname,$lname,$email,$atype);
      }
  } else if($action == 'link'){
      $classid = $_POST['class'];

      if($_POST['staff'] != NULL){
          $stid = $_POST['staff'];
          insertStaff($dbConnect,$stid,$classid);
      } else {
          $stid = $_POST['member'];
          insertMember($dbConnect,$stid,$classid);
      }
  }
            /*$memberid = $_POST['member'];
            $classid = $_POST['class'];
            insertMember($dbConnect,$memberid,$classid);*/

           /* $staffid = $_POST['staff'];
            $classid = $_POST['class'];
            insertStaff($dbConnect,$staffid,$classid);*/
           
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="bounce()">
    <script>
        function bounce(){
            window.location.href = "dashboard.php";
        }
    </script>
</body>
</html>