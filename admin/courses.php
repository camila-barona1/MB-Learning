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
        <div class="cal-sm-9 mt-5">
            <p class="bg-dark text-white p-2">Lista de Cursos</p>
            <?php
            $sql = "SELECT * FROM course WHERE deleted ='0'";
            $result = $conn->query($sql);
            if ($result->num_rows >0) {
                # code...
            
            ?>
            <table class="table">   
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Duraccion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
               
                <?php 
                while ($row = $result->fetch_assoc()) {
            
                    echo '<tr>
                        <th scope="row">'.$row['course_id'].'</th>
                        <td>'.$row['course_name'].'</td>
                        <td>'.$row['course_author'].'</td>
                        <td><img style="width:4rem" src="'.$row['course_img'].' ?>"/></td>
                        <td>'.$row['course_duration'].'</td>
                        <td>$'.$row['course_price'].'</td>
                        <td>
                        <form action="editCourse.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value='.$row['course_id'].'>
                        <button type="submit" name="view" value="view" class="btn btn-info mr-3 text-white"><i class="fas fa-pen"></i></button>
                        </form>
                        <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="id" value='.$row['course_id'].'>
                        <button type="submit" name="delete" value="Delete" class="btn btn-secondary mr-3"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        </td>
                    </tr>';
                    } ?>
                </tbody>
            </table>
            <?php }else{ echo "No hay resultados";} ?>
        </div>
    </div>
    <div>   
        <a href="addCourse.php" class="btn btn-danger box"><i class="fas fa-plus fa-2x"></i></a>
    </div>
</div>

<?php
include('./includes/footer.php');

if (isset($_REQUEST['delete'])) {
    $sql = "UPDATE course SET deleted='1' WHERE course_id = {$_REQUEST['id']}";
    if ($conn->query($sql) == true) {
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    }else{
        echo "Error al eliminar";
    }
}

?>