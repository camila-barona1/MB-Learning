<?php include('./includes/header.php') ?>
<?php include('./dbConnection.php') ?>

<div class="container-fuid" style="opacity: 0.8;">
    <div class="row">
        <img src="./img/fondo3.jpg" alt="courses" style="height: 400px; width:100%; object-fit:cover;">
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

<!-- Start Main Content -->

    <div class="container mt-5">
    <?php
    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];
        $_SESSION['course_id'] = $course_id;
        $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
        $result = $conn->query($sql);
        $row =  $result->fetch_assoc();

    }
    ?>
    <div class="card border-light" >
    <div class="card-header">Detalles</div>
        <div class="row justify-content-center" style="padding-top: 10px;">
            <div class="col-sm-4">
                <img src="<?php echo str_replace('..', '.', $row['course_img']) ?>" class="card-img-top" alt="">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Nombre Curso: <?php echo $row['course_name'] ?></h5>
                    <p class="card-text" style="text-align: justify;">Descripcion: <?php echo $row['course_desc'] ?></p>
                    <p class="card-text">Duracion: <?php echo $row['course_duration'] ?></p>
                    <form action="checkout.php" method="post">
                        <p class="card-text d-inline">Price: <small><del>$<?php echo $row['course_original_price'] ?></del></small><span class="font-weight-bolder"> $<?php echo $row['course_price'] ?></span></p>
                        <input type="hidden" name="amount" value="<?php echo $row['course_price'] ?>">
                        <input type="hidden" name="course_name" value="<?php echo $row['course_name'] ?>">
                        <input type="hidden" name="course_img" value="<?php echo str_replace('..', '.', $row['course_img'])  ?>">
                        <input type="hidden" name="course_duration" value="<?php echo $row['course_duration']; ?>">

                        <button type="submit" class="btn btn-primary text-white float-right" name="buy">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3" style="width: 75.5%;">
    <div class="row">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Lesion No.</th>
                <th scope="col">Lesion</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $sql_search = "SELECT * FROM lesson WHERE course_id = $course_id";
    $result_query = $conn->query($sql_search);
    if ($result_query->num_rows > 0) {
        $number = 1;
        while ($row = $result_query->fetch_assoc()) {
            if ($course_id == $row['course_id']) {
                echo '
                <tr>
                    <th scope="row">'.$number++.'</th>
                    <td>'.$row['lesson_name'].'</td>
                </tr>
                ';
            }
        }
    }
    ?>
            </tbody>
        </table>
    </div>
    
</div>
<div class="text-center">
<a href="courses.php" class="btn btn-danger btn mt-3">Ver todos los cursos</a>
</div>

<!-- End Main Content -->

<div style="margin-top: 10%;"></div>
<!-- Start Including footer -->
<?php include('./Includes/footer.php') ?>
<!-- End Including footer -->