<?php 

include "../config.php";

if(isset($_POST['dependent']) && $_POST['dependent'] === "country"){

    $country_id = $_POST['country_id'];

    $sql = "SELECT * FROM states WHERE country_id = $country_id";
    $result = $conn->query($sql);

    $states = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $states[] = array(
                'id' => $row['id'],
                'name' => htmlspecialchars($row['state_name'])
            );
        }

        echo json_encode($states);
        
    } else {

        echo json_encode([]);
    }
}

if(isset($_POST['dependent']) && $_POST['dependent'] === "state"){

    $state_id = $_POST['state_id'];

    $sql = "SELECT * FROM cities WHERE state_id = $state_id";
    $result = $conn->query($sql);

    $citys = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $citys[] = array(
                'id' => $row['id'],
                'name' => htmlspecialchars($row['city_name'])
            );
        }

        echo json_encode($citys);
        
    } else {

        echo json_encode([]);
    }
}

$conn->close();

?>