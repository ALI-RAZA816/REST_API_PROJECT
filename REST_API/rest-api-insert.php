<?php 

    header("Content-Type: Application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods");

    $data = json_decode(file_get_contents("php://input"),true);
    
    $name = $data['name'];
    $age = $data['age'];
    $city = $data['city'];
    
    include "config.php";
    $query = "INSERT INTO students (student_name, age, city) VALUES('{$name}','{$age}', '${city}')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo json_encode(array("message"=>"Record inserted successfully", "status"=> true));
    }else{
        echo json_encode(array("message"=>"Record can't be inserted", "status"=> false));
    }
?>