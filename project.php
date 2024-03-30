<!DOCTYPE html>
<html lang="en">
<?php require 'intelling_db.php'; ?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Project</title>
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
          <li><a class="nav-link scrollto active" href="projects.php">Project</a></li>
          <li class="dropdown"><a class="" href="#portfolio"><span>Members</span> <i class="bi bi-chevron-down"></i></a>
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
          <li>Project</li>
        </ol>
        <!-- <h2>Project information</h2> -->
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-8">
          <?php
						if(isset($_GET['name'])){
							if($project != false){
								foreach($project as $pro){
								$id = $pro['id']; 
									if($_GET['name'] == $id)
									{
          ?>
                    <div class="text-content">
										<div class="t-content" >
											<p style="line-height: 26px;"><?= $pro['Contents']?></p>
											</div> <br>
                      <div class="row d-flex align-items-stretch">
                          <?php                  
                          if($search = "SELECT * FROM video LIMIT 3;"){
                            $searchs = mysqli_query($connect, $search);
                            if(!empty($searchs)){
                              foreach($searchs as $row){
                                $name = $row['video_name'];
                                $videoFileType = pathinfo($name, PATHINFO_EXTENSION);
                                if($videoFileType == "mp4" or $videoFileType == "mov" or $videoFileType == "mpeg" or $videoFileType == "avi"){
                              echo '<div class="col-lg-6 faq-item">';
                              echo '<video  autoplay="autoplay" muted="muted" width="100%;" height="350;"  controls>';
                              echo '<source src="admin/Video_Image/'.$row['video_name'].'" type="video/mp4">';
                              echo "Sorry , your browser doesn't support embedded videos.";
                              echo '</video>';
                              echo '</div>';
                                ?>
                          <?php }?>
                          <?php }?>
                          <?php }?>
                          <?php }?>
                        </div>
									</div>
					<?php }?>
					<?php }?>
					<?php }?>
					<?php }?>
					<?php
					 	if(isset($_GET['id'])){
							 if($newss !=false){
								 foreach($newss as $new){
									 $news_id = $new['id'];
									 if($_GET['id'] == $news_id){
										 echo '<img style="width:100%; height:500px;" src="../admin/news_image/'.$new['new_image'].'">';?>
									<div class="text-content">
										<div class="title row colmn-6">
											<h4><b><?= $new['title']?></b></h4>
										</div>
										<div class="t-content">
										<p><?= $new['text']?></p>
										</div>
									</div>
							<?php }?>
						 	<?php }?>
						 	<?php }?>
						 	<?php }?>
          </div>
          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>프로젝트 정보</h3>
              <ul>
              <?php if($_GET['name'] == $id)
              {
              ?>
                <li><strong>제목</strong>: <?= $pro['project_name']?></li>
                <li><strong>등록일</strong>: <?= $pro['data_time']?></li>
                <?php }?>
              </ul>
            </div>
            <div class="portfolio-description">
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
