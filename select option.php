<!-- 
	 Author: Danny van Schijndel
	  -->
      <?php include "header/header.php"; 
     
     ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="description" content="Webpage description goes here" />
<meta charset="utf-8">
<title>Medewerker urenregister</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="">
<link rel="stylesheet" href="css/form.css">
<link rel="stylesheet" href="css/styles.css">
<style>
    p{
        color:black;
    }
    </style>
</head>
<!-- form voor inloggen  -->
<div class="content-flexbox">
     <form name="inloggen" action="" method="POST" enctype="multipart/form-data" action="">
         <p>Begintijd invullen</p>
         <input required type="time" name="timestamp" value="" placeholder="timestamp"  min="09:00" max="18:00" >
         <br>
         <p>Eindtijd invullen</p>
         <input required type="time" name="timestampeind" value="" placeholder="timestamp"  min="10:00" max="19:00" >
         <br>
         <select name = 'subject[]' > 
         <?php
         
         $db->query("SELECT DISTINCT * FROM location Order BY description DESC "); 
        while($bod = $location->fetch(PDO::FETCH_ASSOC)) {
   
         
       echo "<option value='". $bod['id']  ."'>" .$bod['description'] . $bod['description']; 
       
        }
        ?>
         <input type="submit" name="submit" value="Registreren">

         <a href="registreren.php" >Registreren |</a>
          <!-- <a href="index.php">Wachtwoord vergeten</a> -->
         <!-- <a href="wachtwoord_vergeten.php"></a> -->
     </form>
     
 </div>
 
 <?php
    
//  error_reporting(0);
 include_once "connect.php";
 $db = new connect();
 $db->myDb();
// bezoeker klikt op de submit knop 
     if(isset($_POST["submit"])){
         // kijkt of de velden username en wachtwoord niet leg zijn 
        
         $melding = "";
         $timestampeind = ($_POST["timestampeind"]);
         $timestamp = ($_POST["timestamp"]);
         echo  $timestamp;
     
     try{
// stuur $username en $wachtwoord door naar de functie ReadCustomerEmail
         $db->insertEmployeeTime($timestampeind, $timestamp ,"time");
        
     }
    catch(PDOException $e){
         echo 'gebruikersnaam of wachtwoord komt niet overeen of is verkeerd ingevuld' . $e->getMessage();
     }
     echo"<br>";
     
 }
 ?>