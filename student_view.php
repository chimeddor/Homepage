<!DOCTYPE html>
<html lang="en">
<?php require 'intelling_db.php';?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
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

  <!-- =======================================================
  * Template Name: Vlava - v4.3.0
  * Template URL: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body oncontextmenu="return false">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
      <h3><a style="color:white;" href="index.php">Intelligent Things Lab</a></h3>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="projects.php">Projects</a></li>
          <li class="dropdown"><a class="active" href="#portfolio"><span>Members</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="students.php">Students</a></li>
            <li><a href="alumni.php">Alumni</a></li>
          </ul>
        </li>
        <li><a class="nav-link scrollto" href="professor.php">Professor</a></li>
          <!-- <li><a class="nav-link scrollto" href="#pricing">News</a></li> -->
          <li><a class="nav-link scrollto" href="startmin/pages/index.php">login</a></li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Student</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 fixed"  >
            <div class="portfolio-details-slider swiper-container" >
              <div class="swiper-wrapper align-items-center">
              <?php
             if(isset($_GET['id'])){
                if($member != false){
                    foreach($member as $new){
                        $news_id = $new['id'];
                        if($_GET['id'] == $news_id){
                          echo '<div class="swiper-slide">';
                          echo '<img class="img" src="admin/student_img/'.$new['image_name'].'">';
                          echo '</div>';
                            ?>
                                <?php }?>
                           <?php }?>
                       <?php }?>
                  <?php }?>
                </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="portfolio-info">
              <?php
                 if(isset($_GET['id'])){
                     if($member != false){
                       foreach($member as $new){
                        $news_id = $new['id'];
                        if($_GET['id'] == $news_id){
                        ?>
                         <h3><?= $new['name']?></h3>
                        <div class="t-content" style="text-align:left;">
                        <ul><?= $new['topic']?></ul>
                        </div>
            <?php }?>
            <?php }?>
            <?php }?>
			<?php }?>
            </div>
     
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row  justify-content-center">
          <div class="col-lg-6">
            <h3>Intelligent Things Lab</h3>
            <p>건국대학교 사물지능(Intelligent Things) 연구실 방문을 환영합니다.</p>
          </div>
        </div>

        <div class="social-links">
          <a href="https://www.konkuk.ac.kr">건국대학교</a> |
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