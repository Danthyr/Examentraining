<!-- 
Author: Danny van Schijndel
-->
<?php include "header/header.php"; 
  // error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <!-- naam project  -->
  <title>  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/styles.css">

  <script src="https://www.google.com/recaptcha/api.js"></script>
 
</head>

<body>
   <div class="content flexbox">
    <form name="inloggen" method="POST" enctype="multipart/form-data" action="">
      <p>Registreren</p>
      <input required type="text" name="name" placeholder="Naam">
      <input required type="text" name="username" placeholder="Gebruikersnaam">
      <input required type="email" name="email" placeholder="myname@mail.com">
      <input required type="password" name="password" placeholder="Wachtwoord">
      <input required type="password" name="passwordCheck" placeholder="Wachtwoord ter controle">


      <!-- Submit button -->
      <input type="submit" name="submit" value="SUBMIT">

      <a href="inloggen.php">Inloggen</a>

      <!-- <a href="wachtwoord_vergeten.php">wachtwoord vergeten</a> -->
    </form>

   </div>
   <?php
   include_once "connect.php";
        
   $db = new Connect();
   $db->myDb();
   

  //  kijkt of de bezoeker de submit knop heeft ingedrukt
   if (isset($_POST["submit"])) {
// kijkt of de velden email en password niet leg zijn 
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      
          $username = $_POST["username"];
          $email = $_POST["email"];
          $password = $_POST["password"];
          $hash = password_hash($password, PASSWORD_DEFAULT);
// stuur username, email en hash als parameters naar de insertData functie voor het aanmaken van een gebruiker
          $db->insertData($username,$email,$hash,"user");
                      
          header("location: inloggen.php");
        } elseif (empty($_POST['email']) && empty($_POST['password'])) { 
          echo('e-mail of password niet ingevuld .');

    }
    else{
      echo('fout bij het aanmaken van een gebruiker.');
    }
  }
  ?>
</body>
</html>