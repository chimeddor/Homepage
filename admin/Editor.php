<?php
  ob_start();
  $_PERINTAH = shell_exec('ipconfig /all');
  ob_clean();
  session_start();
  if( isset( $_SESSION[ 'name' ] ) ) {
    $jb_login = TRUE;
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $detail = $_POST['contents'];
  }
  ?>


<!DOCTYPE html> 
<html lang="ko"> 
<?php require '../intelling_db.php'?>

    <head> 
        <meta charset="utf-8"/> 
        <title></title> 
        <script type="text/javascript" src="./ckeditor/ckeditor.js">

        </script> <script type="text/javascript"> 
        //<![CDATA[ 
            function LoadPage() { 
                CKEDITOR.replace('contents'); 
            } 
            // function FormSubmit(f) { 
            //     CKEDITOR.instances.contents.updateElement(); 
            //     if(f.contents.value == "") {
            //          alert("내용을 입력해 주세요."); 
            //          return false; 
            //         } 
            //          alert(f.contents.value); 
            //          // 전송은 하지 않습니다. 
            //          return false; } 
            //          //]]> 
            
        </script> 
        </head> 

    <?php
    if(isset($_POST['submit'])){
        $detail = $_POST['contents'];
        $sql = mysqli_query($connect,"INSERT INTO post(`content`) VALUES('".$detail."')");
        if($sql){
            echo "inserted";
        }else{
            echo "not insert";
        }
    }

    
    ?>     
<body onload="LoadPage();">
 <form id="EditorForm" name="EditorForm" method="post" onsubmit="return FormSubmit(this);">
  <div> <label for="title">제목</label> 
  <input type="text" id="title" name="title" size="40" /> 
</div> 
<div> 
    <label for="contents">내용</label>
     <textarea id="contents" name="contents"></textarea> 
    </div> 

    <div><input type="submit" name="submit" value="전송"></div> 


    <?php if(isset($sql)) echo $detail; ?>
</form> 
</body> 
</html>

