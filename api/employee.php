<?php


header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type,      Accept");
header('Content-Type:application/json');
// Initializeing
include_once('../core/initialize.php');

$data = json_decode(file_get_contents('php://input'), true);


$headers = getallheaders();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $data = json_decode(file_get_contents('php://input'), true);
    $activity_type = $data['activity'];
    if($activity_type=="REGISTER_EMPOLYEE"){
   
    if($gymownerId==TRUE){
        echo json_encode(array("message" => "Register new employee to list", "status" => true));

    }else{
        echo json_encode(array("message" => "Failed to register please try agin or contact service provider", "status" => false));

    }
}
}
?>