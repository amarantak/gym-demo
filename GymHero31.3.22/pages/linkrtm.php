<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
    //showMem();
    $sid = $_POST['staff'];
    $mid = $_POST['member'];
    $rid = $_POST['routine'];
    addrtm($dbConnect,$sid,$mid,$rid);

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