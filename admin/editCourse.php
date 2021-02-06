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
if (isset($_REQUEST['courseUpdateBtn'])) {
    if (($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_original_price'] == "") || ($_REQUEST['course_price'] == "")) {
        $msg =  '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else {
        $cid = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];
        $cdesc = $_REQUEST['course_desc'];
        $cauthor = $_REQUEST['course_author'];
        $cduration = $_REQUEST['course_duration'];
        $coriginal_price = $_REQUEST['course_original_price'];
        $cprice = $_REQUEST['course_price'];
        // $cimage = '../img/courses_imgs/'.$_FILES['course_img']['name'];

        $course_image = $_FILES['course_img']['name'];
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../img/courses_imgs/'.$course_image;
        move_uploaded_file($course_image_temp, $img_folder);

        if ($_FILES['course_img']['name']!='') {
            $sql = "UPDATE course SET course_name ='$cname',course_desc ='$cdesc',course_author ='$cauthor',course_duration ='$cduration',course_original_price ='$coriginal_price',course_price ='$cprice', course_img ='$img_folder' WHERE course_id='$cid'";

	    }else{
            $sql = "UPDATE course SET course_name ='$cname',course_desc ='$cdesc',course_author ='$cauthor',course_duration ='$cduration',course_original_price ='$coriginal_price',course_price ='$cprice' WHERE course_id='$cid'";
        }
        
       

        if ($conn->query($sql) == true) {
            $msg ='<div class="alert alert-success ml-6 mt-2">Curso Actualizado</div>';
            header('location:courses.php');
        }else{
            $msg ='<div class="alert alert-danger ml-6 mt-2">Error al actualizar</div>';
            
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
    background: #9c979b26; border-radius: 5px;">Editar Curso</h2>
    <?php
    echo $msg;
    if (isset($_REQUEST['view'])) {
        $sql= "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    } 
    ?>
    <form id="edit_form" class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <input type="hidden" id="course_id" name="course_id" value="<?php if (isset($row['course_id'])) { echo $row['course_id']; } ?>">
                <label for="course-name" class="form-label">Nombre</label>
                <input type="text" id="course_name" name="course_name" class="form-control" value="<?php if (isset($row['course_name'])) { echo $row['course_name']; } ?>" >
            </div>
            <div class="col-md-6">
                <label for="course_author" class="form-label">Autor</label>
                <input type="text" id="course_author" name="course_author" class="form-control" value="<?php if (isset($row['course_author'])) { echo $row['course_author']; } ?>">
            </div>
            <div class="col-12">
                <label for="course_desc" class="form-label">Descripcion</label>
                <textarea type="text" id="course_desc" name="course_desc" class="form-control" ><?php if (isset($row['course_desc'])) { echo $row['course_desc']; } ?></textarea>
            </div>
            <div class="col-md-4">
                <label for="course-duration" class="form-label">Duraccion</label>
                <input type="text" id="course_duration" name="course_duration" class="form-control" value="<?php if (isset($row['course_duration'])) { echo $row['course_duration']; } ?>"> 
            </div>
            <div class="col-md-4">
                <label for="course-original-price" class="form-label">Precio Original</label>
                <input type="text" id="course_original_price" name="course_original_price" class="form-control" value="<?php if (isset($row['course_original_price'])) { echo $row['course_original_price']; } ?>">
            </div>
            <div class="col-md-4">
                <label for="course-price" class="form-label">Precio de Venta</label>
                <input type="text" id="course_price" name="course_price" class="form-control" value="<?php if (isset($row['course_price'])) { echo $row['course_price']; } ?>">
            </div>
            <div class="col-md-6">
                <label for="course-img" class="form-label">Imagen</label>
                <img src="<?php if (isset($row['course_img'])) { echo $row['course_img']; } ?>" alt="" class="img-thumbnail">
                <input type="file" id="course_img" name="course_img" class="form-control">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                        <button class="btn btn-success" id="courseUpdateBtn" name="courseUpdateBtn">Actualizar</button>
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