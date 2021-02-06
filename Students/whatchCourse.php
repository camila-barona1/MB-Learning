<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLoginEmail'];
}else{
    echo "<script> location.href='../index.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wath Course</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;600&display=swap" rel="stylesheet">
    <style>
    *{
        font-family: "Quicksand", sans-serif;    }
    </style>

</head>
<body>
    
    <div class="container-fluid bg-light p-2">
        <h3>Bienvenido a MB-Learning</h3>
        <div style="
        float: right;
    width: 39px;
    height: 37px;
    margin-top: -40px;
    padding: 6px;
    box-shadow: -2px 3px 5px 0px #a2a2a2;
    background: #ebecec4a;
    border-radius: 50%;
    margin-right: 15px;
">
<a href="./myCourses.php"><i class="fas fa-arrow-alt-circle-left" style="
           color: #857c95;
    width: 28px;
    margin-top: -1px;
    height: 26px;
    "></i></a>

        
        </div>
       
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 border-right">
                <h4 class="text-center mt-3">LESIONES</h4>
                <ul id="playlist" class="nav flex-column">
                <?php
                if (isset($_GET['course_id'])) {
                    $course_id = $_GET['course_id'];
                    $sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="nav-item border-bottom py-2" movieurl='.$row['lesson_link'].' style="cursor:pointer;">'.$row['lesson_name'].'</li>';
                        }
                    }
                } 
                ?>
                
                </ul>
            <div class="mt-5 text-center">
            
            </div>
                
            </div>
            
            <div class="col-sm-9 text-center">
                <video src="" class="mt-5 w-75 ml-2" id="videroarea" controls>
                </video>
        
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/custom.js"></script>
    
    </body>
</html>