<?php
  ob_start();
  $_PERINTAH = shell_exec('ipconfig /all');
  ob_clean();
  session_start();
  if( isset( $_SESSION[ 'username' ] ) ) {
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
</style>
</head>

  <?php
    if(isset($_POST['deletes'])){
      $id = $_POST['deletes'];
      $delete = mysqli_query($connect,"DELETE FROM projects WHERE id = '".$id."' ");


    }
  ?>
<body ng-controller="demoController as vm">
    

  <nav class="navbar navbar-inverse navbar-fixed-top ">
    <div class="container" >
    <div class="navbar-header">
      <a class="navbar-brand" style="color: white;">관리자</a>
    </div>
    <ul class="nav navbar-nav">
    <li class=""><a  class="nav-item nav-link" href="admin.php">PROFESSOR</a></li>
      <li><a  class="nav-item nav-link" href="projects.php">PROJECTS</a></li>
      <li><a  class="nav-item nav-link"href="student.php">STUDENTS</a></li>
      <li><a class="nav-item nav-link" href="news.php">NEWS</a></li>
      <li><a class="nav-item nav-link" href="research.php">RESEARCH</a></li>
      <li><a href="introduce_insert.php">INTRODUCTION</a></li>

      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
    </ul>
    </div>
  </nav>

  <div class="container">
  <?php
    if(!isset($_SESSION['username'])){
      header('Location: login.php');
    }
    ?>
  <?php
  if(isset($_POST['upload'])){
    $projectname = $_POST['proname'];
    $little = $_POST['introduction'];
    $cont = $_POST['con'];
    $target = "project_img/".basename($_FILES['image']['name']);
    $file = $_FILES['image']['name'];
  
      $insert = mysqli_query($connect,"INSERT INTO projects(project_name,a_little_introduction,Contents,project_image) VALUES('".$projectname."','".$little."','".$cont."','$file')");
      if($insert){
        echo "query working";
      }else{
        echo "not working";
      }
      if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
        echo "<script>alert('successfully.')</script>";

      }else{
        echo "<script>alert('error.')</script>";
    }
    }
  
  ?>

    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">

      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" style="border-bottom: none;" data-as-sortable-item>        
        <div id="collapse{{$index}}" class="panel-collapse collapse in">
            
          <!-- <div class="panel-body"> -->
          <br>
          <button class="btn btn-primary" id="insert" style="display: block;" onclick="window.location.href='projects.php'" ngf-max-height="1000" ngf-max-size="5MB">
          Upload Project</button>
            <br>
            <br>
            <form method="post" action="projects.php">
            <table class="table table-bordered" id="tablepagination">
             <tbody>
            <?php 
            if($project != false){
              foreach($project as $res){
                $id = $res['id'];
                $name = $res['project_name'];
            ?>
                <tr>
                    <td class="text-center uname">Project Name</td>
                    <td><textarea name="academic2" id="1" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8" disabled><?= $res['project_name']?></textarea></td>
                   <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                <td class="text-center email">Little Introduction</td>
                    <td><textarea name="career2" id="1"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="100" rows="7" disabled><?= $res['a_little_introduction']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox"id="flexCheckDefault"/></td> -->
                  </tr>
                <tr>
                <td class="text-center phone">Conent</td>
                    <td><textarea name="Jpaper2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="100" rows="7" disabled><?= $res['Contents']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""  name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>

                <tr>
                    <td class="text-center phone">Image</td>
                    <td><!-- 파일등록 -->
                <div class="selectCover" style="float:center;">
                <?php echo '<a href="../more_project/projects.php"><img style="width:200px;" class="rounded-circle" data-bs-hover-animate="pulse" src="project_img/'.$res['project_image'].'"></a>' ?>
              
              </div></td>
                </tr>
                <tr>
                <td colspan="2" class="text-center"> 

                <div>  
                <button class="btn btn-primary" onClick="refresh" id="deletes" name="deletes" value="<?= $res['id']?>" style="width: 120px;" >Delete</button>
                <button class="btn btn-primary" onClick="refresh" id="update" name="update" value="<?= $res['id']?>" style="width:120px;background-color:#F5F5F5; border:none;"><?php echo '<a href="project_update.php?projectid='.$id.'">Edite</a>'?></button>
              </div>
              </td>

              </tr>
                <?php }?>
                <?php }?>
                </tbody>
            </table>
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
      jQuery('#insert').css('display', 'block' );
      jQuery('#tablepagination').css('display','block');
    }});
  jQuery('#insert').click(function (){
    if($('#table1').css('display') == 'none'){
      jQuery('#tablepagination').css('display','none');
      jQuery('#table1').css('display', 'block');
      jQuery('#view').css('display', 'block');
      jQuery('#insert').css('display', 'none');
    }});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="paginathing.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($){
    jQuery('#tablepagination tbody').paginathing({
      perPage: 5,
      insertAfter: '#tablepagination',
      pageNumbers: true
    });    
  });
</script>

</body>

</html>