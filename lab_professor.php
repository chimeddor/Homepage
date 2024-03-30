<!DOCTYPE html>
<html lang="en">
<?php require 'intelling_db.php';?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Intelling Things Lab</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<style>

  
</style>

</head>


<body oncontextmenu="return false">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h3><a href="index.html">Intelligent Things Lab.</a></h3>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="#services">Projects</a></li>
          <li class="dropdown"><a class="active" href="#portfolio"><span>Members</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Professor</a></li>
              <li><a href="#team">Students</a></li>
              <li><a href="#">Alumni</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#pricing">News</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>home / members / Professor</h1>
      
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-4">
          <?php                  
                if($search = "SELECT present_mist,phone ,name, profile_image ,lower(email) FROM professor WHERE `id` = 1"){
                  $searchs = mysqli_query($connect, $search);
                  while($row = mysqli_fetch_array($searchs)){

                    echo'<img class="professor_img" style="height:450px; width:100%; margin-bottom:10px; " align="left"  src="data:image/jpeg;base64,'.base64_encode($row['profile_image']).'" alt="Generic placeholder image">';
                    ?>
                    <div class="content-column">
                      <div class="team-details-content">
                        <div class="top-content">

                          <div class="title" > <?= $row['name']?> </div>
                          <br>
                          <span style="color:#760023; margin-bottom: 3px;  font-family: 'Noto Sans KR', sans-serif;">Professor</span>
                          <br>            
                          <div class="text" style="margin-top:5px;"><?= $row['present_mist']?></div>
                        </div>
                        <br><br>
                        <div class="lower-content">
                          <div class="text" >
                              <b>Tel:</b>
                              <a class="phone" href="tel:<?= $row['phone']?>"><?= $row['phone']?></a>
                              <br>
                              <b>E-mail:</b><a class="email" href="mailto:<?= $row['email']?>"> <?= $row['lower(email)']?></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php }?>
                <?php }?>
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0">

          <ul class="nav nav-tabs" id="black">
                <!-- Tab 아이템이다. 태그는 li과 li > a이다. li태그에 active는 현재 선택되어 있는 탭 메뉴이다. -->
                <!-- <li class="active"><a href="#home" data-toggle="tab">인사</a></li> -->
                <!-- a 태그의 href는 아래의 tab-content 영역의 id를 설정하고 data-toggle 속성을 tab으로 설정한다. -->
                <li><a href="#career" data-toggle="tab">Academic | Career</a></li>
                <li class="active"><a href="#journal" data-toggle="tab">Papers</a></li>
                <li><a href="#patent" data-toggle="tab">Patents</a></li>
                <li><a href="#project" data-toggle="tab">Projects</a></li>
                <li><a href="#society" data-toggle="tab">Activities</a></li>
                <li><a href="#major" data-toggle="tab">Major Lectures</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade" id="career">

                  <div class="AcdeCarer">
                 <div class="col-lg-6 col-md-6 " >
                  <br>
                  <h4 class="education-title">Academic</h4>
                  <?php
                  if ($result != false) {
                    foreach ($result as $key => $value1) {
                      ?>
                      <ul  class="" style="color:black; padding:1px;"><?php echo $value1['academic']?></ul>
                    <?php }?>
                  <?php }?>
                </div>
                <div class="col-lg-6 col-md-6">
                  <br>
                  <h4 class="education-title">Career</h4>
                  <?php
                  if ($result != false) {
                    foreach ($result as $key => $value2) {                       
                      ?>
                      <ul class="" style="color:black; padding:1px;"><?= $value2['career']?></ul>
                    <?php }?>
                  <?php }?>
                </div>
                <hr style="height: 0.5px; background-color:silver; width:100%;">                        
                </div>
                <div>
                <h4>Award Performance</h4>
                <?php
                if ($result != false) {
                foreach ($result as $key => $value9) {                       
                  ?>
                  <ul class="" style="color:black; padding:1px;"><?= $value9['award_performance']?></ul>
                <?php }?>
                <?php }?>
                </div>
              </div>

     
          </div>
        </div>

      </div>
    </section><!-- End About Section -->




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row  justify-content-center">
          <div class="col-lg-6">
            <h3>Intelligent Things Lab.</h3>
            <p>건국대학교 사물지능(Intelligent Things) 연구실 방문을 환영합니다.</p>
          </div>
        </div>



        <div class="social-links">
          <a href="https://www.kku.ac.kr/mbshome/mbs/wwwkr/index.do">건국대학교</a> |
          <a href="https://portal.konkuk.ac.kr/Login.aspx">KU Portal</a> |
          <a href="https://library.konkuk.ac.kr/#/">상허기념도서관</a> |
          <a href="http://www.baum.co.kr/14700">건국대학교 신공학관</a>
        </div>

      </div>
    </div>

 
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>