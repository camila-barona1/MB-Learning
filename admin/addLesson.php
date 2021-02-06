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
if (isset($_REQUEST['lesionSubmitBtn'])) {
    if (($_REQUEST['lesion_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "")) {
        $msg =  '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else{
        $lesion_name = $_REQUEST['lesion_name'];
        $lesson_desc = $_REQUEST['lesson_desc'];
        $course_id = $_REQUEST['course_id'];
        $course_name = $_REQUEST['course_name'];
        
        $lesson_link = $_FILES['lesson_link']['name'];
        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $link_folder = '../lesson_videos/'.$lesson_link;
        move_uploaded_file($lesson_link_temp, $link_folder);

        $sql = "
        INSERT INTO
            lesson 
            (lesson_name, lesson_desc, lesson_link, course_id, course_name)
        VALUES
            ('$lesion_name','$lesson_desc','$link_folder','$course_id','$course_name')    
        ";

        if ($conn->query($sql) == true) {
            $msg = '<div class="alert alert-success ml-6 mt-2">Lesion Añadido</div>';
            header("location:lessons.php?checkid={$_SESSION['course_id']}");
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
    background: #9c979b26; border-radius: 5px;">Anadir Lesion</h2>
    <?php echo $msg; ?>
    <form class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="course_id" class="form-label">ID Curso</label>
                <input type="text" id="course_id" name="course_id" class="form-control" value="<?php if (isset($_SESSION['course_id'])) {
                    echo $_SESSION['course_id'];
                } ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="course_name" class="form-label">Curso</label>
                <input type="text" id="course_name" name="course_name" class="form-control" value="<?php if (isset($_SESSION['course_name'])) {
                    echo $_SESSION['course_name'];
                }?> " readonly>
            </div>    
            <div class="col-md-6">
                <label for="lesion-name" class="form-label">Nombre</label>
                <input type="text" id="lesion_name" name="lesion_name" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="lesson_desc" class="form-label">Descripcion</label>
                <textarea type="text" id="lesson_desc" name="lesson_desc" class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <label for="lesson_link" class="form-label">Link video lesion</label>
                <input type="file" id="lesson_link" name="lesson_link" class="form-control">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                        <button class="btn btn-success" id="lesionSubmitBtn" name="lesionSubmitBtn">Añadir</button>
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