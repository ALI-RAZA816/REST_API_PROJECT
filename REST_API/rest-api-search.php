<?php
    header("Content-Type: Application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Methods");

    $SEARCH_TERM = isset($_GET['search']) ? $_GET['search'] : die();
    include "config.php";

    $query = "SELECT * FROM students WHERE student_name LIKE '%{$SEARCH_TERM}%'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);
    }else{
        echo json_encode(array("message"=>"No Record Found", "status"=>false));
    }
?>