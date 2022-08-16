<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
       echo '<!-- Connection established -->'; 
    } 
    //showMem();

    $table = $_GET['tbl'];
    $uid = $_GET['id'];

    $sql = "DELETE from $table WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindParam(':id',$uid);   
    $stmt->execute();    
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
            window.location.href="../index.php";
        }
    </script>
</body>
</html>