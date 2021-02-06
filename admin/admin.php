<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../dbConnection.php');

//Admin login Verification
if (!isset($_SESSION['is_admin_login'])) {
    if (isset($_POST['checkLogEmail']) && isset($_POST['adminLoginemail']) && isset($_POST['adminpLogpass'])) {

    $adminLoginemail = $_POST['adminLoginemail'];
    $adminpLogpass = $_POST['adminpLogpass'];

    $sql = "SELECT * FROM admin WHERE admin_email = '".$adminLoginemail."' AND admin_pass='".$adminpLogpass."'";

    $result = $conn->query($sql);
    $row = $result->num_rows;
    if ($row ===1) {
        $_SESSION['is_admin_login'] = true;
        $_SESSION['adminLoginemail'] = $adminLoginemail;
        echo json_encode($row);
    }else if($row ===0){
        echo json_encode($row);
    }
    }
}