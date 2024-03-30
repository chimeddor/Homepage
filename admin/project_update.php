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
  <?php
    if(!isset($_SESSION['username'])){
      header('Location: login.php');
    }
    ?>

  <?php
  if(isset($_GET['projectid'])){
      $ids = $_GET['projectid'];
      if(isset($_POST['update'])){
        $proname = $_POST['pname'];
        $littleinto = $_POST['liintroduction'];
        $con = $_POST['con'];
        $target = "project_img/".basename($_FILES['image']['name']);
        $file = $_FILES['image']['name'];
        
        $project_update = mysqli_query($connect, "UPDATE projects SET project_name = '$proname', a_little_introduction = '$littleinto', Contents = '$con',  project_image = '$file',data_time = now() WHERE id = '$ids'");
        if($project_update or $project_update or move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            echo "<script>alert('updated project's info!');</script>";

        }else{
            echo "<script>alert('not updated project's info!');</script>";
        }
      }
  }
  ?>
  <div class="container">

    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">

      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" style="border-bottom: none;" data-as-sortable-item>        
        <div id="" class="panel-collapse collapse in">
            
       
          
          <!-- ======================================================================================================================= -->
          <div class="col-sm-30 col-sm-offset-0">
           </div>
    
      <!-- <button class="btn btn-info" id="add"><span class="glyphicon glyphicon-plus-sign"></span>Add New Members</button> -->
          </div>
          <br>
          <!-- <div class="panel-body"> -->
          <button class="btn btn-primary" id="view" onclick="window.location.href='projects_views.php'" style="display: block;" ngf-max-height="1000" ngf-max-size="5MB">
                    View Porject Info</button>
       
          <br>
            <form action=""  method="post" enctype="multipart/form-data">
            <table class="table table-bordered" id="tablepagination" >
             <tbody>
            <?php 
            if(isset($_GET['projectid'])){
                if($project != false){
                foreach($project as $res){
                    $id = $res['id'];
                    if($_GET['projectid'] == $id){
            ?>
                <tr>
                    <td class="text-center uname">Project Name</td>
                    <td><textarea name="pname"  class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8" ><?= $res['project_name']?></textarea></td>
                   <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                <td class="text-center email">Little Introduction</td>
                    <td><textarea name="liintroduction"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="100" rows="7" ><?= $res['a_little_introduction']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox"id="flexCheckDefault"/></td> -->
                  </tr>
                <tr>
                <td class="text-center phone">Conent</td>
                    <td><textarea name="con"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm"  cols="100" rows="7" ><?= $res['Contents']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""  name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>

                <tr>
                <td class="text-center phone">Image</td>
                    <td><!-- 파일등록 -->                    
                    <div class="form-group" style="margin: 8px 0 8px;">
                                <label for="myFileUp" class="btn btn-outline-secondary">Upload Image</label>
                                <input id="fileName" class="form-control" name="image"  value="불필수" style="width:45%; display: inline;">
                                        <div class="fileRegiBtn">
                                        <input type="file" name="image"  id="myFileUp">
                                </div>
                                </div>
                            <!-- 커버이미지 들어오는 부분 (임시로 이미지를 넣어줬다)-->
                <div class="selectCover" style="padding-left: 0;">
                <?php echo '<img align="left" alt="Generic placeholder image" src="project_img/'.$res['project_image'].'" style=" height:300px; margin-bottom:20px;"></input>'?>
                <div style="width: 100%; padding-top:50px; text-align:center;">
                <b style="color:silver;">위 정보를 수정하는 경우 사진이 <br>  자동으로 삭제됨에 따라 <br> 사진을 업로드 해 주셔야 합니다.</b>
                </div>  
                </div>
                </td>
                </tr>
                <tr>
                <td colspan="2" class="text-center"> 
                <button class="btn btn-primary" onClick="window.location.reload();" name="update" value="<?= $res['id']?>" style="width: 120px;" >Save</button>

            </td> 
                 
              </tr>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php } ?>
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




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="paginathing.js"></script>
<!-- <script type="text/javascript">
  jQuery(document).ready(function($){
    jQuery('#tablepagination tbody').paginathing({
      perPage: 5,
      insertAfter: '#tablepagination',
      pageNumbers: true
    });    
  });
</script> -->
</body>

</html>s