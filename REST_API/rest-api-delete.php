<?php 

    header("Content-Type: Application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods");

    $data = json_decode(file_get_contents("php://input"),true);
    $STUDENT_ID = $data['deleteId'];
    include "config.php";
    $query = "DELETE FROM students WHERE id = {$STUDENT_ID}";
    $result = mysqli_query($conn, $query);
    if($result){
        echo json_encode(array("message"=>"Record deleted successfully", "status"=> true));
    }else{
        echo json_encode(array("message"=>"Record can't be deleted", "status"=> false));
    }
?>