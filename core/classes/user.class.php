
<?php 

class Users{
    private $connection;
    
 
    public function __construct($db)
    {
    
        $this->connection = $db;
        $this->CreateUserTable();

    }  

    public function CreateUserTable(){
       
        try {
            $var = "CREATE TABLE IF NOT EXISTS public.users
        (
            user_id bigserial NOT NULL,
            first_name text NOT NULL,
            last_name text NOT NULL,
            email text NOT NULL,
            password text NOT NULL,
            contact text NOT NULL,
            state boolean NOT NULL,
            date timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (user_id)
        )";
        $stmt = $this->connection->prepare($var);
        $stmt->execute();
        } catch (\Throwable $th) {
            print_r($th);
            throw $th;
        }
       

    }

    public function RegisterUser($data){
      
       if($this->CheckIFUserAlreadyIn($data['email']) == 0){
        $insertstatment  ="INSERT INTO public.users(
             first_name, last_name, email, password, contact, state, date)
            VALUES ( ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP);";
        $params = [$data['fname'],$data['lname'],$data['email'],md5($data['pwd']),$data['contact'],1];
        $stmt = $this->connection->prepare($insertstatment);
        $stmt->execute($params);
        // return ;
        return json_encode(array('state'=>true,"mesage_type"=>true,"message"=>"Registation Successfull please loging using info","data_set"=>array('user'=>$this->connection->lastInsertId())));

       }else{
     
        return -999;	
       }
    }

    public function UserLogin($data,$encryption){
        $var = "SELECT * FROM users  WHERE email = :email AND password = :pwd";
        $params = [$data['email'],md5($data['pwd'])];
        $stmt = $this->connection->prepare($var);
        $stmt->execute($params);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
       
        if(sizeof($result)==1){
            $user_name = $result[0]['first_name'];
            $full_name = $user_name." ".$result[0]['last_name'];
            $token = $encryption->LoginUser($result[0]['user_id'],2);
            return json_encode(array('state'=>true,"mesage_type"=>true,"message"=>"Login successfull","data_set"=>array('token'=>$token,'user'=>$result[0]['user_id'],'name'=>$full_name)));
        }else{
            return json_encode(array('state'=>false,"mesage_type"=>0,"message"=>"User name or password is incorrect ","data_set"=>null));  
        }
        
    }

    public function CheckIFUserAlreadyIn($email){

      
            try {
                $var = "SELECT * FROM users WHERE email = ?";
                $params  = [$email];
                $stmt = $this->connection->prepare($var);
                $stmt->execute($params);
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return sizeof($result);
        
            } catch (\Throwable $th) {
                //throw $th;
            }
        
    }


}
    ?>


