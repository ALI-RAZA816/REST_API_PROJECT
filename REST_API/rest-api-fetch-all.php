<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    

    include "config.php";
    $query = "SELECT * FROM students";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data);
    }else{
        echo json_encode(array("message"=> "Not Found", "status"=> false));
    }


?>