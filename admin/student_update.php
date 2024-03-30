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
if(isset($_GET['studentid'])){
    $sid = $_GET['studentid'];
    if(isset($_POST['update'])){
        $name = $_POST['names'];
        $email  = $_POST['email'];
        $status = $_POST['status'];
        $degree = $_POST['degree'];
        $topic  = $_POST['topic'];
        $target = "student_img/".basename($_FILES['image']['name']);
        $file = $_FILES['image']['name'];
     
          $student_update = mysqli_query($connect,"UPDATE student SET name = '".$name."',email = '".$email."',status = '".$status."',degree = '".$degree."', image = '$file', topic ='$topic'  WHERE id = '".$sid."'");
    
          if($student_update or move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            echo "<script>alert('Updated!');</script>";

        }else{
            echo "<script>alert('not updated student's info!');</script>";

        }
    }
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

      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" data-as-sortable-item>        
        <div id="collapse{{$index}}" class="panel-collapse collapse in">
            
          <div class="panel-body">

          <div ngf-drop="vm.addFiles($files,doc.files)"  class="drop-box"  ngf-drag-over-class="'dragover'" ngf-multiple="true" ngf-pattern="'image/*,application/pdf'">       
          
            <!-- ======================================================================================================================= -->
            <div class="col-sm-30 col-sm-offset-0">
             </div>
	  
        <!-- <button class="btn btn-info" id="add"><span class="glyphicon glyphicon-plus-sign"></span>Add New Members</button> -->
            </div>
            <br>
            <button class="btn btn-primary" id="view" onclick="window.location.href='student_view.php'" style="display: block;" ngf-max-height="1000" ngf-max-size="5MB">
                    View Student Info</button>
                    <br>
            <form action="" method="POST"  enctype="multipart/form-data">
            <table class="table table-bordered" id="tablepagination" style="display: block;">
             <tbody>
            <?php 
            if(isset($_GET['studentid'])){
            if($member != false){
              foreach($member as $res){
                  $id = $res['id'];
                if($_GET['studentid'] == $id){
            ?>
                <tr>
                    <td class="text-center uname">Name</td>
                    <td><textarea name="names" id="1" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8" ><?= $res['name']?></textarea></td>
                   <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                <td class="text-center email">Email</td>
                    <td><textarea name="email" id="1"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="100" rows="1.8" ><?= $res['email']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox"id="flexCheckDefault"/></td> -->
                  </tr>
                  <tr>
                <td class="text-center phone">Status</td>
                    <td>
                    <select class="form-control" name="status" id="">
                        <option value="<?= $res['status']?>"><?= $res['status']?></option>
                        <option value="no">--------</option>
                        <option value="Student">Student</option>
                        <option value="Alumni">Alumni</option>
                    </select>
                </td>
                </tr>
                <tr>
                <td class="text-center phone">Degree</td>
                    <td>  
                        <select  cols="100" rows="1.8" class="form-control"  name="degree" id="">
                            <option value="<?= $res['degree']?>"><?= $res['degree']?></option>
                        <option value="no">--------</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Master">Master</option>
                    </select></td>
                </tr>
                <tr>
                    <td class="text-center uname">Topic</td>
                    <td><textarea name="topic"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="100" rows="1.8" ><?= $res['topic']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""  name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                    <td class="text-center phone">Image</td>
                    <td><!-- 파일등록 -->                    
                    <div class="form-group" style="margin: 8px 0 8px;">
                                <label for="myFileUp" class="btn btn-outline-secondary">Upload Image</label>
                                <input id="fileName" class="form-control" name="image"  value="<?= $res['image']?>"  disabled="disabled" style="width:45%; display: inline;">
                                        <div class="fileRegiBtn">
                                        <input type="file" name="image" value="<?= $res['image']?>"  id="myFileUp">
                                </div>
                                </div>
                              
                            <!-- 커버이미지 들어오는 부분 (임시로 이미지를 넣어줬다)-->
                <div class="selectCover" style="padding-left: 0;">
                
                <?php echo '<img align="left" alt="Generic placeholder image" src="student_img/'.$res['image'].'" style=" height:300px; margin-bottom:20px;"></input>'?>
                <div style="width: 100%; padding-top:50px; text-align:center;">
                <b style="color:silver;">위 정보를 수정하는 경우 프로파일 사진이 <br>  자동으로 삭제됨에 따라 프사진을
 <br> 업로드 해 주셔야 합니다.</b>
                </div>  
              </div>
                </td>
                </tr>
                <tr>
                <td colspan="2" class="text-center"> 
                  <div>
                  <button class="btn btn-primary"  onClick="refresh" id="update" name="update" value="<?= $res['id']?>" style="width:120px;">Save</button>
                  </div>
                </td>  
              </tr>
                <?php }?>
                <?php }?>
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