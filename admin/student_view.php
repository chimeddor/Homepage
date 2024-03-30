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

<body ng-controller="demoController as vm">
<?php
    if(!isset($_SESSION['username'])){
      header('Location: login.php');
    }
    ?>

  <?php
  if(isset($_POST['upload'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $degree = $_POST['degree'];
    $topic = $_POST['topic'];
    $target = "student_img/".basename($_FILES['image']['name']);
    $file = $_FILES['image']['name'];
    if(strlen($name) == 0 or strlen($email) == 0 or strlen($status) == 0 or strlen($degree) == 0 or strlen($topic) == 0){
      echo "<script>alert('필수 파일을 꼭 입력해 주셔야 합니다!')</script>";
    }else{
      
      $insert = mysqli_query($connect,"INSERT INTO student(name,email,status,degree,image,topic) VALUES('".$name."','".$email."','".$status."','".$degree."','$file','".$topic."')");
      if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
        echo "<script>alert('successfully.')</script>";

      }else{
        echo "<script>alert('error.')</script>";

      }
      
    }
  }
  ?>

  <?php
    if(isset($_POST['deletes'])){
      $id = $_POST['deletes'];
      $delete = mysqli_query($connect,"DELETE FROM student WHERE id = '".$id."' ");

    }
  ?>
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
    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">

      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" style="border-bottom: none;" data-as-sortable-item>        
        <div id="collapse{{$index}}" class="panel-collapse collapse in">
        <br>
          <button class="btn btn-primary" id="insert" onclick="window.location.href='student.php'" ngf-max-height="1000" ngf-max-size="5MB">
          Upload Student</button>
            <br>            <br>
            <form action="student_view.php" method="POST">
            <table class="table table-bordered" id="tablepagination">
             <tbody>
            <?php 
            if($member != false){
              foreach($member as $res){
                  $id = $res['id']
            ?>
                <tr>
                    <td class="text-center uname">Name</td>
                    <td><textarea name="academic2" id="1" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8" disabled><?= $res['name']?></textarea></td>
                   <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                <td class="text-center email">Email</td>
                    <td><textarea name="career2" id="1"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="100" rows="1.8" disabled><?= $res['email']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox"id="flexCheckDefault"/></td> -->
                  </tr>
                <tr>
                <td class="text-center phone">Status</td>
                    <td><textarea name="Jpaper2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="100" rows="2" disabled><?= $res['status']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""  name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                <td class="text-center phone">Degree</td>
                    <td><textarea name="Cp2" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm"  id="1" cols="100" rows="2" disabled><?= $res['degree']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""  name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                    <td class="text-center uname">Topic</td>
                    <td><textarea name="patent2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="100" rows="1.8" disabled><?= $res['topic']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""  name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                    <td class="text-center phone">Image</td>
                    <td><!-- 파일등록 -->
                <div class="selectCover" style="padding-left: 0;">
                <?php echo '<a target="_blank" href="../members/about_member.php?id='.$id.'"><img align="left" alt="Generic placeholder image" src="student_img/'.$res['image'].'" style=" height:300px; margin-bottom:20px;"></a>'?></div></td>
                </tr>
                <tr>
                <td colspan="2" class="text-center"> 
                  <div>
                  <button class="btn btn-primary" onClick="refresh" id="deletes" name="deletes" value="<?= $res['id']?>" style="width:120px;" onclick="view" ngf-max-height="1000" ngf-max-size="5MB">Delete</button>
                  <button class="btn btn-primary" onClick="refresh" id="update" name="update" value="<?= $res['id']?>" style="width:120px;background-color:#F5F5F5; border:none;" onclick="view" ngf-max-height="1000" ngf-max-size="5MB"><?php echo '<a href="student_update.php?studentid='.$id.'">Edite</a>'?></button>
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
      perPage: 7,
      insertAfter: '#tablepagination',
      pageNumbers: true
    });    
  });
</script>
</body>

</html>