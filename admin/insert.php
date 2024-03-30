<html>
    <?php require '../intelling_db.php'?>
    <head></head>
    
<body oncontextmenu="return false">
        
  <?php
  if(isset($_POST['upload'])){
    $academic = $_POST['academic'];
    $career = $_POST['career'];
    $Jpaper = $_POST['Jpaper'];
    $Cp = $_POST['Cp'];
    $patent = $_POST['patent'];
    $project = $_POST['project'];
    $mlecture = $_POST['mlecture'];
    $activities = $_POST['activities'];
    $activity = $_POST['activity'];
    $awards = $_POST['awards'];
    $insert = mysqli_query($connect,"INSERT INTO professor(academic,career,FJP,FCP,patent,PPP,SAA,CA,major_lecture,award_performance) VALUES('".$academic."','".$career."','".$Jpaper."','".$Cp."','".$patent."','".$project."','".$activities."','".$activity."','".$mlecture."','".$awards."')");
    if(!$insert)
    {
        echo "error";
    }
    else{
        echo "success";
    }
  }
  ?>
    </body>
</html>