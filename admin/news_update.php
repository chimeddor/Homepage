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
<?php
    if(!isset($_SESSION['username'])){
      header('Location: login.php');
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

  <?php
  if(isset($_GET['newsid'])){
    $id = $_GET['newsid'];  
    if(isset($_POST['update'])){
        $academic =$_POST['titles'];
        $career = $_POST['littles'];
        $Jpaper = $_POST['texted'];
        $target = "news_image/".basename($_FILES['image']['name']);
        $file = $_FILES['image']['name'];

        $news_update = mysqli_query($connect, "UPDATE news SET title = '".$academic."',little_introduction = '".$career."',  text = '".$Jpaper."', datatime = now(), new_image = '$file' WHERE id = '$id'");
        if($news_update or move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            echo "<script>alert('Updated news!')</script>";
    
          }else{
            echo "<script>alert('Not Updated Image!')</script>";
        }

    
      }
  }
  ?>

  <div class="container">
    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">

        <div id="collapse{{$index}}" class="panel-collapse collapse in">
            
          
        <br>
          <button class="btn btn-primary" id="view" onclick="window.location.href='news_view.php'" style="display: block;" ngf-max-height="1000" ngf-max-size="5MB">
                    News info</button>
            <br>      
            <form action="" enctype="multipart/form-data" method="POST">
            <table class="table table-bordered" id="tablepagination" style="display: block;">
             <tbody>
            <?php 
            if(isset($_GET['newsid'])){

            if($newss != false){
              foreach($newss as $res){
                $newid = $res['id'];
                if($_GET['newsid'] == $newid){
            ?>
                <tr>
                    <td class="text-center uname">Title</td>
                    <td><textarea name="titles" id="1" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="200" rows="1.8"><?= $res['title']?></textarea></td>
                   <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox" id="flexCheckDefault"/></td> -->
                </tr>
                <tr>
                <td class="text-center email">Little Introduction</td>
                    <td><textarea name="littles" id="1"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="100" rows="7"><?= $res['little_introduction']?></textarea></td>
                    <!-- <td><input class="form-check-input" type="checkbox" value=""   name="checkbox"id="flexCheckDefault"/></td> -->
                  </tr>
                <tr>
                <td class="text-center phone">Text</td>
                    <td><textarea name="texted"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="100" rows="7"><?= $res['text']?></textarea></td>
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
                <?php echo '<img align="left" alt="Generic placeholder image" src="news_image/'.$res['new_image'].'" style=" height:300px; margin-bottom:20px;"></input>'?>
                <div style="width: 100%; padding-top:50px; text-align:center;">
                <b style="color:silver;">위 정보를 수정하는 경우 사진이 <br>  자동으로 삭제됨에 따라 사진을
 <br> 업로드 해 주셔야 합니다.</b>
                </div>  
                </div>
                </td>
                </tr>
                <tr>
                <td colspan="2" class="text-center">
                  <div>
                   <!-- <button  onclick="getData()" class="btn btn-primary" id="deletes" name="deletes" value="<?= $res['id']?>" style="width: 120px;" >Delete</button> -->
                   <button  class="btn btn-primary" id="upd" name="update" value="<?= $res['id']?>" style="width: 120px;" >Save</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="paginathing.js"></script>

</body>

</html>