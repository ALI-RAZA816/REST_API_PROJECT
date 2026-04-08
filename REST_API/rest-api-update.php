<?php 

    header("Content-Type: Application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods");

    $data = json_decode(file_get_contents("php://input"),true);
    
    $editId = $data['id'];
    $name = $data['name'];
    $age = $data['age'];
    $city = $data['city'];
    
    include "config.php";
    $query = "UPDATE students SET student_name = '{$name}', age = '{$age}', city = '{$city}' WHERE id = {$editId}";
    $result = mysqli_query($conn, $query);
    if($result){
        echo json_encode(array("message"=>"Record updated successfully", "status"=> true));
    }else{
        echo json_encode(array("message"=>"Record can't updated", "status"=> false));
    }
?>