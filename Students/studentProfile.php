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

$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows ==1) {
    $row = $result->fetch_assoc();
    $stu_id = $row['stu_id'];
    $stu_name = $row['stu_name'];
    $stu_occ = $row['stu_occ'];
    $stu_img = $row['stu_img'];
}
$passmsg="";
if (isset($_REQUEST['studentUpdateBtn'])) {
    if ($_REQUEST['stuName'] == "") {
        $passmsg = '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else{
        $stuName = $_REQUEST["stuName"];
        $stuOcc = $_REQUEST["stuOcc"];
        $stu_img = $_FILES["stuImg"]['name'];
        $stu_img_temp = $_FILES["stuImg"]['tmp_name'];
        $img_folder = '../img/students_imgs/'.$stu_img;
        move_uploaded_file($stu_img_temp, $img_folder);

        if ($_FILES['stuImg']['name']!='') {
            $sql = "UPDATE student SET stu_name = '$stuName', stu_occ = '$stuOcc', stu_img = '$img_folder' WHERE stu_email = '$stuEmail'";
	    }else{
            $sql = "UPDATE student SET stu_name = '$stuName', stu_occ = '$stuOcc' WHERE stu_email = '$stuEmail'";;
        }

        if ($conn->query($sql) == true) {
            $passmsg = 'updated';
            header('location:studentProfile.php');
        }else{
            $passmsg = 'no updated';
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
    background: #9c979b26; border-radius: 5px;">Editar Perfil</h2>
    <?php
    echo $passmsg;
    ?>
    <form id="edit_form" class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
               <input type="hidden" id="stuId" name="stuId" value="<?php if (isset($stu_id)) { echo $row['stu_id']; } ?>">
                <label for="stu-email" class="form-label">Email</label>
                <input type="email" id="stuEmail" name="stuEmail"
                " class="form-control" value="<?php if (isset($stuEmail)) { echo $stuEmail; } ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="stu_name" class="form-label">Nombre</label>
                <input type="text" id="stuName" name="stuName" class="form-control" value="<?php if (isset($stu_name)) { echo $stu_name; } ?>">
            </div>
            <div class="col-md-6">
                <label for="stuOcc" class="form-label">Ocupacion</label>
                <input type="text" id="stuOcc" name="stuOcc" class="form-control" value="<?php if (isset($stu_occ)) { echo $stu_occ; } ?>">
            </div>
            <div class="col-md-6">
                <label for="stuImg" class="form-label">Cargar Imagen</label>
                <input type="file" id="stuImg" name="stuImg" class="form-control">
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                <button class="btn btn-success" id="studentUpdateBtn" name="studentUpdateBtn">Actualizar</button>
            </div>
            </form>
        </div>        
        </div>
    </div>
</div>

<?php 
include('./includes/footer.php');
?>