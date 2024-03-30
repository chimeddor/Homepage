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
if(isset($_POST['firsttable'])){
    $name = $_POST['names'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $present = $_POST['present'];
    $update1 = mysqli_query($connect,"UPDATE professor SET name ='".$name."', email = '".$email."', phone = '".$phone."', present_mist = '".$present ."' WHERE id = 1");
    if(!$update1){
       echo "<script>alert('not updated')</script>";
    }else{
        echo "<script>alert('updated')</script>";
    }
}
?>
  <?php
  if(isset($_GET['adminid'])){
      $aid = $_GET['adminid'];
  if(isset($_POST['update'])){
    // $name = $_POST['names'];
    // $email = $_POST['email'];
    // $phone = $_POST['phone'];
    // $present = $_POST['present'];
    $academic = $_POST['academic2'];
    $career = $_POST['career2'];
    $Jpaper = $_POST['Jpaper2'];
    $Cp = $_POST['Cp2'];
    $patent = $_POST['patent2'];
    $project = $_POST['project2'];
    $mlecture = $_POST['mlecture2'];
    $activities = $_POST['activities2'];
    $activity = $_POST['activity2'];
    $awards = $_POST['awards2'];
    // $file2 = $_POST['file2'];

    $update = mysqli_query($connect, "UPDATE professor SET academic  = '".$academic."'
    ,career = '".$career."'
    ,FJP = '".$Jpaper."'
    ,FCP = '".$Cp."'
    ,patent = '".$patent."'
    ,PPP = '".$project."'
    ,SAA = '".$activities."'
    ,CA = '".$activity."'
    ,major_lecture = '".$mlecture."'
    ,award_performance = '".$awards."'
        WHERE id = '".$aid."'");
    if(!$update){
        echo "<script>alert('not updated!')</script>";
    }else{
        echo "<script>alert('updated!')</script>";
    }
  }
  }
  
  ?>



  <div class="container">
      <form action="" method="POST">
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
        <td><input type="text" class="form-control" id="disabledInput" name = "names" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['name'];?>"></td>
      </tr>
      <tr>
      <td class="text-center email">Email</td>
        <td>  <input type="text" class="form-control" id="disabledInput" name = "email" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['email']?>" ></td>
    </tr>
      <tr>
      <td class="text-center phone">Phone</td>
      <td>  <input type="text" class="form-control" id="disabledInput" name = "phone" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['phone']?>" ></td
      </tr>
      <tr>
      <td class="text-center phone">mist</td>
      <td>  <input type="text" class="form-control" id="disabledInput" name = "present" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?= $row['present_mist']?>" ></td
      </tr>
      <?php }?>
  <?php }?>
  <tr>
                <td class="text-center" colspan="2"> 
                <button class="btn btn-primary" onClick="refreshPage()"id="firsttable" name="firsttable" value="<?= $res['id']?>" style=" width:120px;">Save</button>
              </td>  
              </tr>
    </tbody>
  </table>
  </form>
    <div class="panel-group" data-as-sortable="vm.documentDragListeners" ng-model="vm.documents">
      <div class="panel panel-default xlist" ng-repeat="doc in vm.documents" style="border-bottom: none;" data-as-sortable-item>        
        <div id="collapse{{$index}}" class="panel-collapse collapse in">
          <!-- <div class="panel-body"> -->
            <form action="" method="POST">
            <table class="table table-bordered" id="tablepagination" style="display: block;">
             <tbody id="tablebody2">
            <?php 
            if(isset($_GET['adminid'])){
            if($result != false){
              foreach($result as $res){
                $upid = $res['id'];
                if($_GET['adminid'] == $upid){
            ?>
                <tr>
                    <td class="text-center uname">Academic</td>
                    <td><textarea name="academic2" id="1" class="form-control"  placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="180" rows="1.8"><?= $res['academic']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center email">Career</td>
                    <td><textarea name="career2" id="1"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" cols="180" rows="1.8"><?= $res['career']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center phone">International Journal</td>
                    <td><textarea name="Jpaper2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="" cols="180" rows="2"><?= $res['FJP']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center phone">Proceedings</td>
                    <td><textarea name="Cp2" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm"  id="1" cols="180" rows="2"><?= $res['FCP']?></textarea></td>
                </tr>

                <tr>
                    <td class="text-center uname">Patent</td>
                    <td><textarea name="patent2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="180" rows="1.8"><?= $res['patent']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center email">Projects</td>
                    <td><textarea name="project2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="180" rows="1.8"><?= $res['PPP']?></textarea></td>
                </tr>
                
                <tr>
                <td class="text-center phone">Activities</td>
                <td><textarea name="activities2"  class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="180" rows="1.8"><?= $res['SAA']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center phone">Activity</td>
                <td><textarea name="activity2" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="180" rows="1.8"><?= $res['CA']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center phone">Major Lecture</td>
                <td><textarea name="mlecture2" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="180" rows="1.8"><?= $res['major_lecture']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center phone">Awards</td>
                <td><textarea name="awards2" class="form-control" placeholder="필수" aria-describedby="inputGroup-sizing-sm" id="1" cols="180" rows="1.8"><?= $res['award_performance']?></textarea></td>
                </tr>

                <tr>
                <td class="text-center" colspan="2"> 
                <button class="btn btn-primary" onClick="refreshPage()"id="update" name="update" value="<?= $res['id']?>" style=" width:120px;">Save</button>
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

  jQuery('#view').click(function (){
    if($('#table1').css('display') == 'block'){
      jQuery('#table1').css('display', 'none');
      jQuery('#view').css('display', 'none');
      jQuery('#upd').css('display', 'block');
      jQuery('#insert').css('display', 'block' );
      jQuery('#upload').css('display', 'none' );
      jQuery('#tablepagination').css('display','block');
    }});
  jQuery('#insert').click(function (){
    if($('#table1').css('display') == 'none'){
      jQuery('#tablepagination').css('display','none');
      jQuery('#table1').css('display', 'block');
      jQuery('#upd').css('display', 'none');
      jQuery('#view').css('display', 'block');
      jQuery('#insert').css('display', 'none');
      jQuery('#upload').css('display', 'block' );
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
<!-- <script type="text/javascript">
  jQuery(document).ready(function($){
    jQuery('#tablepagination #tablebody2').paginathing({
      perPage: 11,
      insertAfter: '#tablepagination',
      pageNumbers: true
    });    
  });

</script> -->
<script>
    jQuery(document).ready(function($){
    jQuery('#tableUpdate #tablebody3').paginathing({
      perPage: 11,
      insertAfter: '#tableUpdate',
      pageNumbers: true
    });    
  });
</script>

<script>
    function refreshPage(){
    window.location.reload();
} 
</script>
</body>

</html>