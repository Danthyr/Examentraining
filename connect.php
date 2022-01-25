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
public function updateData($table1,$table2,$table3){
    
    $idDat= $_SESSION['update_id'];

     $sql="SELECT * FROM `afspraak`as pt INNER JOIN `medewerker` as pb ON pt.medId = pb.ID INNER JOIN `behandeling` as pm 
     ON pt.behandelingId = pm.ID WHERE pt.afspraakID = $idDat";
     
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
    public function uploadVideo($titel,$description,$year,$table){
   
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submitVideo"])) {
          $check = getimagesize($_FILES["url"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 1;
          }
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          
          // Check file size
          if ($_FILES["url"]["size"] > 55555555555500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
           // Allow certain file formats
           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "mp4" && $imageFileType != "mov" && $imageFileType != "jpeg"
           && $imageFileType != "gif" ) {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             $uploadOk = 0;
           }
         
          
          
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["url"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["url"]["name"])). " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
    
          $url ="uploads/" . basename($_FILES["url"]["name"]);
         
    
          
    
    
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submitVideo"])) {
          $check = getimagesize($_FILES["image"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          
          // Check file size
          if ($_FILES["image"]["size"] > 99923239500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "mp4" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }
        
          
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
    
          $url ="uploads/" . basename($_FILES["url"]["name"]);
          $image ="uploads/" . basename($_FILES["image"]["name"]);
         
    
          $sql = "INSERT INTO $table SET title=:titel,description=:description,year=:year, url=:url, image=:image";
          
          $q = $this->db->prepare($sql);
               
          $q->execute(array(':titel'=>$titel,':description'=>$description,':year'=>$year ,':url'=>$url, ':image'=>$image));
                
          return true;
       
          }
          // toont alle films op titel
        public function showMovie($table){
              
            $sql="SELECT * FROM `$table` Group by title ";
                     
            $q = $this->db->query($sql) or die("failed!");
            while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
            }
            return $data;
            
          
            }
            // Toont de film avengers als de eerste trailer op de landingspagina 
        public function showMovieHomepage($table){
              
            $sql="SELECT * FROM `$table` Where title = 'Avengers' Group by title ";
                     
            $q = $this->db->query($sql) or die("failed!");
            while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
            }
            return $data;
            
          
            }
            //  verwijdert een film met het $id die wordt doorgestuurd via de parameter van de functie 
        public function DeleteMovie($id,$table){
              
              $sql="DELETE FROM $table WHERE id=:id";
              $q = $this->db->prepare($sql);
              $q->execute(array(':id'=>$id));
          
          
              return true;
          
             }
            // vervangt de film avengers uit de functie showMovieHomepage via een $_GET en een $_SESSION
        public function showMovieid($table){
              
          $id = $_SESSION["video"];
        $sql="SELECT * FROM `$table` WHERE id = $id";
                       
        $q = $this->db->query($sql) or die("failed!");
        while($r = $q->fetch(PDO::FETCH_ASSOC)){
        $data[]=$r;
        }
        return $data;
              
            
        }
        public function showBrand($table1){
        
            $sql="SELECT * FROM `$table1` Group by name ";
                     
            $q = $this->db->query($sql) or die("failed!");
            while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
            }
            return $data;
            }
            
                    
            public function showModel($table1,$table2){
                    
                $idDat = $_SESSION["idDat"];
            
            $sql="SELECT * FROM $table1 as pt INNER JOIN $table2 as pb ON pt.id = pb.brand_id WHERE pt.name = '$idDat'";
                     
            $q = $this->db->query($sql) or die("failed!");
            while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
            }
            return $data;
            }
            public function showSize($table1,$table2){
                    
                $idMod = $_SESSION["idMod"];
            
            $sql="SELECT * FROM $table1 as pt INNER JOIN $table2 as pb ON pt.id = pb.model_id WHERE pt.name = '$idMod'";
                     
            $q = $this->db->query($sql) or die("failed!");
            while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
            }
            return $data;
            }
            public function AddShoes($name,$modelData,$sizeData,$table,$table2,$table3){

                $sql = "INSERT INTO $table (name) VALUES (:name)";
                $q = $this->db->prepare($sql);    
                $q->bindValue(":name" ,$name);
                $result = $q->execute();
            
                $bsql = "INSERT INTO $table2 (brand_id,name) VALUES (LAST_INSERT_ID(),:name)";
                $b = $this->db->prepare($bsql); 
                $b->bindValue(":name" ,$modelData);
                $result = $b->execute();
            
                $ssql = "INSERT INTO $table3 (model_id,size) VALUES (LAST_INSERT_ID(),:name)";
                $s = $this->db->prepare($ssql); 
                $s->bindValue(":name" ,$sizeData);
                $result = $s->execute();
            
                return true;
            
               }
                  
                public function showModelDel($table1,$table2){
                        
                    $idDat = $_SESSION["idDat"];
                
                $sql="SELECT * FROM $table1 as pt INNER JOIN $table2 as pb ON pt.id = pb.brand_id WHERE pb.brand_id = '$idDat'";
                         
                $q = $this->db->query($sql) or die("failed!");
                while($r = $q->fetch(PDO::FETCH_ASSOC)){
                $data[]=$r;
                }
                return $data;
                }
            
                public function showSizeDel($table1){
                        
                    $idModel = $_SESSION["idMod"];
                
                $sql="SELECT * FROM $table1 WHERE id = '$idModel'";
                         
                $q = $this->db->query($sql) or die("failed!");
                while($r = $q->fetch(PDO::FETCH_ASSOC)){
                $data[]=$r;
                }
                return $data;
                }
                     
               public function DeleteSize($idModel,$table){
                $idSize = $_SESSION["idSize"];
               
                
                $sql="DELETE FROM $table WHERE model_id=:model";
                $q = $this->db->prepare($sql);
                $q->execute(array(':model'=>$idModel));
            
            
                return true;
            
               }
               public function DeleteModel($idModel,$table){
               
                $idModel = $_SESSION["idMod"];
               
            
                $msql="DELETE FROM $table WHERE id=:brand";
                $m = $this->db->prepare($msql);
                $m->execute(array(':brand'=>$idModel));
                    
            
                return true;
            
               }
               public function DeleteBrand($id,$table){
               
                $id = $_SESSION["idDat"];
                
            
                $bsql="DELETE FROM $table WHERE id=:id";
                $b = $this->db->prepare($bsql);
                $b->execute(array(':id'=>$id));
            
                return true;
            
               }
               public function updateSize($size,$table){
                $sizeUpdate = $_SESSION["idSize"];  
               
                $sql = "UPDATE $table SET size = :size WHERE model_id = $sizeUpdate";
                 $q = $this->db->prepare($sql);
                 $q->execute(array(':size'=>$size));
                 return true;
                
            }  
               public function updateModel($model,$table){
                $modelUpdate = $_SESSION["idMod"];  
               
                $sql = "UPDATE $table SET name = :name WHERE id = $modelUpdate";
                 $q = $this->db->prepare($sql);
                 $q->execute(array(':name'=>$model));
                 return true;
                
            }  
               public function updateBrand($brand,$table){
                $brandUpdate =  $_SESSION["idDat"];  
               
                $sql = "UPDATE $table SET name = :name WHERE id = $brandUpdate";
                 $q = $this->db->prepare($sql);
                 $q->execute(array(':name'=>$brand));
                 return true;
                
            }  
            
    }
    
   

        


     
    


