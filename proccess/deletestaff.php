<?php
require '../conn/conn.php';
if($_SERVER["REQUEST_METHOD"]=='GET'){
    $id = $_GET['id'];
    $sql = "DELETE FROM staff WHERE  staff_id=$id";
    if($conn->query($sql)){ 
        header("Location: ../staff.php");
    }else{
        echo "Error deleting record: " . $conn->error;
    }
}
