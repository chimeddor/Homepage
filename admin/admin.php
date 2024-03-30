<?php
  ob_start();
  $_PERINTAH = shell_exec('ipconfig /all');
  ob_clean();
  session_start();
  if( isset( $_SESSION[ 'name' ] ) ) {
    $jb_login = TRUE;
  }
  ?>
<?php require '../intelling_db.php'?>
<html lang="en" ng-app="demo">
<head>
  <meta charset="UTF-8" />
  <title>admin</title>
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0/angular.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/12.0.4/ng-file-upload-all.min.js"></script>
  <script src="https://cdn.rawgit.com/a5hik/ng-sortable/master/dist/ng-sortable.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0/angular-animate.min.js"></script>
  
  <!-- header media menu -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">




<style>
   .uname,.phone,.email{
       background-color: #F5F5F5;
       
   }
   /*라벨은 원하는대로 커스텀하고*/
   .btn-outline-secondary{
       background-color: #F5F5F5;
   }


.fileRegiBtn label {

display: inline-block; 

padding: .5em .75em; 

color: #ffffff; 

font-size: inherit; 

line-height: normal; 

vertical-align: middle; 

background-color: #FC7D01; 

cursor: pointer; 

border: 1px solid #ebebeb; 

border-bottom-color: #e2e2e2; 

border-radius: .25em;

}


/*파일선택시 선택된 파일명이 붙는것을 가려준다*/

.fileRegiBtn input[type="file"]{

position: absolute; 

width: 1px; 

height: 1px; 

padding: 0; 

margin: -1px; 

overflow: hidden; 

clip:rect(0,0,0,0); 

border: 0;

}
.thead{
  width: 100px;
}
#table-list{
  width: 100%;

}
div .glyphicon{
  display: none;
}
.glyphicon{
  color: white;
  float: right;
}


@media (max-width:600px) {
  div .glyphicon{
    display: block; 
  }
  ul, li{
    display: none;
    text-align: center; 
    
  }
  #lo{
    display: none;
  }


}
</style>
</head>

<body ng-controller="demoController as vm">
<nav class="navbar navbar-inverse navbar-fixed-top ">
    <div class="container" >
    <div class="navbar-header">
      <a class="navbar-brand" style="color: white;">관리자</a>
      <a href="" id="menu" onclick="Myfunction(this)" class="navbar-brand glyphicon glyphicon-align-justify"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a  class="nav-item nav-link" href="admin.php">PROFESSOR</a></li>
      <li><a  class="nav-item nav-link" href="projects.php">PROJECTS</a></li>
      <li><a  class="nav-item nav-link"href="student.php">STUDENTS</a></li>
      <li><a class="nav-item nav-link" href="news.php">NEWS</a></li>
      <li><a class="nav-item nav-link" href="Editor.php">Editor</a></li>

      <li><a class="nav-item nav-link" href="research.php">RESEARCH</a></li>
      <li><a href="introduce_insert.php">INTRODUCTION</a></li>
      <li><a  href="ImageVideo.php">VIDEO</a></li>


      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a  href="logout.php"><span id="lo"  class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
      
    </ul>
    <script>
     $('#menu').on('click', function(){
    $('ul, li').css("display", "block");
});

    </script>
    </div>
  </nav>
    <?php
    if(!isset($_SESSION['username'])){
      header('Location: login.php');
    }
    ?>

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
    // $file = $_POST['file'];

      $insert = mysqli_query($connect,"INSERT INTO `professor`(`name`,`greeting`,`present_mist`,`phone`,`email`,`academic`,`career`,`FJP`,`FCP`,`patent`,`PPP`,`SAA`,`CA`,`major_lecture`,`award_performance`) VALUES('','','','','', '".$academic."','".$career."','".$Jpaper."','".$Cp."','".$patent."','".$project."','".$activities."','".$activity."','".$mlecture."','".$awards."')");
      if(!$insert)
    {
        echo "error";
    }
    else{
        echo "<script>alert('successfully.')</script>";
    }
    }
  ?>

  <?php
    if(isset($_POST['deletes'])){
      $id = $_POST['deletes'];
      // $academic2 = $_GET['academic2'];
      // $career2 = $_GET['career2'];
      // $Jpaper2 = $_GET['Jpaper2'];
      // $Cp2 = $_GET['Cp2'];
      // $patent2 = $_GET['patent2'];
      // $project2 = $_GET['project2'];
      // $mlecture2 = $_GET['mlecture2'];
      // $activities2 = $_GET['activities2'];
      // $activity2 = $_GET['activity2'];
      // $awards2 = $_GET['awards2'];
      // $file2 = $_GET['file2'];
      $delete = mysqli_query($connect,"DELETE FROM professor WHERE id = '".$id."' ");

    }
  ?>


  <div class="container">
  <table class="table table-bordered">
    <tbody>
    <?php
    $sql = ("SELECT *FROM professor WHERE id = 1");
    $sqls = mysqli_query($connect, $sql);
    if($sqls != false){
       while($row = mysqli_fetch_array($sqls)){
   ?>
      <tr>
        <td class="text-center uname">Name</td>
        <td><input type="text" class="form-control" id="disabledInput" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['name'];?>" disabled></td>
      </tr>
      <tr>
      <td class="text-center email">Email</td>
        <td>  <input type="text" class="form-control" id="disabledInput" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['email']?>" disabled></td>
    </tr>
      <tr>
      <td class="text-center phone">Phone</td>
      <td>  <input type="text" class="form-control" id="disabledInput" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['phone']?>" disabled></td
      </tr>
      <tr>
      <td class="text-center phone">mist</td>
      <td>  <input type="text" class="form-control" id="disabledInput" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['present_mist']?>" disabled></td
      </tr>
      <?php }?>
  <?php }?>
    </tbody>
  </table>
    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">

      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" style="border-bottom: none;" data-as-sortable-item>        
        <div id="collapse{{$index}}" class="panel-collapse collapse in">
            
          <div class="">
          <br>
          <div class="btn-group" role="group" aria-label="Basic example">
          <button class="btn btn-primary" id="view" onclick="window.location.href ='admin_view.php'" style="display: block; width:120px;" ngf-max-height="1000" ngf-max-size="5MB">
                    My Info</button>
            </div>
            <br>
            <br>

            <form action="admin.php" method="post">
            <table class="table table-bordered table-sm" id="table1"style="display: block;">
                <tbody id="tablebody1">
                <tr>
                    <td class="text-center uname">Academic</td>
                    <td><textarea name="academic" id="" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center email">Career</td>
                    <td><textarea name="career" id=""  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center phone">Journal Papers</td>
                    <td><textarea name="Jpaper"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center phone">Conference Papers</td>
                    <td><textarea name="Cp" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm"  id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                    <td class="text-center uname">Patent</td>
                    <td><textarea name="patent"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center email">Projects</td>
                    <td><textarea name="project"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                
                <tr>
                <td class="text-center phone">Major Lecture</td>
                <td><textarea name="mlecture"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center phone">Activities</td>
                <td><textarea name="activities" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center phone">Activity</td>
                <td><textarea name="activity" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center phone">Awards</td>
                <td><textarea name="awards" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="140" rows="1.8"></textarea></td>
                </tr>
                <!-- <tr>
                    <td class="text-center phone">Image</td>
                    <td>

                                <div class="form-group" style="margin: 8px 0 8px;">
                                <label for="myFileUp" class="btn btn-outline-secondary">Upload Image</label>
                                <input id="fileName" class="form-control" name="file"  value="불필수" disabled="disabled" style="width:45%; display: inline;">
                                        <div class="fileRegiBtn">
                                        <input type="file" name="file"  id="myFileUp">
                                </div>
                                </div>
                     
                <div class="selectCover" style="padding-left: 0;">
 	            <img id="cover" src="/cobook/resources/img/defaultImg.jpg" style="width: 182px; height: 268px;"/>
                </div></td>
                </tr> -->
                <tr><td class="text-center" colspan="2"> <input type="submit" style="width: 120px;" name="upload" id="upload" class="btn btn-primary" value="upload"></td></tr>
                </tbody>
            </table>
            
            <!-- ======================================================================================================================= -->
            <div class="col-sm-30 col-sm-offset-0">
          
	  
        <!-- <button class="btn btn-info" id="add"><span class="glyphicon glyphicon-plus-sign"></span>Add New Members</button> -->
            </div>
               
            </form>
          
          </div>

        </div>
      </div>
     
    </div>
   
  </div>
<script>
    
function readURL(input) {

console.log("버튼클릭함1");
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
        $('#cover').attr('src', e.target.result);        //cover src로 붙여지고
        $('#fileName').val(input.files[0].name);    //파일선택 form으로 파일명이 들어온다
    }
  reader.readAsDataURL(input.files[0]);
}
}
$("#myFileUp").change(function(){
readURL(this);
console.log("이미지 바뀜?");

});
</script>


<script>

  jQuery('#view').click(function (){
    if($('#table1').css('display') == 'block'){
      jQuery('#table1').css('display', 'none');
      jQuery('#view').css('display', 'none');
      jQuery('#upd').css('display', 'block');
      jQuery('#insert').css('display', 'block' );
      jQuery('#tablepagination').css('display','block');
    }});
  jQuery('#insert').click(function (){
    if($('#table1').css('display') == 'none'){
      jQuery('#tablepagination').css('display','none');
      jQuery('#table1').css('display', 'block');
      jQuery('#upd').css('display', 'none');
      jQuery('#view').css('display', 'block');
      jQuery('#insert').css('display', 'none');
    }});
</script>
<script>
//   var $delete = $('#1').css('display','none'),
//   $cbs = $('input[id="flexCheckDefault"]').click(function(){
//     $delete.toggle($cbs.is(":checked"));
//   });
//   var $delete2 = $('#1').css('display','block'),
//   $cbss = $('input[id="checkAll"]').click(function(){
//     $delete2.toggle($cbss.is(":checked"));
//   });
//   $("#checkAll").click(function(){
//     $('input:checkbox').not(this).prop('checked', this.checked);
// });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="paginathing.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($){
    jQuery('#tablepagination #tablebody2').paginathing({
      perPage: 11,
      insertAfter: '#tablepagination',
      pageNumbers: true
    });    
  });

</script>
<script>
    jQuery(document).ready(function($){
    jQuery('#tableUpdate #tablebody3').paginathing({
      perPage: 11,
      insertAfter: '#tableUpdate',
      pageNumbers: true
    });    
  });
</script>
</body>

</html>