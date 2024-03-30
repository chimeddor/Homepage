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
      <li><a  href="ImageVideo.php">VIDEO</a></li>

      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
    </ul>
    </div>
  </nav>

  <div class="container">
    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">

      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" data-as-sortable-item style="border-bottom: none;">        
        <div id="collapse{{$index}}" class="panel-collapse collapse in">
        <br>   
          <button class="btn btn-primary" id="view" onclick="window.location.href='student_view.php'" style="display: block;" ngf-max-height="1000" ngf-max-size="5MB">
                    View Student Info</button>
          <button class="btn btn-primary" id="insert" style="display: none;" onclick="view" ngf-max-height="1000" ngf-max-size="5MB">
          Upload Student</button>
            <br>
          
            <form action="student.php" enctype="multipart/form-data" method="post">
            <table class="table table-bordered table-sm" id="table1"style="display: block;">
                <tbody>
                <tr>
                    <td class="text-center uname">Name</td>
                    <td><textarea name="name" id="" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8"></textarea></td>
                </tr>
                <tr>
                <td class="text-center email">Email</td>
                    <td><input name="email" id="exampleInputEmail1" aria-describedby="emailHelp"  type="email"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8"></td>
                </tr>
                <tr>
                <td class="text-center phone">Status</td>
                    <td>
                    <select class="form-control" name="status" id="">
                        <option value="">click me</option>
                        <option value="Student">Student</option>
                        <option value="Alumni">Alumni</option>
                    </select>
               
                </td>
                </tr>
                <tr>
                <td class="text-center phone">Degree</td>
                    <td>  
                        <select  cols="100" rows="1.8" class="form-control" name="degree" id="">
                            <option value="" style="color: silver;">click me</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Master">Master</option>
                    </select></td>
                </tr>
           
                <tr>
                <td class="text-center email">Topic</td>
                    <td><textarea name="topic"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="100" rows="1.8"></textarea></td>
                </tr>
              
                <tr>
                    <td class="text-center phone">Image</td>
                    <td><!-- 파일등록 -->

                                <div class="form-group" style="margin: 8px 0 8px;">
                                <label for="myFileUp" class="btn btn-outline-secondary">Upload Image</label>
                                <input id="fileName" class="form-control" name="image"  value="불필수" disabled="disabled" style="width:45%; display: inline;">
                                        <div class="fileRegiBtn">
                                        <input type="file" name="image"  id="myFileUp">
                                </div>
                                </div>
                            <!-- 커버이미지 들어오는 부분 (임시로 이미지를 넣어줬다)-->
                <div class="selectCover" style="padding-left: 0;">
 	            <img id="cover" src="/cobook/resources/img/defaultImg.jpg" name="image" style="width: 182px; height: 268px;"/>
                </div></td>
                </tr>
                <tr><td class="text-center" colspan="2"><input type="submit"  onClick="refresh" name="upload" style="width: 120px;;" id="upload" class="btn btn-primary" value="upload"></td></tr>
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