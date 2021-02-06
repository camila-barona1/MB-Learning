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
    <div class="row justify-content-center">
    <form class="row row-cols-lg-auto g-3 align-items-center">
        <div class="col-12">
            <label class="visually-hidden" for="checkid">Curso ID</label>
            <div class="input-group">
            <div class="input-group-text">ID Curso</div>
            <input type="text" class="form-control" id="checkid" name="checkid">
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
        </form>
    </div>
    <?php
        $sql = "SELECT course_id FROM course";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if (isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['course_id']) {
                $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['checkid']}";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if (($row['course_id'] == $_REQUEST['checkid'])) {
                    $_SESSION['course_id'] = $row['course_id'];
                    $_SESSION['course_name'] = $row['course_name'];
                    $boton = '<div>
                    <a class="btn btn-danger box" href="./addLesson.php"><i class="fas fa-plus fa-2x"></i></a>
                    </div>';
                    ?>
                    <h3 class="mt-5 bg-dark text-white p-2">ID Curso: <?php if (isset($row['course_id'])) {
                        echo $row['course_id'];
                    } ?> Nombre: <?php if (isset($row['course_name'])) {
                        echo $row['course_name'];
                    } ?></h3>
                    <?php
                    $sql = "SELECT * FROM lesson WHERE course_id = {$_REQUEST['checkid']}";
                    $result = $conn->query($sql);
                    if ($row = $result->num_rows !=0) {
                    
                    echo '<table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Link</th>
                        <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>';
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <th scope="col">'.$row["lesson_id"].'</th>
                                <td>'.$row["lesson_name"].'</td>
                                <td>'.$row["lesson_desc"].'</td>
                                <td>'.$row["lesson_link"].'</td>
                                <td>
                                    <form action="editLesson.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="'.$row["lesson_id"].'">
                                    <button type="submit" class="btn btn-info text-white" name="view" value="view"><i class="fas fa-pen"></i></button>
                                    </form>
                                    <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="'.$row["lesson_id"].'">
                                    <button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            ';
                        }
                        echo '
                        </tbody>
                        </table>';
                    }else{
                    echo '<div class="alert alert-dark mt-4" role="alert">Este curso aun no tiene lesiones</div>';
                    }
                }else if(($row['course_id'] != $_REQUEST['checkid'])){
                    $boton = '';
                }
            }
           
        }
        if (isset($_REQUEST['delete'])) {
            $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
            if ($conn->query($sql) == true) {
                echo '<meta http-equiv="refresh" content="0;URL=?checkid='.$_SESSION['course_id'].'" />';
            }else{
                echo "Error al eliminar";
            }
        }
    ?>

</div>
<?php
if (isset($_SESSION['course_id']) && isset($_SESSION['course_name'])) {
    echo (isset($boton)) ? $boton : '';
}

?>
</div>
<?php
include('./includes/footer.php');
?>