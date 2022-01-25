<!-- 
	 Author: Danny van Schijndel
	 Date: 06-06-2020 -->

   <?php
session_start();
include_once "connect.php";
   $db = new Connect();
   $db->myDb();

?>
<?php
 
 ?>
<html lang="en">
  <head>
     <title>Employee Bigfoot</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="../css/dashboard.css" rel="stylesheet">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    @media (min-width: 1200px){
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9 {

 float: none;
}
   
}
input{
  width:40%;
  margin:10 auto;
}
.main {
    padding: 0px;
}
@media (min-width: 992px){
.col-md-offset-2 {
    margin-left: 0%;
}
}
#updateDiv {
height:100%;

}
#text-input{
margin-left:15%;

}
.form-control{
  width:70%;
}
.col-lg-7{
  margin:0 auto;
}
  </style>
  </head>
  <body>
    <!-- navigation menu -->
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="dashboard.php?option=admin_profile">Profile</a></li> -->
            <li><a href="../index.php">Home</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
           
           <!-- <li><a href="EmployeeUpdateShoes.php">Update Shoes</a></li>
           <li><a href="EmployeeAddShoes.php">Add Shoes</a></li>
           <li><a href="EmployeeDeleteShoes.php">Delete Shoes</a></li> -->
     
         </ul>
          </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
        </div>
  
      <div id="ContentUpdate">
      <div id="ContentTitleUpdate">
      <p> Update Shoes </p>
      </div> 
       
      <div id="UpdateDiv">


        
                <div class="row h-100">
                    <div class="col-lg-7 my-auto">
                    <h2>Update</h2>
                     
                        <div class="index-content">
                        <form method="POST">
                   
                        <?php    
                        
                   
                              
                            ?>
                            
                        </div>
                    </div>
          
                    <?php
      
      $_GET['update_id'];
      echo $_GET['update_id'];
      $_SESSION['update_id'] = $_GET['update_id'];
      
      echo  $_SESSION['update_id'];
      foreach( $db->updateData("afspraak","klant","behandeling")as $value);
      extract($value);
       ?>  
    <tr>	
      <div id="text-input">
      <th>Brand</th>
    </div>
    <td><input type="text" name="brand" id="type" value="<?php echo  $datum; ?>" class="form-control"/>
		</td>
      <div id="text-input">
      <th>Model</th>
    </div>
		<td><input type="text" name="model" id="type" value="<?php echo $tijd; ?>" class="form-control"/>
		</td>
      <div id="text-input">
      <th>Size</th>
    </div>
    <td><input type="text" name="size" id="type" value="<?php echo $size; ?>" class="form-control"/>

		</td>
	</tr>
  <div id="text-input">
  <input type="submit" name="submit" value="UPDATE ">
	</div>
    
<?php

      if (isset($_POST["submit"])) {
        
        $size = $_POST['datum'];
        $model = $_POST['tijd'];
       

        $db->updateSize($size,"size");
        $db->updateModel($model,"model");
        $db->updateBrand($brand,"brand");

        if ($db) {
          header("location: EmployeeUpdateShoes.php");
         
          exit;
        }
        else{
          
        }
      }
        ?>





      </div>
 
    
		


</div>    </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
 
</html>
<?php



?>
</body>
</html>