<?php 
     error_reporting(E_ALL);
     ini_set("display_errors", 1);

     if($_SERVER['HTTP_HOST'] == 'localhost')
{

     try {
          $db_user = "postgres";
     $db_passowrd = "";
     $db_name = "";
     $db = new PDO('pgsql:host=localhost;port=5432;dbname=dbname;',$db_user,$db_passowrd);
     } catch (\Throwable $th) {
          throw $th;
     }
}else{
     $db_user = "qrztaiuxvtutjd";
     $db_passowrd = "";
     $db_name = "dbtbteirann3ca";
     $db = new PDO('pgsql:host=ec2-34-195-69-118.com;dbname='.$db_name.';',$db_user,$db_passowrd);

}
     

     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
     $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
     $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

     define('JKi Holdings','Jki HOldings Human Resource Managent System');


     // git rebase -i 9947bcf6fdbbcc2ac9dbf08138e64bb809b5b320 -x "git commit --amend --author 'Thalinda Bandara <thalinda.bandara@qualitapps.com>' -CHEAD"
?>