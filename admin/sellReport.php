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
    
    <div class="col-sm-9 mt-5">
    <form action="" method="POST" class="d-print-none">
        <div class="form-row">
            <div class="form-group col-md-3">
            <input type="date" id="startdate" name="startdate" class="form-control">
            </div> <span> a </span>
            <div class="form-group col-md-3">
                <input type="date" id="enddate" name="enddate" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" name="searchSub" value="Buscar">
            </div>
        </div>
    </form>
    <?php
    if (isset($_REQUEST['searchSub'])) {
        $start_date = $_REQUEST['startdate'];
        $end_date = $_REQUEST['enddate'];

        // $sql = "SELECT * FROM courseorder WHERE order_date BETWEEN '$start_date' AND '$end_date'";
        $sql = "SELECT * FROM courseorder WHERE order_date >= '$start_date 00:00:00'AND order_date <= '$end_date 23:59:59'";
        // print_r($sql);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '
            <p class="bg-dark text-white p-2 mt-4">Detalles</p>
               <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Orden ID</th>
                            <th scope="col">Curso ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Estado Pago</th>
                            <th scope="col">Fecha Orden</th>
                            <th scope="col">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            while ($row = $result->fetch_assoc()) {
                echo '
                <tr>
                    <th scope="row">'.$row['order_id'].'</th>
                    <td>'.$row['courser_id'].'</td>
                    <td>'.$row['stu_email'].'</td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['order_date'].'</td>
                    <td>$ '.$row['amount'].'</td>
                </tr>
                ';
            }
            echo '
            </table>
            <form class="d-print-none">
            <input class="btn btn-danger" type="submit" value="Imprimir" onClick="window.print()">
            </form>
            ';
        }else{
            echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'>No Hay Ventas Registrados</div>";
        }
    }
    ?>
    </div>

</div>

</div>

</div>
<?php
include('./includes/footer.php');
?>