<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MBSchool</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;600&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: #181f20db;">
      <div class="container-fluid">

        <a class="navbar-brand" href="index.php"  style="display: inherit;">
        <img width="30px" src="./img/letter-m.svg" style="margin-right: -5px; position: relative;" />
        <img width="30px" src="./img/letter-b.svg" alt="" />
        </a>
        <span class="navbar-text">Aprende - Emprende</span>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <ul class="navbar-nav custom-nav">
            <li class="nav-item custom-nav-item"><a href="index.php " class="nav-link">Home</a></li>
            <li class="nav-item custom-nav-item"><a href="courses.php" class="nav-link">Cursos</a></li>
            <li class="nav-item custom-nav-item"><a href="paymentstatus.php" class="nav-link">Pago</a></li>
            <?php
            session_start();
            if (isset($_SESSION['is_login'])) {
              echo '
              <li class="nav-item custom-nav-item"><a href="./Students/studentProfile.php" class="nav-link">Perfil</a></li>
              <li class="nav-item custom-nav-item"><a href="logout.php" class="nav-link">Salir</a></li>
              ';
            }else{
              echo '
              <li class="nav-item custom-nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#LoginModal">Ingresar</a></li>
              <li class="nav-item custom-nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Registrarse</a></li>
              ';
            }
            ?>
            <li class="nav-item custom-nav-item"><a href="#testi" class="nav-link">Feedback</a></li>
            <li class="nav-item custom-nav-item"><a href="#Contact" class="nav-link">Contactenos</a></li>  
            </ul>
            <div id="wrap">
              <form  action="search.php" method="GET" autocomplete="on">
              <input id="search" name="search" type="text" placeholder="¿Que buscas?"><input id="search_submit" type="submit">
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </nav>
    <!-- end navigation -->