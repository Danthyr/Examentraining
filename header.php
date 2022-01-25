<!-- 
	 Author: Danny van Schijndel
-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">

    <?php

     session_start();
    error_reporting(0);
    ?>
    <?php
    
    // Toont aparte headers voor de admin, klant en de bezoeker 

            if(isset($_SESSION["ID"]) && $_SESSION["STATUS"] == "ACTIEF"){
                       if($_SESSION["ROL"] == 0){
                       ?>
    <a href="index.php">
      <img src="./assets/img/Logo.jpg" href="videos.php" height="90px" class="navbar-brand js-scroll-trigger"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">


      <?php 
                      
                   }else if($_SESSION["ROL"] == 1){
                   ?>
      <a href="videos.php">
        <img src="./assets/img/Logo.jpg" href="videos.php" height="90px" class="navbar-brand js-scroll-trigger"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php
                }
                      }
                      else{
                        ?>
        <a href="index.php">
          <img src="./assets/img/Logo.jpg" href="videos.php" height="90px" class="navbar-brand js-scroll-trigger"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
          data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <?php
                      }
                        ?>
          <?php
                   if(isset($_SESSION["ID"]) && $_SESSION["STATUS"] == "ACTIEF"){
                       if($_SESSION["ROL"] == 0){
                 ?>
          <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#download"></a></li> -->
            <button li class="nav-item"><a class="nav-link js-scroll-trigger" href="videos.php">Videos</a></li>
              <button class="nav-item"><a class="nav-link js-scroll-trigger" href="Logout.php">Uitloggen</a></li>
          </ul>
          <?php
                        
                    }else if($_SESSION["ROL"] == 1){
                        ?>
          <div class="navbar-nav">
            <button li class="nav-item"><a class="nav-link js-scroll-trigger" href="videos.php">Videos</a></li>
              <button class="nav-item"><a class="nav-link js-scroll-trigger" href="Logout.php">Uitloggen</a></li>
              </button>

              <div class="dropdown-nav">
                <button class="dropbtn">Beheer

                  <i class="fa fa-caret-down"></i>

                  <div class="dropdown-content">
                    <a href="overzicht.php">Overzicht</a>
                    <a href="toevoegen.php">Toevoegen</a>
                  </div>

                  </ul>
                  <?php
                       }
                      }
                      else{
                        ?>

                  <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#download"></a></li> -->
                    <button li class="nav-item"><a class="nav-link js-scroll-trigger" href="videos.php">Videos</a></li>

                      <button li class="nav-item"><a class="nav-link js-scroll-trigger" href="inloggen.php">Inloggen</a>
                        </li>
                      </button>

                      <div class="dropdown-nav">
                        <button class="dropbtn">Beheer

                          <i class="fa fa-caret-down"></i>

                          <div class="dropdown-content">
                            <a href="overzicht.php">Overzicht</a>
                            <a href="toevoegen.php">Toevoegen</a>
                          </div>


                  </ul>
                  <?php
                 }
                      ?>
              </div>
          </div>
</nav>
