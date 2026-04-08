<?php 

    header("Content-Type: Applicatin/json");
    header("Access-Control-Allow-Method: *");

    $data = json_decode(file_get_contents("php://input"),true);
    $STUDENT_ID = $data['sid'];
    
    include "config.php";
    $query = "SELECT * FROM  students WHERE id = {$STUDENT_ID}";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);
    }else{
        echo json_encode(array("message"=> "Record Not Found", "status"=> false));
    }



?>