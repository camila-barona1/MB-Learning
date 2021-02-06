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
}
$passmsg = "";
if (isset($_REQUEST['submitFeedbackBtn'])) {
    if ($_REQUEST['f_content'] == "") {
        $passmsg = '<div class="alert alert-warning ml-6 mt-2">Todos los campos son requeridos</div>';
    }else{
        $fcontent = $_REQUEST["f_content"];
       
        $sql = "INSERT INTO feedback (feed_content, stu_id) VALUES ('$fcontent', $stu_id)";
        if ($conn->query($sql) == true) {
            $passmsg = '<div class="alert alert-success ml-6 mt-2">Gracias por darnos tu opinion!</div>';
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
    background: #9c979b26; border-radius: 5px;">Danos tu opinion</h2>
    <?php
    echo $passmsg;
    ?>
    <form id="edit_form" class="row g-3" style="background: #ffff;" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-12">
               <input type="hidden" id="stuId" name="stuId" value="<?php if (isset($stu_id)) { echo $stu_id; } ?>">
            </div>
            <div class="col-md-12">
                <label for="f_content" class="form-label">Escribir Opinion</label>
                <textarea id="f_content" name="f_content" class="form-control"></textarea>
            </div>
            <div class="col-12">
            <div class="text-center m-3">
                <button class="btn btn-success" id="submitFeedbackBtn" name="submitFeedbackBtn">Enviar</button>
            </div>
            </form>
    </div>        
</div>
</div>


<?php 
include('./includes/footer.php');
?>