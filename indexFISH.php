<!-- 
	 Author: Danny van Schijndel
	-->
     <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Danny van Schijndel" />
        <title>Netfish</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet" />
        <!-- Plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/html5-device-mockups/3.2.1/dist/device-mockups.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head> 
    <body id="page-top">
     <Style>
header.masthead .header-content p1 {
font-size: 16px;
}
.column {
float: left;
width: 100%;
padding: 5px;
}
img {
   
margin-left: 20px;
}

</style>
      
        <?php 
        include_once "connect.php";
        include "header/header.php"; 
        error_reporting(0);
       
          
  
    $db = new connect();
    $db->myDb();
    // als de gebruiker is ingelogd kan een video worden afgespeeld en als de bezoeker niet is ingelogd dan wordt hij/zij doorverwezen naar de inlog pagina
    if(isset($_SESSION["ROL"])){
    
    $_SESSION["video"]= $_GET["video"];
        ?>

        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-7 my-auto">
                        <div class="header-content mx-auto">
                            <?php

    if(!isset($_GET["video"])){
         // Toont de Titel , beschrijving en jaar 
    foreach($db->showMovieHomepage("movie") as $value){
    
         extract($value);
    echo <<<show
    <div class="containerLeft">
   
    <h1 class="mb-4">$title </h1>
    <td> $year </a> </td>
    <br>
    </br>
    <p1 class="mb-4">$description  </p1>
   
    </div>
   
    </tr>
    
   show;
}

?>

    </div>
       </div>
          <div class="col-lg-5 my-auto">
             <div class="device-wrapper">
              
              <?php
//  vertoont de video 
foreach($db->showMovieHomepage("movie") as $value){
    
    extract($value);
    echo <<<show
    <div class="containerLeft">
    
    <video width="150%" height="200%" controls>
    <source src="$url" type="video/mp4"  </a> 
    
    </div>
   
    </tr>
    
   show;
}
}
?> 




   <?php
     // Toont de Titel , beschrijving en jaar 
    if(isset($_GET["video"])){
    foreach($db->showMovieid("movie") as $value){
    
         extract($value);
    echo <<<show
    <div class="containerLeft">
   
    <h1 class="mb-4">$title </h1>
    <td> $year </a> </td>
    <br>
    </br>
    <p1 class="mb-4">$description  </p1>
   
    </div>
   
    </tr>
    
   show;
}

?>

    </div>
       </div>
          <div class="col-lg-5 my-auto">
             <div class="device-wrapper">
              
              <?php

    //  vertoont de video 
foreach($db->showMovieid("movie") as $value){
    
    extract($value);
    echo <<<show
    <div class="containerLeft">
    
    <video width="150%" height="200%" controls>
    <source src="$url" type="video/mp4"  </a> 
    
    </div>
   
    </tr>
    
   show;
}
}

?> 
  
                            
                            </div>
                            </div>
                            <div class="column">

<?php
// vertoont de afbeelding
foreach($db->showMovie("movie") as $value){
    extract($value);
    echo <<<show
   
      <a href="videos.php?video=$id"> <img src="$image" height="150px" width="125px"  </a>  
   
    
   show;
}
      
}
else{
    $_SESSION["video"]= $_GET["video"];
    ?>

    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-7 my-auto">
                    <div class="header-content mx-auto">
                        <?php
 // Toont de Titel , beschrijving en jaar   // 
if(!isset($_GET["video"])){
foreach($db->showMovieHomepage("movie") as $value){

     extract($value);
echo <<<show
<div class="containerLeft">

<h1 class="mb-4">$title </h1>
<td> $year </a> </td>
<br>
</br>
<p1 class="mb-4">$description  </p1>

</div>

</tr>

show;
}

?>

</div>
   </div>
      <div class="col-lg-5 my-auto">
         <div class="device-wrapper">
          
          <?php
    //  vertoont de video 
foreach($db->showMovieHomepage("movie") as $value){

extract($value);
echo <<<show
<div class="containerLeft">
<a href="inloggen.php"> 
<video width="150%" height="200%" controls>
<source src="$url" type="video/mp4"  </a> 
 </a>  

</div>

</tr>

show;
}
}
?> 




                        <?php
if(isset($_GET["video"])){
     // Toont de Titel , beschrijving en jaar 
foreach($db->showMovieid("movie") as $value){

     extract($value);
echo <<<show
<div class="containerLeft">

<h1 class="mb-4">$title </h1>
<td> $year </a> </td>
<br>
</br>
<p1 class="mb-4">$description  </p1>

</div>

</tr>

show;
}

?>

</div>
   </div>
      <div class="col-lg-5 my-auto">
         <div class="device-wrapper">
          
          <?php
         //  vertoont de video 

foreach($db->showMovieid("movie") as $value){

extract($value);
echo <<<show
<div class="containerLeft">
<a href="inloggen.php"> 
<video width="150%" height="200%" controls>
<source src="$url" type="video/mp4"  </a> 

</div>

</tr>

show;
}
}

?> 

                        
    </div>
    </div>
   <div class="column">

<?php
// vertoont de afbeelding

foreach($db->showMovie("movie") as $value){
extract($value);
echo <<<show

  <a href="inloggen.php"> <img src="$image" height="150px" width="125px"  </a>  


show;
}
  
}
                 ?>
             </div>
              </div>
               </div>
                </div>
                 </header>
        <footer>
            <div class="container">
                <p>&copy; Netfish 2021. All Rights Reserved.</p>
                
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <!-- Custom scripts for this template-->
        <script src="js/scripts.js"></script>
    </body>
</html>
