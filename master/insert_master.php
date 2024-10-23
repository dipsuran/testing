<?php 

include "../config.php";

if(isset($_POST)){

    $id = $_POST['id'];
    $Country = $_POST['country'];
    $State = $_POST['state'];
    $City = $_POST['city'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO `personal_details`(`id`, `Country`, `State`, `City`,`name`,`phone`,`gender`) VALUES ('$id','$Country','$State','$City','$name','$phone','$gender')";


    if ($conn->query($sql)) {

        echo json_encode(["status"=>true]);
        
    } else {
        echo json_encode(["status"=>false,"error"=>$conn->error]);
    }    
}

$conn->close();

?>