<!-- 
	 Author: Danny van Schijndel
	  -->
     <?php include "header/header.php"; 
            
    
    include_once "connect.php";
    $db = new connect();
    $db->myDb();


        ?>

    <?php


if(isset($_REQUEST['del_id'])){

if($db->deleteData($_REQUEST['del_id'],"afspraak")){
 
 echo"Your Data Successfully Deleted";

}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>Philomena</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <meta name="author" content="">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/styles.css">
 
</head>
<style>
html, body{
    background-color:white !important;
}

</style>
	


<table class="table table-bordered table-striped table-hover">
	<h1>Afspraak Details</h1><hr>
	<tr>
	<td colspan="12">
<!-- Show all information from the rooms table -->
	</tr>
	<tr style="height:40">
		<th>Nummer</th>
		<th>Afspraak Nummer</th>
		<th>Tijd</th>
		<th>Datum</th>
		<th>Voornaam</th>
		<th>Achternaam</th>
		<th>E-mail</th>
		<th>Status</th>
		<th>Type Dienst</th>
		<th>Naam Behandeling</th>
		<th>Verwijderen</th>
		<th>Verwijderen</th>
	
	</tr>
	
	<?php
$i=0;
$totaal=0;
 
 foreach($db->showDataCustomer("afspraak","klant","behandeling") as $value){
	$i;$i++;
  
 extract($value);
 $totaal = $aantal * $prijs;
 $totaalPrijs += $aantal * $prijs;
 echo <<<show
 
 <td>$i</td>
 <td>$afspraakID</td>
 <td>$tijd</td>
 <td>$datum</td>
 <td>$voornaam</td>
 <td>$achternaam</td>
 <td>$email</td>
 <td>$status</td>
 <td>$aantal</td>
 <td> $prijs</td>
  <td> $totaal    </td>
  
 
 <td>

</button>&nbsp;&nbsp;<button class="btn"><a href="test.php?del_id=$afspraakID">Verwijderen</a></button></td>
 </tr>
show;
 }

 ?>
<tr style="height:40">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Totaal prijs :</td>
		<td><?php echo $totaalPrijs ?></td>
		<td></td>
	</tr>


<?php


 ?>

</table>
<table class="table table-bordered table-striped table-hover">
<tr>
<td colspan="8"><a href="../dashboardCustomer/CustomerDashboard.php" class="btn btn-primary">Dashboard pagina</a>
<button class="btn btn-primary" onclick="window.print()">Print deze pagina</button>
</tr>