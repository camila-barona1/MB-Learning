<?php include('./Includes/header.php'); ?>
<?php include('./dbConnection.php'); ?>
    <!-- start video bg -->
    <div class="container-fluid remove-vid-margin">
      <div class="vid-parent">
        <video playsinline autoplay muted loop>
          <source src="video/desktop2.mp4">
        </video>
        <div class="vid-overlay"></div>
      </div>
      <div class="vid-content">
        <h1 class="my-content">Bienvenido a MBSchool</h1>
        
        <small class="my-content" >Aprende y Emprende</small><br>
        <?php 
          if (!isset($_SESSION['is_login'])) {
            echo '
            <a href="#" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: #ffff;">Empezar!</a>
            ';
          }else{
            echo '
            <a href="./Students/studentProfile.php" class="btn btn-info mt-3" style="color: #ffff;">Mi Perfil</a>';
          }
        ?>
        
          <!-- Button trigger modal -->
      </div>
    </div>
    <!-- end video bg -->

    <!-- Start text banner -->
    <div class="container-fluid txt-banner" style="background-color: #181f20db;">
      <div class="row bottom-banner">
        <div class="col-sm">
          <h6><i class="fas fa-book-open mr3"></i> 100+ Cursos Online</h6>
        </div>
        <div class="col-sm">
          <h6><i class="fas fa-users mr3"></i> Instructores Expertos</h6>
        </div>
        <div class="col-sm">
          <h6><i class="fas fa-keyboard mr3"></i> Acceso de por vida</h6>
        </div>
        <div class="col-sm">
          <h6><i class="fas fa-money-bill mr3"></i> Garantia</h6>
        </div>
      </div>
    </div>
    <!-- End text banner -->

    <!-- Start Most Popular Course -->
    <div class="container mt-5">
    <h1 class="text-center">Cursos Populares</h1>
    <!-- Start Most 1st Card Deck -->
      <div class="card-deck mt-4">
        <div class="row">
        <?php
        $sql = "SELECT * FROM course LIMIT 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            echo '
            <div class="col-sm-4 p-3">
              <a href="coursedetails.php?course_id='.$course_id.'"  class="btn" style="text-align: left; padding:0px; margin:0px;">
              <div class="card">
                <img src="'. str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="PHP" />
                  <div class="card-body">
                    <h5 class="card-title">'.$row['course_name'].'</h5>
                      <p class="card-text">'.$row['course_desc'].'</p>
                  </div>
                  <div class="card-footer">
                  <p class="card-text d-inline">Valor: <small><del>$ '.$row['course_original_price'].' </del>&nbsp</small><span class="font-weight-bolder"> $'.$row['course_price'].'</span></p><a href="coursedetails.php?course_id='.$course_id.'" class="btn btn-primary text-white float-right">Inscribirse</a>
                  </div>
              </div>
              </a>
            </div>  
            ';
          }
        }
        ?>
        </div>        
      </div>
    <!-- End Most 1st Card Deck -->
    <!-- Start Most 2nd Card Deck -->
    <div class="card-deck mt-4" >
    <div class="row">
    <?php
        $sql = "SELECT * FROM course LIMIT 3, 3";
        $result = $conn->query($sql);
        if ($result->num_rows >0) {
          while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            echo '
            <div class="col-sm-4 p-3">
              <a href="coursedetails.php?course_id='.$course_id.'"  class="btn" style="text-align: left; padding:0px; margin:0px;">
              <div class="card">
                <img src="'. str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="PHP" />
                  <div class="card-body">
                    <h5 class="card-title">'.$row['course_name'].'</h5>
                      <p class="card-text">'.$row['course_desc'].'</p>
                  </div>
                  <div class="card-footer">
                  <p class="card-text d-inline">Valor: <small><del>$ '.$row['course_original_price'].' </del>&nbsp</small><span class="font-weight-bolder"> $'.$row['course_price'].'</span></p><a href="coursedetails.php?course_id='.$course_id.'" class="btn btn-primary text-white float-right">Inscribirse</a>
                  </div>
              </div>
              </a>
            </div>  
            ';
          }
        }
        ?>
    <!-- End Most 2nd Card Deck -->
      <div class="text-center m-2" id="testi">
      <a href="courses.php" class="btn btn-danger btn mt-3">Ver todos los cursos</a>
      </div>
    </div>
    <!-- End Most Popular Cursos -->
    <!-- Start Students Testimonial -->
    <!-- TESTIMONIALS -->
    <section class="testimonials mt-5" >
  <div class="container">
    <h1 class="text-center p-2" style="text-transform: uppercase;
    font-style: italic;">Testimonios</h1>
      <div class="row">
        <div class="col-sm-12">
          <div id="customers-testimonials" class="owl-carousel">

            <?php 
            $sql = "SELECT s.stu_name, s.stu_occ, s.stu_img, f.deleted, f.feed_content FROM student s JOIN feedback f ON s.stu_id = f.stu_id WHERE f.deleted = '0'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                $stu_img = $row['stu_img'];
                $stu_img = str_replace('..', '.', $row['stu_img']); 
            ?>
            <!--TESTIMONIAL 1 -->
            <div class="item">
              <div class="shadow-effect">
              <img class="testimonial-pic" src="<?php echo $stu_img ?>" alt="">
              <p><em><?php echo $row['feed_content'] ?></em></p>
                <b><?php echo $row['stu_occ'] ?></b>
              </div>
              <div class="testimonial-name" style="text-transform: uppercase;"><?php echo $row['stu_name'] ?></div>
            </div>
            <!--END OF TESTIMONIAL 1 -->
            <?php  }
            } ?>
            </div>
        </div>
      </div></div>
    </section>
    <!-- END OF TESTIMONIALS -->
    <!-- End Students Testimonial -->

    <!-- Start Contact Us -->
    <?php include('./contact.php'); ?> 
    <!-- End Contact Us -->
    
    <!-- Start Social Media -->
      <div class="container-fluid" style="background-color: #8aa2ac;">
      <div class="row text-white text-center p-1">
      <div class="col-sm">
      <a href="" class="text-white social-hover"><i class="fab fa-facebook-f"></i> Facebook</a>
      </div>
      <div class="col-sm">
      <a href="" class="text-white social-hover"><i class="fab fa-twitter"></i>Twitter</a>
      </div>
      <div class="col-sm">
      <a href="" class="text-white social-hover"><i class="fab fa-whatsapp"></i> WhatsApp</a>
      </div>
      <div class="col-sm">
      <a href="" class="text-white social-hover"><i class="fab fa-instagram"></i> Instagram</a>
      </div>
      </div>
      
      </div>
    <!-- End Social Media -->

    <!-- Start About Section -->
    <div class="container-fluid p-4">
      <div class="container">
        <div class="row text-center">
          <div class="col-sm">
            <h5>Acerca de Nosotros</h5>
            <p>MBSchool promueve la buena educacion</p>
          </div>
          <div class="col-sm">
            <h5>Category</h5>
            <a href="#" class="text-dark">Web Development</a>
            <a href="#" class="text-dark">Diseño Web</a><br>
            <a href="#" class="text-dark">Android App</a><br>
            <a href="#" class="text-dark">Desarollo iOS</a><br>
            <a href="#" class="text-dark">Data Analysis</a><br>
          </div>
          <div class="col-sm">
            <h5>Contactenos</h5>  
            <p>MBSchool LTD</p>
          </div>
        </div>
      </div>
    </div>
    <!-- End About Section -->

    <!-- Start Including footer -->
<?php include('./includes/footer.php') ?>
    <!-- End Including footer -->
