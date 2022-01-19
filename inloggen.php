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
  <title>Philomena</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/styles.css">
 
</head>
<!-- form voor inloggen  -->
<div class="content flexbox">
        <form name="inloggen" action="" method="POST" enctype="multipart/form-data" action="">
            <p>Inloggen</p>
            <input required type="text" name="username" value="" placeholder="gebruikersnaam">
            <input required type="password" name="wachtwoord" value="" placeholder="wachtwoord">
            <input type="submit" name="submit" value="Login">

            <a href="registreren.php" >Registreren |</a>
            <a href="index.php">Wachtwoord vergeten</a>
            <!-- <a href="wachtwoord_vergeten.php"></a> -->
        </form>
        
    </div>
    
    <?php
       
    error_reporting(0);
    include_once "connect.php";
    $db = new connect();
    $db->myDb();
// bezoeker klikt op de submit knop 
        if(isset($_POST["submit"])){
            // kijkt of de velden username en wachtwoord niet leg zijn 
            if (!empty($_POST['username']) && !empty($_POST['wachtwoord'])) {
            $melding = "";
            $username = htmlspecialchars($_POST["username"]);
            $wachtwoord = htmlspecialchars($_POST["wachtwoord"]);
        }
        try{
// stuur $username en $wachtwoord door naar de functie ReadCustomerEmail
            $db->ReadCustomerEmail($username,"user");
           
        }
       catch(PDOException $e){
            echo 'gebruikersnaam of wachtwoord komt niet overeen of is verkeerd ingevuld' . $e->getMessage();
        }
        echo"<br>";
        
    }
    ?>
