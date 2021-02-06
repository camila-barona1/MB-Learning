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
            <label class="visually-hidden" for="order_id">Orden ID</label>
            <div class="input-group">
            <div class="input-group-text">Order ID</div>
            <input type="text" class="form-control" id="order_id" name="order_id">
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="searchBtn">Buscar</button>
        </div>
        </form>
    </div>
    <?php
        
        if (isset($_REQUEST['searchBtn'])) {
            if ($_REQUEST['order_id'] == "") {
                echo 'Este campo es requerido';
            }else{
            $sql = "SELECT order_id FROM courseorder";
            $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if (isset($_REQUEST['order_id'])) {
                        $sql = "SELECT * FROM courseorder WHERE order_id = '{$_REQUEST['order_id']}'";
                        $result = $conn->query($sql);   
                        if (($result->num_rows ==0)) {
                            echo 'No hay curso registrados con este ID';
                        }else{
                            $row = $result->fetch_assoc();
                            $_SESSION['order_id'] = $row['order_id'];
                            $print_boton = '<button type="button" class="btn btn-primary" onclick="javascript:window.print();">Imprimir</button>';
                            ?>
                            <h3 class="container mt-5 bg-dark text-white p-2 col-sm-8" style="width: 64.5%;">ID Order: <?php if (isset($row['order_id'])) {
                                echo $row['order_id'];
                            } ?> </h3>
                            <?php
                            $sql = "SELECT co.*, c.course_name FROM courseorder co JOIN course c ON c.course_id = co.courser_id WHERE order_id = '{$_REQUEST['order_id']}'";
                            $result = $conn->query($sql);
                            if ($row = $result->num_rows !=0) {
                            
                            echo '';
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <div class="container justify-content-center col-sm-8">
                                    <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">'.$row["order_id"].'</th>
                                        <tr>
                                        <th scope="col">Email Estudiante</th>
                                        <td>'.$row["stu_email"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Curso ID</th>
                                        <td>'.$row["courser_id"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Nombre Curso</th>
                                        <td>'.$row["course_name"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Estado</th>
                                        <td>'.$row["status"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Monto</th>
                                        <td>$ '.$row["amount"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Fecha</th>
                                        <td>'.$row["order_date"].'</td>
                                        </tr>

                                        </tr>
                                    </tbody>
                                    ';
                                }
                                echo '
                                </table>
                                </div>
                                ';
                            }
                        }
                    }
                }                
                }
            }
    ?>
    <div class="text-center">
<?php
if (isset($_SESSION['order_id'])) {
    echo (isset($print_boton)) ? $print_boton : '';
}

?>
</div>
</div>

</div>

</div>
<?php
include('./includes/footer.php');
?>