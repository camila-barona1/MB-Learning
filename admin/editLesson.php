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
if (isset($_REQUEST['lessonUpdateBtn'])) {
    if (($_REQUEST['lesson_id'] == "") || ($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "")) {
        $msg =  '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else {
        $lid = $_REQUEST['lesson_id'];
        $lname = $_REQUEST['lesson_name'];
        $ldesc = $_REQUEST['lesson_desc'];
        $cid = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];
        // $cimage = '../img/courses_imgs/'.$_FILES['course_img']['name'];

        $llink = $_FILES['lesson_link']['name'];
        $link_temp = $_FILES['lesson_link']['tmp_name'];
        $video_folder = '../lesson_videos/'.$llink;
        move_uploaded_file($link_temp, $video_folder);

        if ($_FILES['lesson_link']['name']!='') {
            $sql = "UPDATE lesson SET lesson_name ='$lname',lesson_desc ='$ldesc', lesson_link ='$video_folder' WHERE lesson_id='$lid'";

	    }else{
            $sql = "UPDATE lesson SET lesson_name ='$lname',lesson_desc ='$ldesc' WHERE lesson_id='$lid'";
        }
        
        if ($conn->query($sql) == true) {
            $msg ='<div class="alert alert-success ml-6 mt-2">Curso Actualizado</div>';
            header("location:lessons.php?checkid={$_SESSION['course_id']}");
        
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
    background: #9c979b26; border-radius: 5px;">Editar Lesion</h2>
    <?php
    echo $msg;
    if (isset($_REQUEST['view'])) {
        $sql= "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    } 
    ?>
    <form id="edit_form" class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="course_id" class="form-label">ID Curso</label>
                <input type="text" id="course_id" name="course_id" class="form-control" value="<?php if (isset($row['course_id'])) {
                    echo $row['course_id'];
                } ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="course_name" class="form-label">Curso</label>
                <input type="text" id="course_name" name="course_name" class="form-control" value="<?php if (isset($row['course_name'])) {
                    echo $row['course_name'];
                }?> " readonly>
            </div>
            <div class="col-md-6">
                <input type="hidden" id="lesson_id" name="lesson_id" value="<?php if (isset($row['lesson_id'])) { echo $row['lesson_id']; } ?>">
                <label for="course-name" class="form-label">Nombre</label>
                <input type="text" id="lesson_name" name="lesson_name" class="form-control" value="<?php if (isset($row['lesson_name'])) { echo $row['lesson_name']; } ?>" >
            </div>
            <div class="col-6">
                <label for="lesson_desc" class="form-label">Descripcion</label>
                <textarea type="text" id="lesson_desc" name="lesson_desc" class="form-control" ><?php if (isset($row['lesson_desc'])) { echo $row['lesson_desc']; } ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="lesson_link" class="form-label">Link</label>
                <div class="embed-responsive embed-responsive-16by9" style="padding-bottom: 5px;">
                    <iframe src="<?php if (isset($row['lesson_link'])) {
                        echo $row['lesson_link'];
                    } ?>" frameborder="0" allowfullscreen class="embed-responsive-item"></iframe>
                </div>
                <input type="file" class="form-control" id="lesson_link" name="lesson_link">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                        <button class="btn btn-success" id="lessonUpdateBtn" name="lessonUpdateBtn">Actualizar</button>
                        <a href="lessons.php?checkid=<?php echo $_SESSION['course_id'] ?>" class="btn btn-secondary">Cerrar</a>
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