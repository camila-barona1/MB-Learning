<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./includes/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLoginemail'];
}else{
    echo "<script> location.href='../index.php'; </script>";
}

$msg="";
if (isset($_REQUEST['courseSubmitBtn'])) {
    if (($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_original_price'] == "") || ($_REQUEST['course_price'] == "")) {
        $msg =  '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else{
        $course_name = $_REQUEST['course_name'];
        $course_desc = $_REQUEST['course_desc'];
        $course_author = $_REQUEST['course_author'];
        $course_duration = $_REQUEST['course_duration'];
        $course_original_price = $_REQUEST['course_original_price'];
        $course_price = $_REQUEST['course_price'];
        $course_image = $_FILES['course_img']['name'];
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../img/courses_imgs/'.$course_image;
        move_uploaded_file($course_image_temp, $img_folder);

        $sql = "
        INSERT INTO
            course 
            (course_name, course_desc, course_author, course_img, course_duration, course_price, course_original_price)
        VALUES
            ('$course_name','$course_desc','$course_author','$img_folder','$course_duration','$course_price','$course_original_price')    
        ";

        if ($conn->query($sql) == true) {
            $msg = '<div class="alert alert-success ml-6 mt-2">Curso Añadido</div>';
        }else {
            $msg = '<div class="alert alert-danger ml-6 mt-2">Error al añadir curso</div>';
        }
    }
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
    
    <div class="row justify-content-center" style="padding: 30px;">
    <h2 class="text-center" style="
    text-transform: uppercase;
    background: #9c979b26; border-radius: 5px;">Anadir Curso</h2>
    <?php echo $msg; ?>
    <form class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="course-name" class="form-label">Nombre</label>
                <input type="text" id="course_name" name="course_name" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="course_author" class="form-label">Autor</label>
                <input type="text" id="course_author" name="course_author" class="form-control">
            </div>
            <div class="col-12">
                <label for="course_desc" class="form-label">Descripcion</label>
                <textarea type="text" id="course_desc" name="course_desc" class="form-control"></textarea>
            </div>
            <div class="col-md-4">
                <label for="course-duration" class="form-label">Duraccion</label>
                <input type="text" id="course_duration" name="course_duration" class="form-control">
            </div>
            <div class="col-md-4">
                
                <label for="course-original-price" class="form-label">Precio Original</label>
                <input type="text" id="course_original_price" name="course_original_price" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="course-price" class="form-label">Precio de Venta</label>
                <input type="text" id="course_price" name="course_price" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="course-img" class="form-label">Imagen</label>
                <input type="file" id="course_img" name="course_img" class="form-control">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                        <button class="btn btn-success" id="courseSubmitBtn" name="courseSubmitBtn">Añadir</button>
                        <a href="courses.php" class="btn btn-secondary">Cerrar</a>
                    </div>
            </div>
            
            </form>
        </div>        
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
?>