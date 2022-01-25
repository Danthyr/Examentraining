<!-- 
	 Author: Danny van Schijndel
	 Date: 06-06-2020 -->
<?php

class Connect {

    protected $host;
    protected $dbname;
    protected $user;
    protected $pass;
    protected $charset = 'utf8mb4';
    protected $db;

    public function __construct()
    {
        $this->host = '127.0.0.1';
        $this->dbname= 'dbphilomena';
        $this->user = 'root';
        $this->pass = '';

        $this->db();
    }
    public function db()
    {
        try {

            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $this->db = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }

        } catch (\Connect $exception ) {

        }
    }

    public function myDb(){
        return $this->db;

    }
    
    public function insertData($voornaam,$achternaam,$straat,$postcode,$woonplaats,$email,$hash,$table){
          
     $sql = "INSERT INTO $table SET voornaam=:voornaam,achternaam=:achternaam,straat=:straat,postcode=:postcode,
     woonplaats=:woonplaats,email=:email,wachtwoord=:hash";
          
     $q = $this->db->prepare($sql);
          
     $q->execute(array(':voornaam'=>$voornaam,':achternaam'=>$achternaam,':straat'=>$straat,':postcode'=>$postcode,
     ':woonplaats'=>$woonplaats,':email'=>$email,':hash'=>$hash));
           
     return true;
           
    }  
    // public function insertDataEmployee($voornaam,$achternaam,$email,$hash,$table){
          
    //  $sql = "INSERT INTO $table SET voornaam=:voornaam,achternaam=:achternaam,email=:email,wachtwoord=:hash";
          
    //  $q = $this->db->prepare($sql);
          
    //  $q->execute(array(':voornaam'=>$voornaam,':achternaam'=>$achternaam,':email'=>$email,':hash'=>$hash));
           
    //  return true;
           
    // }  

    public function ReadCustomerEmail($email,$table){
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];

    $sql = "SELECT * FROM klant WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
    $wachtwoordDB = $result["wachtwoord"];
    
    if(password_verify($wachtwoord,$wachtwoordDB)){
        echo "<br>succesvolle login!";
        echo "<br>";
      
       
        $_SESSION["ID"] = session_id();
        $_SESSION["USER_ID"] = $result["ID"];
        $_SESSION["PERM"] = "Customer";
        $_SESSION["USER_NAME"] = $result["voornaam"];
        $_SESSION["E-MAIL"] = $result["email"];
        $_SESSION["STATUS"] = "ACTIEF";
        $_SESSION["ROL"] = 0;
    }else{
        echo "<br>Wachtwoord of e-mail komt niet overeen";
    }
  }           
}

public function ReadEmployeeEmail($email,$table){
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];

    $sql = "SELECT * FROM medewerker WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
    $wachtwoordDB = $result["wachtwoord"];
    
    if(password_verify($wachtwoord,$wachtwoordDB)){
        echo "<br>succesvolle login!";
        
       
        $_SESSION["ID"] = session_id();
        $_SESSION["USER_ID"] = $result["ID"];
        $_SESSION["PERM"] = "Employee";
        $_SESSION["USER_NAME"] = $result["voornaam"];
        $_SESSION["E-MAIL"] = $result["email"];
        $_SESSION["STATUS"] = "ACTIEF";
        $_SESSION["ROL"] = 1;
        
    }else{
        echo "<br>Wachtwoord of e-mail komt niet overeen";
    }
}

            
}
public function showDataEmployee($table1,$table2,$table3){
    
    $idDat= $_SESSION['USER_ID'];
     $sql="SELECT * FROM `$table1`as pt INNER JOIN `$table2` as pb ON pt.klantId = pb.ID  INNER JOIN `$table3` as pm
     ON pt.behandelingId = pm.ID WHERE pt.status = 'In afwachting' AND pt.medId = $idDat ";
     
     $q = $this->db->query($sql) or die("failed!");
     while($r = $q->fetch(PDO::FETCH_ASSOC)){
     $data[]=$r;
     }
     return $data;
     
      }
public function showDataEmployeeAcc($table1,$table2,$table3){
    
    $idDat= $_SESSION['USER_ID'];
     $sql="SELECT * FROM `$table1`as pt INNER JOIN `$table2` as pb ON pt.klantId = pb.ID  INNER JOIN `$table3` as pm
     ON pt.behandelingId = pm.ID WHERE pt.status = 'Geaccepteerd' AND pt.medId = $idDat ";
     
     $q = $this->db->query($sql) or die("failed!");
     while($r = $q->fetch(PDO::FETCH_ASSOC)){
     $data[]=$r;
     }
     return $data;
     
      }
public function showDataCustomer($table1,$table2,$table3){
    
    $idDat= $_SESSION['USER_ID'];

     $sql="SELECT * FROM `afspraak`as pt INNER JOIN `medewerker` as pb ON pt.medId = pb.ID INNER JOIN `behandeling` as pm 
     ON pt.behandelingId = pm.ID WHERE pt.klantId = $idDat";
     
     $q = $this->db->query($sql) or die("failed!");
     while($r = $q->fetch(PDO::FETCH_ASSOC)){
     $data[]=$r;
     }
     return $data;
     
      }
     
public function deleteData($ID,$table){
        
    $sql="DELETE FROM $table WHERE afspraakID=:ID";
    $q = $this->db->prepare($sql);
    $q->execute(array(':ID'=>$ID));
        
    return true;
        
}

public function updateStatus($ID,$table){
    $status = "Geaccepteerd" ;  
   
    $sql = "UPDATE $table SET Status = 'Geaccepteerd' WHERE afspraakID = :ID";
     $q = $this->db->prepare($sql);
     $q->execute(array(':ID'=>$ID));
     return true;
    
     }
public function showType($table1){
    
    $idDat= $_SESSION['USER_ID'];
        
    $sql="SELECT * FROM `$table1` Group by Type ";
             
    $q = $this->db->query($sql) or die("failed!");
    while($r = $q->fetch(PDO::FETCH_ASSOC)){
    $data[]=$r;
    }
    return $data;
             
}
public function readWhere($sql, $where = '', $join = ''){
    if($where != ''){
        $where = $where;
    }

    if($join != ''){
        $join = $join;
    }
    $stmt = $this->db->prepare($sql . $where . $join );
    $stmt->execute();
    // $user = $stmt->fetch();
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=$r;
        }
        return $data;
}
public function showCategorie($table1,$table2,$table3){
    
        
    $sql="SELECT * FROM `$table1` Where $table2 = '$table3' ";
             
    $q = $this->db->query($sql) or die("failed!");
    while($r = $q->fetch(PDO::FETCH_ASSOC)){
    $data[]=$r;
    }
    return $data;          
}
public function showPrice($table1){
    
    $idPrice= $_GET['var'];

     $sql="SELECT * FROM `$table1` WHERE ID = $idPrice";
     
     $q = $this->db->query($sql) or die("failed!");
     while($r = $q->fetch(PDO::FETCH_ASSOC)){
     $data[]=$r;
     }
     return $data;  
      }

public function insertAppointment($tijd,$datum,$status,$klantId,$medId,$behandelingId,$table){
          
     $sql = "INSERT INTO $table SET tijd=:tijd,datum=:datum,status=:status,klantId=:klantId,medId=:medId,behandelingId=:behandelingId";   
     $q = $this->db->prepare($sql);    
     $q->execute(array(':tijd'=>$tijd,':datum'=>$datum,':status'=>$status,':klantId'=>$klantId,':medId'=>$medId,':behandelingId'=>$behandelingId));
     return true;
          
    }        
    public function sendMail($email,$klantId){

        $sql = "SELECT * FROM afspraak WHERE datum
    BETWEEN DATE_SUB(NOW(),INTERVAL 1 DAY)";
    
    $q = $this->db->query($sql) or die("failed!");
     while($r = $q->fetch(PDO::FETCH_ASSOC)){
     $data[]=$r;
     }
     return $data;
     
      }

    //get info of user
    
    //send the email however yo  
}      

        


     
    


