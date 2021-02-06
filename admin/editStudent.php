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
if (isset($_REQUEST['studentUpdateBtn'])) {
    if (($_REQUEST['stu_id'] == "") || ($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "") || ($_REQUEST['stu_occ'] == "")) {
        $msg =  '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else {
        $sid = $_REQUEST['stu_id'];
        $sname = $_REQUEST['stu_name'];
        $semail = $_REQUEST['stu_email'];
        $spass = $_REQUEST['stu_pass'];
        $soccupation = $_REQUEST['stu_occ'];

        $sql = "UPDATE student SET stu_name='$sname',stu_email='$semail',stu_pass ='$spass',stu_occ ='$soccupation' WHERE stu_id='$sid'";

        if ($conn->query($sql) == true) {
            $msg ='<div class="alert alert-success ml-6 mt-2">Curso Actualizado</div>';
            header('location:students.php');
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
        $sql= "SELECT * FROM student WHERE stu_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    } 
    ?>
    <form id="edit_form" class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
               <input type="hidden" id="stu_id" name="stu_id" value="<?php if (isset($row['stu_id'])) { echo $row['stu_id']; } ?>">
                <label for="stu-name" class="form-label">Nombre</label>
                <input type="text" id="stu_name" name="stu_name"
                " class="form-control" value="<?php if (isset($row['stu_name'])) { echo $row['stu_name']; } ?>">
            </div>
            <div class="col-md-6">
                <label for="stu_email" class="form-label">Email</label>
                <input type="email" id="stu_email" name="stu_email" class="form-control" value="<?php if (isset($row['stu_email'])) { echo $row['stu_email']; } ?>">
            </div>
            <div class="col-md-6">
                <label for="stu-name" class="form-label">Contraseña</label>
                <input type="password" id="stu_pass" name="stu_pass" class="form-control" value="<?php if (isset($row['stu_pass'])) { echo $row['stu_pass']; } ?>">
            </div>
            <div class="col-md-6">
                <label for="stu_occ" class="form-label">Ocupacion</label>
                <input type="text" id="stu_occ" name="stu_occ" class="form-control" value="<?php if (isset($row['stu_occ'])) { echo $row['stu_occ']; } ?>">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                <button class="btn btn-success" id="studentUpdateBtn" name="studentUpdateBtn">Actualizar</button>
                <a href="students.php" class="btn btn-secondary">Cerrar</a>
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