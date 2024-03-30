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
</head>
<body oncontextmenu="return false">
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">
        <h3><a style="color:white;" href="index.php">Intelligent Things Lab</a></h3>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="projects.php">Projects</a></li>
          <li class="dropdown"><a href="#portfolio"><span>Members</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="students.php">Students</a></li>
            <li><a href="alumni.php">Alumni</a></li>
          </ul>
        </li>
        <li><a class="nav-link scrollto" href="professor.php">Professor</a></li>
        <li><a class="nav-link scrollto" href="startmin/pages/index.php">login</a></li>
          <!-- <li><a class="nav-link scrollto" href="#pricing">News</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <!-- <h1>Intelligent Things Lab</h1> -->
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="row content">
          <div class="col-lg-6">
            <h2>사물지능연구실</h2>
            <h3>건국대학교 사물지능(Intelligent Things) 연구실 방문을 환영합니다.</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
          <?php 
              if($introduc !=false){
                foreach($introduc as $intro){
                ?>  
             <p>
                  <?= $intro['intro1']?>
                  <br><br>
            </p>
            <h3>주요 연구분야</h3>
            <ul>
              <li><i class="ri-check-double-line"></i>온디바이스(On-Device) 인텔리전스 </li>
              <li><i class="ri-check-double-line"></i>딥 러닝(Graph Neural Network, Federated Learning 등)</li>
              <li><i class="ri-check-double-line"></i>인공지능 클라우드 플랫폼</li>
              <li><i class="ri-check-double-line"></i>인공지능 클라우드 기반의 다중 챗봇 서비스</li>
              <li><i class="ri-check-double-line"></i>임베디드 리눅스 및 소형 실시간 운영체제(RTOS)</li>
            </ul>
            <?php }?>
                <?php }?>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">
        <br>
        <div class="section-title">
          <h2>Project Videos</h2>
        </div>
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
    </section><!-- End Services Section -->
    <!-- ======= Featured Section ======= -->
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title">
          <h2>Members</h2>
          <p>건국대학교 사물지능(Intelligent Things) 연구실 방문을 환영합니다.</p>
        </div>
        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">모두</li>
              <li data-filter=".filter-app">박사 과정</li>
              <li data-filter=".filter-web">석사 과정</li>
              <!-- <li data-filter=".filter-card">alumni</li> -->
            </ul>
          </div>
        </div>
        <div class="row portfolio-container">
          <?php 
    	if ($sql != false) {
        foreach ($sql as $doc) {
          $id = $doc['id'];
    			if ($doc['degree'] == 'Doctor') {
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
    				<?php echo '<a href="student_view.php?id='.$id.'"><img style="height:400px; width: 100%;"  class="img-fluid" data-bs-hover-animate="pulse" src="admin/student_img/'.$doc['image_name'].'"></a>'?>
                <div class="portfolio-info" id="portfolio-info">
              <h4>D.C. STUDENT</h4>
              <h5><?= $doc['name']?></h5>
              <p>Email:<?= $doc['email']?></p>
              <?php echo '<a href="admin/student_img/'.$doc['image_name'].'" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Ozoda Makhkamova"><i class="bx bx-plus"></i></a>'?>
              <?php echo '<a href="student_view.php?id='.$id.'" class="details-link" title="More Details"><i class="bx bx-link"></i></a>'; ?>
            </div>
          </div>
    			<?php }?>
    		<?php }?>
    	<?php }?>
          <?php 
    	if ($sql != false) {
        foreach ($sql as $key) {
          $mid = $key['id'];
    			if ($key['degree'] == 'Master') {
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
    				<?php echo '<a href="student_view.php?id='.$mid.'"><img style="height:400px; width: 100%;"  class="img-fluid" data-bs-hover-animate="pulse" src="admin/student_img/'.$key['image_name'].'"></a>'?>
                <div class="portfolio-info"  id="portfolio-info">
              <h4>M.S. STUDENT  </h4>
              <h5><?= $key['name']?></h5>
              <p>Email:<?= $key['email']?></p>
              <?php echo '<a href="admin/student_img/'.$key['image_name'].'" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="'.$key['name'].'"><i class="bx bx-plus"></i></a>'?>
              <?php echo '<a href="student_view.php?id='.$mid.'" class="details-link" title="More Details"><i class="bx bx-link"></i></a>'; ?>
            </div>
          </div>
    			<?php }?>
    		<?php }?>
    	<?php }?>
        </div>
      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Projects</h2>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
              <?php 
                  $sql = mysqli_query($connect,"SELECT *FROM projects");
                  $result = mysqli_fetch_array($sql);
                  $content = $result['Contents'];
                  $conts = substr($content,120,500);
              while($proje = mysqli_fetch_array($project)){
                $id = $proje['id'];
                echo'<a href="project.php?name='.$id.'"><img style="height:180px;" class="img-fluid" src="admin/project_img/'.$proje['project_image'].'" alt="Generic placeholder image"></a>';
                ?>
                <hr>
              <div class="member-info">
                <h4><?php echo '<a href="project.php?name='.$id.'">"'.$proje['project_name'].'"</a></h4>'?>
                <p><?= $conts;?></p>
              </div>
              <?php }?>
              </div>
            </div>
          </div>
          
        </div>

      </div>
    </section><!-- End Team Section -->


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