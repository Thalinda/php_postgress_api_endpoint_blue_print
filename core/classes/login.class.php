<?php 
use Firebase\JWT\JWT;
class Login{
    public function ToeknValidator($headers){
       return $this->Validate($headers);
    }

    private function Validate($headers){
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            try {
            $decoded = JWT::decode($matches[1], KEY, array('HS256'));
            $now = time(); // or your date as wellS
            $token_created_on = $decoded->created_on;
            $your_date = strtotime($token_created_on);
            $datediff = ($now - $your_date) / (60 * 60 * 24);
            if($datediff<15){
                return array('state'=>true,'reason'=>$decoded);;
            }else{
                return array('state'=>false,'reason'=>'Token Expired'); 
            }
            } catch (\Throwable $th) {
                echo $th;
                return array('state'=>false,'reason'=>'Tampering with User Token');;
                
            }
        }else{
            echo "Error auth";
            return array('state'=>false,'reason'=>'Error in auth taking');
        }
    }


    public function LoginUser($user_id,$usertype){
      
        $now = date("Y/m/d");
        if($usertype==1){
            $payload = array(
                "witchuser"=>$usertype,
                "user_id" => $user_id,
                "created_on" => $now,
            );
        }else{
            $payload = array(
                "witchuser"=>$usertype,
                "user_id" => $user_id,
                "created_on" => $now,
            );
        }
        
        $jwt = JWT::encode($payload, KEY);
        return $jwt;
       
    }

}



?>