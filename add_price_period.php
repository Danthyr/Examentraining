<!-- This page allows the front-desk to add a price period
	 Author: Danny van Schijndel
	 Date: 26-06-2020 -->
<?php 
include '../connect.php';
session_start();
?>
<?php 

	
		
	// Select all from price period

    $sql = $pdo->query("SELECT * FROM `price_period` GROUP BY category_id DESC  ");
	if(isset($_POST['add'])){
    
		
		$category_id = !empty($_POST['category_id']) ? trim($_POST['category_id']) : null;
		$price_period_start = !empty($_POST['price_period_start']) ? trim($_POST['price_period_start']) : null;
		$price_period_end = !empty($_POST['price_period_end']) ? trim($_POST['price_period_end']) : null;
		$season_price = !empty($_POST['season_price']) ? trim($_POST['season_price']) : null;
	
// Select all from price period
		$sth = $pdo->query("SELECT * FROM  `price_period` WHERE 'category_id' = '$category_id'");
// Insert into price period and add a price
	$sth = "INSERT INTO price_period (category_id, price_period_start,price_period_end, season_price) VALUES (:category_id, :price_period_start,:price_period_end, :season_price)";
	// move_uploaded_file($_FILES['img']['tmp_name'],"../Assets/Images/rooms".$_FILES['img']['name']);
	$stmt = $pdo->prepare($sth);




	$stmt->bindValue(':category_id', $category_id);
    $stmt->bindValue(':price_period_start', $price_period_start);
    $stmt->bindValue(':price_period_end', $price_period_end);
    $stmt->bindValue(':season_price', $season_price);
    
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
	
	if($result){

		header('location:room-prices.php');


	}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="../css/dashboard.css" rel="stylesheet">

	<title>Add rooms</title>
</head>
<form method="post" enctype="multipart/form-data">
<table class="table table-bordered">
<h1>Add A New Price Period</h1><hr>
	
	
<tr>
	<!-- Select a category type -->
<th>Category</th>
<td> 	
	<select name="category_id" id="category_id" >
    <option  name="category_id" id="category_id" disabled selected>-- Select Category --</option>
    <?php

 		while($res = $sql->fetch(PDO::FETCH_ASSOC)) {

			
		echo "<option value='". $res['category_id'] ."'>" .$res['category_id'] ."</option>" ; 
		 
	
         
         
        }
        
    ?>  

  </select></th>

  <!-- Input for adding a price period -->
  </tr>
	
	<tr>	
		<th>Price</th>
		<td><input type="text" name="season_price"  class="form-control"/>
		</td>
	</tr>
	
	<tr>	
		<th>Start Date</th>
		<td> <input type="date" name="price_period_start" class="form-control"required>
		</td>
	</tr>
	
	<tr>	
		<th>End Date</th>
		<td><input type="date" name="price_period_end" class="form-control"required>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<input type="submit" class="btn btn-primary" value="Add A New Price Period" name="add"/>
			<a href="../front-desk/room-prices.php" class="btn btn-primary">Room Prices page</a>
		</td>
	</tr>
</table> 
</form>
