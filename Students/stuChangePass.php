<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./includes/header.php');
include('../dbConnection.php');
$passmsg="";
if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLoginEmail'];
}else{
    echo "<script> location.href='../index.php'; </script>";
}

if (isset($_REQUEST['stuChangePassBtn'])) {
    if ($_REQUEST['stuNewPass'] == "") {
        $passmsg = '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else{
        $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $stuNewPass = $_REQUEST['stuNewPass'];
            $sql = "UPDATE student set stu_pass ='$stuNewPass' WHERE stu_email = '$stuEmail'";
            if ($conn->query($sql) == true) {
                $passmsg = '<div class="alert alert-success ml-6 mt-2">Contraseña actualizada</div>';
            }else{
                $passmsg = '<div class="alert alert-danger ml-6 mt-2">Error al actualizar</div>';
            }
        }
    }
}
?>
    <div id="content">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
<div class="fdf"></div>
        <div class="navbar-header">
          <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
          <i class="fas fa-align-left" style="color: white;"></i>
        </button>
        </div>
      </div>
    </nav>
        <div class="cal-sm-9 mt-2">
            <div class="row justify-content-center" style="padding: 30px;">
    <?php echo $passmsg; ?>
    <h2 class="text-center" style="
    text-transform: uppercase;
    background: #9c979b26; border-radius: 5px;">Cambiar Contraseña</h2>
    <form class="row g-3" style="background: #ffff;" action="" method="POST">
            <div class="col-md-6">
                <label for="admin-name" class="form-label">Email</label>
                <input type="text" id="inputEmail" class="form-control" value="<?php echo $stuEmail; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="course-price" class="form-label">Nueva Contraseña</label>
                <input type="password" id="stuNewPass" name="stuNewPass" class="form-control">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                        <button class="btn btn-danger" id="stuChangePassBtn" name="stuChangePassBtn">Cambiar</button>
                        <button type="reset" class="btn btn-secondary">Limpiar</button>
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