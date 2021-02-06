<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once('../dbConnection.php');

//Checking Email Already Registered
if (isset($_POST['checkemail']) && isset($_POST['stuemail'])) {
    $stuemail = $_POST['stuemail'];
    $sql = "SELECT stu_email FROM student WHERE stu_email = '".$stuemail."'";
    $result = $conn->query($sql);
    $row = $result->num_rows;
    echo json_encode($row); 
}

//Insert Student
if (isset($_POST['stusignup']) && isset($_POST['stuname']) && isset($_POST['stupass']) && isset($_POST['stuemail']) ) {

    $stuname = $_POST['stuname'];
    $stupass = $_POST['stupass'];
    $stuemail = $_POST['stuemail'];

    $sql = "INSERT INTO student(stu_name, stu_email, stu_pass) VALUES
    ('$stuname','$stuemail','$stupass')";

    if ($conn->query($sql) == true) {
        echo json_encode("Done");
    }else{
        echo json_encode("Failed");
    }
}


//Student Log in
if (!isset($_SESSION['is_login'])) {
 
    if (isset($_POST['checkLogEmail']) && isset($_POST['stulogEmail']) && isset($_POST['stuLogpass'])) {

        $stuLoginEmail = $_POST['stulogEmail'];
        $stuLoginPass = $_POST['stuLogpass'];

        $sql = "SELECT * FROM student WHERE stu_email = '".$stuLoginEmail."' AND stu_pass='".$stuLoginPass."'";

        $result = $conn->query($sql);
        $row = $result->num_rows;
        
        if ($row ===1) {
            $_SESSION['is_login'] = true;
            $_SESSION['stuLoginEmail'] = $stuLoginEmail;
            echo json_encode($row);
        }else if($row ===0){
            echo json_encode($row);
        }
    }
}