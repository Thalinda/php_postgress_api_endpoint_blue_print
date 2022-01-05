
    <?php



error_reporting(E_ALL);
     ini_set("display_errors", 1);


    defined('DS') ? null:define('DS',DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null:define("SITE_ROOT",'../');
	defined('KEY')?null:define('KEY','example_key');
    defined("INC_PATH")?null:define('INC_PATH',SITE_ROOT.DS.'includes');
    defined("CORE_PATH")?null:define('CORE_PATH',SITE_ROOT.DS.'core');
	defined("ASSETS")?null:define("ASSETS",SITE_ROOT.DS.'assets');
    defined("CLASS_PATH")?null:define('CLASS_PATH',CORE_PATH.DS."classes");
	require_once(ASSETS.DS."jwt".DS.'JWT.php');
    require_once(INC_PATH.DS."config.php");
	

	

// 	$key = "example_key";
// $payload = array(
//     "user_id" => "http://example.org",
//     "account_type" => "http://example.com",
//     "created_on" => 1356999524
// );

// $jwt = JWT::encode($payload, $key);
// $decoded = JWT::decode($jwt, $key, array('HS256'));

// print_r($jwt);

$response['status'] = 404;
$response['data'] = NULL;
// Initializeing
function deliver_response($response){
	// Define HTTP responses
	$http_response_code = array(
		100 => 'Continue',  
		101 => 'Switching Protocols',  
		200 => 'OK',
		201 => 'Created',  
		202 => 'Accepted',  
		203 => 'Non-Authoritative Information',  
		204 => 'No Content',  
		205 => 'Reset Content',  
		206 => 'Partial Content',  
		300 => 'Multiple Choices',  
		301 => 'Moved Permanently',  
		302 => 'Found',  
		303 => 'See Other',  
		304 => 'Not Modified',  
		305 => 'Use Proxy',  
		306 => '(Unused)',  
		307 => 'Temporary Redirect',  
		400 => 'Bad Request',  
		401 => 'Unauthorized',  
		402 => 'Payment Required',  
		403 => 'Forbidden',  
		404 => 'Not Found',  
		405 => 'Method Not Allowed',  
		406 => 'Not Acceptable',  
		407 => 'Proxy Authentication Required',  
		408 => 'Request Timeout',  
		409 => 'Conflict',  
		410 => 'Gone',  
		411 => 'Length Required',  
		412 => 'Precondition Failed',  
		413 => 'Request Entity Too Large',  
		414 => 'Request-URI Too Long',  
		415 => 'Unsupported Media Type',  
		416 => 'Requested Range Not Satisfiable',  
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',  
		501 => 'Not Implemented',  
		502 => 'Bad Gateway',  
		503 => 'Service Unavailable',  
		504 => 'Gateway Timeout',  
		505 => 'HTTP Version Not Supported'
		);

	// Set HTTP Response
	header('HTTP/1.1 '.$response['status'].' '.$http_response_code[ $response['status'] ]);
	// Set HTTP Response Content Type
	header('Content-Type: application/json; charset=utf-8');
	// Format data into a JSON response
	$json_response = json_encode(array('data'=>$response['data']));
	// Deliver formatted data
	echo $json_response;

	exit;
}

// echo (CLASS_PATH.DS);
	require_once(CLASS_PATH.DS."login.class.php");
	require_once(CLASS_PATH.DS."employee.class.php");
	require_once(CLASS_PATH.DS."user.class.php");
	
	

	$LoginObject = new Login();
	$usermanager = new Users($db);
	$employeemanager = new Employee($db);
	// $customermanager = new CustomerManager($db);
	// $gymamanger=new GymManager($db);
	// $schedulemanager = new ScheduleManager($db);
	// $excersicemanager = new ExcerciseManager($db);
	// $memebershipmanager = 	new MemberShipManager($db);


	
	
	
	



	
	
	
?>