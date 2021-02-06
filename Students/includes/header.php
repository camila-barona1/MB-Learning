<?php

include('../dbConnection.php');

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['is_login'])) {
    $stuLogEmail = $_SESSION['stuLoginEmail'];
}

if (isset($stuLogEmail)) {
    $sql = "SELECT stu_img FROM student WHERE stu_email = '$stuLogEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stu_img =$row['stu_img'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/stustyle.css">


</head>
<body>
    
<div class="wrapper">
  <!-- Sidebar Holder -->
  <nav id="sidebar">
    <div class="sidebar-header">
    <a href="studentProfile.php">MB-SCHOOL
        <small class="text-white">Perfil</small>
        </a>
    </div>

    <ul class="list-unstyled components">
    
      <p class="text-center"><img width="180px" src="<?php echo ($stu_img=='') ? '../img/foto_sin_perfil.png' : $stu_img;  ?>" alt="" class="img-thumbnail rounded-circle"></p>
      <li>
        <a href="studentProfile.php" class="nav-link">&nbsp <i class="fas fa-user"></i> Perfil<span class="sr-only">(current)</span></a>
      </li>
      <li>
        <a href="myCourses.php" class="nav-link">&nbsp <i class="fas fa-folder-open"></i> Mis Cursos</a>
      </li>
      <li>
        <a href="stuFeedback.php">&nbsp <i class="fas fa-comments"></i> Feedback</a>
      </li>
      <li>
        <a href="stuChangePass.php">&nbsp <i class="fas fa-key"></i> Cambiar contraseña</a>
      </li>
      <li>
        <a href="../logout.php">&nbsp <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
      </li>
    </ul>

  </nav>