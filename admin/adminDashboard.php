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
  <!-- Page Content Holder -->
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

    <div class="row text-center">
        <div class="col-sm-4 mt-5">
            <div class="car text-white bg-danger">
            <div class="card-header">Cursos</div>
            <div class="card-body">
            <h4 class="card-title">
            <?php 
            $sql = "SELECT COUNT(*) AS conteo FROM course WHERE deleted = '0'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo $row['conteo'];
            ?>
            </h4>
            <a href="courses.php" class="btn text-white">Ver</a>
            </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="car text-white bg-success">
            <div class="card-header">Estudiantes</div>
            <div class="card-body">
            <h4 class="card-title">
            <?php 
            $sql = "SELECT COUNT(*) AS conteo FROM student WHERE deleted = '0'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo $row['conteo'];
            ?>
            </h4>
            <a href="students.php" class="btn text-white">Ver</a>
            </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="car text-white bg-info">
            <div class="card-header">Ventas</div>
            <div class="card-body">
            <h4 class="card-title">
            <?php 
            $sql = "SELECT COUNT(*) AS conteo FROM courseorder";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo $row['conteo'];
            ?>
            </h4>
            <a href="sellReport.php" class="btn text-white">Ver</a>
            </div>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
    <!-- Table -->
        <p class="bg-dark text-white p-2">Cursos Ordenados</p>
        <?php
        $sql_course = "SELECT * FROM courseorder";
        $result = $conn->query($sql_course);
        if ($result->num_rows > 0) {
          echo '
          <table class="table">
            <thead>
            <tr>    
                <th scope="col">Orden ID</th>
                <th scope="col">Curso ID</th>
                <th scope="col">Email Estudiante</th>
                <th scope="col">Fecha Orden</th>
                <th scope="col">Monto</th>
                <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
          ';
          while ($row = $result->fetch_assoc()) {
            echo '
            <tr>    
            <th scope="row">'.$row["order_id"].'</th>
            <td>'.$row["courser_id"].'</td>
            <td>'.$row["stu_email"].'</td>
            <td>'.$row["order_date"].'</td>
            <td>'.$row["amount"].'</td>
            <td>
            </form>
            <form action="" method="POST" class="d-inline">
            <input type="hidden" name="id" value="'.$row["courseorder_id"].'">
            <button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
            </form>
            </td>
                  </tr>
            
            ';
          }
          echo '  </tbody>
          </table>';
        }else {
          echo 'No hay Resultados';
        }
        if (isset($_REQUEST['delete'])) {
          $sql = "DELETE FROM courseorder WHERE courseorder_id = {$_REQUEST['id']}";
          if ($conn->query($sql) == true) {
              echo '<meta http-equiv="refresh" content="0;URL=?checkid='.$_SESSION['course_id'].'" />';
          }else{
              echo "Error al eliminar";
          }
      }
         ?>
        
        
    </div>


    <div class="line"></div>

  </div>
</div>
    
<?php
include('./includes/footer.php');
?>