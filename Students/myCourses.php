<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./includes/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLoginEmail'];
}else{
    echo "<script> location.href='../index.php'; </script>";
}

?>

    <div id="content">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
            <i class="fas fa-align-left" style="color: white;"></i>
            </button>
            </div>
        </div>
        </nav>

    <div class="container">
        <div class="row">
            <h4 class="text-center m-2 mt-4">CURSOS</h4>
            <?php
            $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price FROM courseorder co JOIN course c  ON c.course_id = co.courser_id WHERE co.stu_email = '$stuEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    # code...
            ?>
            <div class="bg-light mb-3">
                <h5 class="card-header"><?php echo $row['course_name'] ?></h5>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?php echo $row['course_img'] ?>" alt="alt" class="card-img-top mt-4">
                    </div>
                    <div class="col-sm-9 mb-3">
                        <div class="card-body">
                        <p class="card-title"><?php echo $row['course_desc'] ?></p>
                        <small class="card-text">Orden ID: <?php echo $row['order_id'] ?></small><br>
                        <small class="card-text">Duracion: <?php echo $row['course_duration'] ?></small><br>
                        <small class="card-text">Instructor: <?php echo $row['course_author'] ?></small><br>
                        <p class="card-text d-inline">Precio: <small><del> $<?php echo $row['course_original_price'] ?></del></small>
                        <span class="font-weight-bolder"> $<?php echo $row['course_price'] ?> </span> </p>
                        <a href="whatchCourse.php?course_id=<?php echo $row['course_id'] ?>" class="btn btn-primary mt-5" style="float: right;">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            }
        }else{
            echo '<div class="card-header mt-5">No hay curso registrados</div>';
        } 
            ?> 
        </div> 
    </div>
    </div>
</div>

<?php 
include('./includes/footer.php');
?>