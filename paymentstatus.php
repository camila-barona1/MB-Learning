<?php include('./includes/header.php') ?>
<?php include('./dbConnection.php') ?>

<div class="container-fuid" style="opacity: 0.8;">
    <div class="row">
        <img src="./img/fondo1.jpg" alt="courses" style="height: 400px; width:100%; object-fit:cover;">
    </div>
</div>

<!-- Start pie de imagen -->
<div class="container-fluid txt-banner" style="background-color: #242423;">
      <div class="row bottom-banner">
        <div class="col-sm">
          <h6><i class="fas fa-book-open mr3"></i> 100+ Cursos Online</h6>
        </div>
        <div class="col-sm">
          <h6><i class="fas fa-users mr3"></i> Instructores Expertos</h6>
        </div>
        <div class="col-sm">
          <h6><i class="fas fa-keyboard mr3"></i> Acceso de por vida</h6>
        </div>
        <div class="col-sm">
          <h6><i class="fas fa-money-bill mr3"></i> Garantia</h6>
        </div>
      </div>
    </div>
<!-- End pie de imagen -->

<!-- Start Main Content -->
<div class="container" style="
    width: 34%;">
    <h2 class="text-center my-4">Estado de pago</h2>
    <form action="" class="row g-3">
        <div class="col-auto">
            <label style="padding-top: 6%;" for="">ID de Orden:</label>
        </div>
        <div class="col-auto">
            <input type="text" name="order_id" class="form-control" id="inputPassword2" placeholder="ORDEN ID">
        </div>
        
        <div class="col-auto">
        <input type="submit" name="searcBtn" class="btn btn-primary" value="Visualizar">
        </div>
    </form>
</div>
<?php
        
        if (isset($_REQUEST['searcBtn'])) {
            if ($_REQUEST['order_id'] == "") {
                echo '<div class="text-center">Este campo es requerido</div>';
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
                            <h3 class="container mt-5 bg-dark text-white p-2 col-sm-8" style="width: 64.5%;">Orden ID: <?php if (isset($row['order_id'])) {
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
                                        <th scope="col">Estado pago</th>
                                        <td>'.$row["status"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Monto</th>
                                        <td>$ '.$row["amount"].'</td>
                                        </tr>
                                        <tr>
                                        <th scope="col">Fecha y hora</th>
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
<!-- End Main Content -->

<!-- Start contact us -->
<?php include('./contact.php') ?>
<!-- End contact us -->

<!-- Start Including footer -->
<?php include('./Includes/footer.php') ?>
<!-- End Including footer -->