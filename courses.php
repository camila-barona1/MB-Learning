<?php include('./includes/header.php') ?>
<?php include('./dbConnection.php') ?>


<div class="container-fuid" style="opacity: 0.8;">
    <div class="row">
        <img src="./img/fondo2.jpg" alt="courses" style="height: 400px; width:100%; object-fit:cover;">
    </div>
</div>

<!-- Start pie de imagen -->
<div class="container-fluid txt-banner" style="background-color: #242423;">
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
<!-- End pie de imagen -->

<!-- Start Most Popular Course -->
    <div class="container mt-5">
    <h1 class="text-center">Todos los cursos</h1>
    <!-- Start Most 1st Card Deck -->
      <div class="card-deck mt-4">
        <div class="row">
        <?php
        $sql = "SELECT * FROM course";
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
    <!-- End Most 1st Card Deck -->
    </div>
    <!-- End Most Popular Cursos -->
    <div style="margin-top: 10%;"></div>

    <!-- Start Including footer -->
<?php include('./Includes/footer.php') ?>
<!-- End Including footer -->