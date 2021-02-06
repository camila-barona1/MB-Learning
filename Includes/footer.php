    <!-- Start Footer -->
    <footer class=" bg-dark text-center p-2" style="position: absolute; left:0; width:100%;">
      <small class="text-white">Copyright &copy; 2021 || Designed By MB-Learning || <a href="#login" data-bs-toggle="modal" data-bs-target="#adminLoginModal"   >Admin Login</a> 
      </small>
    </footer>
    <!-- End Footer -->

    <!-- Start Student Registration Modal -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Registro Estudiantes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body form-students">
              <!-- start registration students -->
              <?php include('./studentRegistation.php'); ?>
              <!-- end registration students -->
            </div>
            
            <div class="modal-footer"><span id="sucessMsg"></span>
              <button type="button" id="stusignup" onclick="addStu()" class="btn btn-outline-success">Registrame</button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- End Student Registration Modal -->

    <!-- Start Student Login  Modal -->
      <!-- Modal -->
      <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="LoginModal">Ingreso Estudiantes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body form-students">
              <!-- start login students -->
              <form method="POST" id="stuLoginForm">
                <div class="form-row justify-content-center">
                  
                  <div  class="form-group col-md-7 align-self-center text-center">
                    <i class="fas fa-envelope icon"></i>
                    <label for="stuLogemail">E-mail</label>
                    <input type="email" class="form-control" name="stuLoginemail" id="stuLoginemail">
                  </div>
                  <div  class="form-group col-md-7 align-self-center text-center">
                    <i class="fas fa-key icon"></i>
                    <label for="stuLoginpass">Contraseña</label>
                    <input type="password" class="form-control"  id="stuLogpass" name="stuLogpass">
                  </div>
                </div>
            </form>
              <!-- end login students -->
            </div>
            <div class="modal-footer">
              <small id="statusLogMsg"></small>
              <button type="button" class="btn btn-outline-success" id="stuLoginBtn" onclick="checkStuLogin()">Ingresar</button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- End Student Login Modal -->

    <!-- Start Admin Login  Modal -->
      <!-- Modal -->
      <div class="modal fade" id="AdminLoginModal" tabindex="-1" aria-labelledby="AdminLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="AdminLoginModal">Ingreso Administradores</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body form-students">
              <!-- start login admin -->
              <form id="adminLoginForm">
                <div class="form-row justify-content-center">
                  <div  class="form-group col-md-7 align-self-center text-center">
                    <i class="fas fa-envelope icon"></i>
                    <label for="adminLogemail">E-mail</label>
                    <input type="email" class="form-control" name="adminLoginemail" id="adminLoginemail">
                  </div>
                  <div  class="form-group col-md-7 align-self-center text-center">
                    <i class="fas fa-key icon"></i>
                    <label for="adminLoginpass">Contraseña</label>
                    <input type="password" class="form-control"  id="adminpLogpass" name="adminpLogpass">
                  </div>
                </div>
            </form>
              <!-- end login admin -->
            </div>
            <div class="modal-footer">
            <small id="statusAdminLogMsg"></small>
              <button type="button" onclick="checkAmdinLogin()" class="btn btn-outline-success" id="adminLoginBtn">Ingresar</button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- End Admin Login Modal -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <!-- Font Awesomw JS -->
    <script src="js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>


    <!-- Student Testimial Owl Slider JS -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Student Ajax Call Javascript -->
    <script type="text/javascript" src="js/ajaxrequest.js"></script>
    <script type="text/javascript" src="js/adminajaxrequest.js"></script>

  </body>
</html>