<?php include('./includes/header.php') ?>
<?php include('./dbConnection.php') ?>

<div class="container-fuid" style="opacity: 0.8;">
    <div class="row">
        <img src="./img/fondo2.jpg" alt="courses" style="height: 500px; width:100%; object-fit:cover;">
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

<div class="container jumbotron mb-6 mt-5">
    <div class="row">
        <div class="col-md-4">
        <h5 class="mb-3">Ya esta registrado || Ingresa</h5>
        <form role="form" id="stuLoginForm">
                <div class="form-row">
                  <div  class="form-group col-md-8">
                    <i class="fas fa-envelope icon" style="color: #8aa2ac;"></i>
                    <label for="stuLogemail">E-mail</label>
                    <input type="email" class="form-control" name="stuLoginemail" id="stuLoginemail">
                  </div>
                  <div  class="form-group col-md-8">
                    <i class="fas fa-key icon" style="color: #8aa2ac;"></i>
                    <label for="stuLoginpass">Contraseña</label>
                    <input type="password" class="form-control"  id="stuLogpass" name="stuLogpass">
                  </div>
                  
                </div>
                <button type="button" class="btn btn-outline-success" id="stuLoginBtn" onclick="checkStuLogin()">Ingresar</button>
            </form>
            <small id="statusLogMsg"></small>
        </div>
        <div class="col-md-6 offset-md-1">
        <h5 class="mb-3">Usuario Nuevo || Registrate!</h5>
        <form id="stuRegForm">
        <div class="form-row">
            <div class="form-group col-md-6">
            <i class="fas fa-user icon" style="color: #8aa2ac;"></i>
            <label for="stuname">Nombre</label><br><small id="statudMsg1"></small>
            <input type="text" class="form-control" name="stuname" id="stuname">
            </div>
            <div class="form-group col-md-6">
            <i style="color: #8aa2ac;" class="fas fa-key icon"></i>
            <label for="inputAddress">Nueva contraseña</label><br><small id="statudMsg2"></small>
            <input type="password" class="form-control" id="stupass" name="stupass">
            </div>
        </div>
        <div class="form-group">
            <i style="color: #8aa2ac;" class="fas fa-envelope"></i>
            <label for="stuemail">E-mail</label><br><small id="statudMsg3"></small>
            <input type="email" class="form-control" name="stuemail" id="stuemail">
        </div>
        <button type="button" id="stusignup" onclick="addStu()" class="btn btn-outline-success">Registrame</button>
    </form>
    </div>
    </div>
    
</div>

<?php include('./contact.php'); ?> 
<div style="margin-top: 10%;"></div>

<!-- Start Including footer -->
<?php include('./Includes/footer.php') ?>
<!-- End Including footer -->