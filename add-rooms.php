<!-- This page makes it possible to add a room category  
	 Author: Danny van Schijndel
	 Date: 26-06-2020 -->
<?php 
include '../connect.php';
session_start();
?>
<?php 
// if(isset($add))
// {
	if(isset($_POST['add'])){
    
	// $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $room_no = !empty($_POST['room_no']) ? trim($_POST['room_no']) : null;
    $category_id = !empty($_POST['category_id']) ? trim($_POST['category_id']) : null;
	$price = !empty($_POST['price']) ? trim($_POST['price']) : null;
	$details = !empty($_POST['details']) ? trim($_POST['details']) : null;
    $category_name = !empty($_POST['category_name']) ? trim($_POST['category_name']) : null;

// Select from the category table
	$sql = $pdo->query("SELECT * FROM `category` WHERE 'category_id' = '$category_id'");
	
	if($sql->fetchColumn())    
	{
	echo "this room is already added";	
	}		
	else
	{	
		$sql = "INSERT INTO  category (category_name) VALUES (:category_name)";
		$data = $pdo->prepare($sql);
		
	// $img=$_FILES['img']['name'];
	$data->bindValue(':category_name', $category_id);
	$result = $data->execute();



// Select rooms table

	$sth = $pdo->query("SELECT * FROM  `rooms` WHERE 'room_no' = '$room_no'");
	$sth = "INSERT INTO rooms (room_no, price,category_id, details) VALUES (:room_no, :price,:category_id, :details)";
	$stmt = $pdo->prepare($sth);




	$stmt->bindValue(':room_no', $room_no);
    $stmt->bindValue(':category_id', $category_id);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':details', $details);
    
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
	
	if($result){

		header('location:rooms.php');


	}

	
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
<!-- Form for adding a new category -->
<form method="post" enctype="multipart/form-data">
<table class="table table-bordered">
<h1>Add A New Category</h1><hr>
	<tr>	
		<th>Room No</th>
		<td><input type="text" name="room_no"  class="form-control"/>
		</td>
	</tr>
	
	<tr>	
		<th>Room Type</th>
		<td><input type="text" name="category_id"  class="form-control"/>
		</td>
	</tr>
	
	<tr>	
		<th>Price</th>
		<td><input type="text" name="price"  class="form-control"/>
		</td>
	</tr>
	
	<tr>	
		<th>Details</th>
		<td><textarea name="details"  class="form-control"></textarea>
		</td>
	</tr>
	
	<tr>	
		<th>Images</th>
		<td><input type="file" name="img"  class="form-control"/>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<input type="submit" class="btn btn-primary" value="Add A New Category" name="add"/>
			<a href="../admin/rooms.php" class="btn btn-primary">Rooms page</a>
		</td>
	</tr>
</table> 
</form>