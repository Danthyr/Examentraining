<!-- 
	 Author: Danny van Schijndel
	 Date: 06-06-2020 -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Danny van Schijndel" />
        <title>Philomena</title>
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
     
        <!-- Navigation-->
        <?php include "header/header.php"; 
        include_once "connect.php";
        ?>

        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-7 my-auto">
                        <div class="header-content mx-auto">
                            <h1 class="mb-5">Haar & Nagels studio Philomena</h1>
                            <p1 class="mb-5">Philomena, de beste nagel/haar studio van Rotterdam, is het adres voor hoge kwaliteit service. </p1>
                            <br></br>
                            <p1 class="mb-5">Verzorgde handen met mooie en vakkundig verzorgde nagels zijn een belangrijk onderdeel van uw persoonlijkheid! En daarom zorgen wij voor het beste resultaat.</p1>
                            
                        </div>
                    </div>
                    <div class="col-lg-5 my-auto">
                        <div class="device-wrapper">
                     <?php
                        if(isset($_SESSION["ID"]) && $_SESSION["STATUS"] == "ACTIEF"){
                       if($_SESSION["ROL"] == 0){
                     ?>
                     <div class="appointment-button">
                     <a href='afspraak.php'><button>Afspraak maken</button></a>             
                      <?php    
                    }else if($_SESSION["ROL"] == 1){
                        ?>
                            <div class="appointment-button">
                            <a href='afspraak.php'><button>Afspraak maken </button></a>
                            </div>
                       <?php
                    }
                      }
                      else{
                        ?>
                        <div class="appointment-button">
                                <button onclick="window.location.href='inloggen.php';">Afspraak Maken </button>
                            </div>
                 <?php
                 }
                 ?>
                            <div class="email-button">
                                <button  onclick="window.location.href='contact.php';">E-mail </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
   
        <section class="features" id="features">
            <div class="container">
                <div class="section-heading text-center">
                    <h2>De beste Haar/Nagel studio van Nederland</h2>
                    <p class="text-muted"></p>
                    <hr />
                </div>
                <div class="row">
                    
                    <div class="col-lg-8 my-auto">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="feature-item">
                                        <i class="icon-screen-smartphone1" ></i>
                                        <img src="assets/img/hairdresser.png" alt="Trulli" width="100" height="100">
                                        <h3>Heren</h3>
                                        <p class="text-muted">Vanzelfsprekend zijn ook de heren van harte welkom in Philomena's haarsalon. Heren kunnen dus ook bij ons terecht in de kapsalon om geknipt te worden.
                                         Bent u druk en heeft u weinig tijd om even te wachten? Maak dan eerst een afspraak.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="feature-item">
                                        <i class="icon-camera1"></i>
                                        <img src="assets/img/nail.png" alt="Trulli" width="100" height="100">
                                        <h3>Dames</h3>
                                        <p class="text-muted">Philomena's haarsalon is een gezellige kapsalon voor dames. Wij 
                                        nemen de tijd om tot een mooi resultaat te komen dat voldoet aan al uw verwachtingen.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="feature-item">
                                        <i class="icon-present1"></i>
                                        <img src="assets/img/hair.png" alt="Trulli" width="100" height="100">
                                        <h3>Nagels</h3>
                                        <p class="text-muted">Onze behandelingen zijn erop gericht je eigen schoonheid te benadrukken. Een team van verschillende professionele ervaren specialisten en 
                                        nagelstylisten staan voor je klaar om te behandelen waar jij het nodig vindt.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="feature-item">
                                        <i class="icon-lock-open1"></i>
                                        <img src="assets/img/beauty.png" alt="Trulli" width="100" height="100">
                                        <h3>Wie zijn wij?</h3>
                                        <p class="text-muted">Philomena’s haarsalon, is vernoemd naar de eigenaar van de kapsalon waar hij alweer ruim vijf jaar de zaak runt. Vaste klanten weten het allang. Philomena’s haarsalon is het adres voor mensen die kiezen voor de combinatie van vakkkundigheid, 
                                        stijl en maximale persoonlijke aandacht.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta">
            <div class="cta-content">
                <div class="container">
                    <h2>
                       
                        <br />
                        Plan uw afspraak online.
                    </h2>
                    <?php
                        if(isset($_SESSION["ID"]) && $_SESSION["STATUS"] == "ACTIEF"){
                       if($_SESSION["ROL"] == 0){
                     ?>
                      <a class="btn btn-outline-light py-3 px-4 rounded-pill js-scroll-trigger" href="afspraak.php">Klik hier!</a>            
                      <?php    
                    }else if($_SESSION["ROL"] == 1){
                        ?>
                            <a class="btn btn-outline-light py-3 px-4 rounded-pill js-scroll-trigger" href="afspraak.php">Klik hier!</a>
                       <?php
                    }
                      }
                      else{
                        ?>
                         <a class="btn btn-outline-light py-3 px-4 rounded-pill js-scroll-trigger" href="inloggen.php">Klik hier!</a>
                 <?php
                 }
                 ?>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        
        <footer>
            <div class="container">
                <p>&copy; Philomena 2021. All Rights Reserved.</p>
                
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
