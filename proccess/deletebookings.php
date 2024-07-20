<?php
require '../conn/conn.php';
if($_SERVER["REQUEST_METHOD"]=='GET'){
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE  booking_id=$id";
    if($conn->query($sql)){ 
        header("Location: ../index.php");
    }else{
        echo "Error deleting record: " . $conn->error;
    }
}
