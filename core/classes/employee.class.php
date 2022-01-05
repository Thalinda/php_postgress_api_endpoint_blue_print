<?php 

class Employee{
    private $connection;
    
 
    public function __construct($db)
    {
        $this->connection = $db;
        $this->CreateCustomerTable();

    }  

    public function CreateCustomerTable(){
       
        $var = "CREATE TABLE IF NOT EXISTS public.employees
        (
            emp_id bigserial NOT NULL,
            full_name text,
            dob date,
            sex integer,
            address text,
            current_address text,
            tele1 text,
            tele2 text,
            marital integer,
            nic text,
            moh text,
            phi text,
            police_station text,
            gm_wasama text,
            epf text,
            joined_date timestamp without time zone,
            state integer,
            user_id bigint NOT NULL,
            PRIMARY KEY (emp_id),
            CONSTRAINT user_id FOREIGN KEY (user_id)
                REFERENCES public.users (user_id) MATCH SIMPLE
                ON UPDATE NO ACTION
                ON DELETE NO ACTION
                NOT VALID
        );
        ";
        $stmt = $this->connection->prepare($var);
        $stmt->execute();
       

    }

    public function CustomerLogin($data,$encryption,$gymmanager){
        $var = "SELECT * FROM customers  WHERE contact = :conctact AND pwd = :pwd";
        $params = [$data['contact'],md5($data['pwd'])];
        $stmt = $this->connection->prepare($var);
        $stmt->execute($params);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
       
        if(sizeof($result)==1){
            $user_name = $result[0]['fname'];
            $token = $encryption->LoginUser($result[0]['cusid'],1);
            $gymid = $gymmanager->GetGymIdByUser($result[0]['cusid']);
                return json_encode(array(
                'state'=>true,
                "mesage_type"=>true,
                "message"=>"Login successfull",
                "data_set"=>array('token'=>$token,
                'user_name'=>$user_name,
                "gymid"=>sizeof($gymid)>0?$gymid[0]['gym_id']:null,
                "registerId"=>sizeof($gymid)>0?$gymid[0]['registerid']:null,
            )));

            
           
        }else{
            return json_encode(array('state'=>false,"mesage_type"=>0,"message"=>"User name or password is incorrect ","data_set"=>null));  
        }
        
    }

    public function RegisterCustomer($registering_object,$gymid=-999){  
        try {
            $ifalready = $this->CheckIfContactNumberIsIn($registering_object["phone"]);
            if(sizeof($ifalready)=="0"){
                $var = "INSERT INTO public.customers(
                    gymid, fname, lname, email, pwd, contact, usingapp, date)
                    VALUES (:gymid, :f_name, :l_name, :email, :pwd, :contact, :app,CURRENT_TIMESTAMP);";
            $params  = [
                ":gymid"=>$gymid,
                ":f_name"=>$registering_object["f_name"],
                ":l_name"=>$registering_object["l_name"],
                ":email"=>$registering_object["email"],
                ":pwd"=>md5($registering_object["pwd"]),
                "contact"=>$registering_object['phone'],
                "app"=>0
            ];
            
            $stmt = $this->connection->prepare($var);
            $state = $stmt->execute($params);
            return $this->connection->lastInsertId();
            }else{
                // return json_encode(array('state'=>false,"mesage_type"=>0,"message"=>"This email is already register","data_set"=>null));
                return -999;  //already exist
            }

        } catch (\Throwable $th) {
            throw $th;
            // return json_encode(array('state'=>false,"mesage_type"=>2,"message"=>$th,"data_set"=>null));
            return -998; //error  
        }
    }


    public function CheckIfContactNumberIsIn($contact){
        try {
            $var = "SELECT * FROM customers WHERE contact = :contact";
            $params  = [$contact];
            $stmt = $this->connection->prepare($var);
            $stmt->execute($params);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
    
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


}

?>