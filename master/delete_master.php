<?php 
include '../config.php';

if(isset($_POST['id'])){

    $deleteid = $_POST['id'];

    $sql = "DELETE FROM `personal_details` WHERE id = $deleteid";


    if ($conn->query($sql)) {

        echo json_encode(["status"=>true]);
        
    } else {
        echo json_encode(["status"=>false,"error"=>$conn->error]);
    }    
}

$conn->close();

?>