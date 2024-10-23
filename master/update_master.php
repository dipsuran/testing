<?php 
include "../config.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $Country = $_POST['country'];
    $State = $_POST['state'];
    $City = $_POST['city'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $sql = "UPDATE personal_details SET Country = '$Country', State = '$State', City = '$City', name = '$name', phone = '$phone', gender = '$gender' WHERE id = $id;";

    if ($conn->query($sql)) {

        echo json_encode(["status"=>true]);
        
    } else {
        echo json_encode(["status"=>false,"error"=>$conn->error]);
    }    
}

$conn->close();

?>