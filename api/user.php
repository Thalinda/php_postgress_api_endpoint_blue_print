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
    if($activity_type=="REGISTER_USER"){
        // echo "Came Calling";
       echo  $usermanager->RegisterUser($data);
}else if($activity_type=="USER_LOGIN"){
    echo $usermanager->UserLogin($data,$LoginObject);
}
}
?>