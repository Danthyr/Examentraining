<!-- This page allows the admin to update a room
	 Author: Danny van Schijndel
	 Date: 26-06-2020 -->



<?php

include '../connect.php';

session_start();

?>


<?php 
$id = $_GET['id'];

// select all from rooms
$sql = $pdo->query("SELECT * FROM `rooms`GROUP BY category_id DESC "); 


$sth = $pdo->query ("SELECT * FROM `rooms` WHERE `room_id` = '$id'"); 
$res = $sth->fetch(PDO::FETCH_ASSOC);

extract($_REQUEST);
   if(isset($update)) {


// update the rooms and get the input value from the form
$sth = "UPDATE rooms SET room_no=?, price=?, details=?, category_id=? WHERE room_id=$id";
$stmt= $pdo->prepare($sth);
$stmt->execute([$room_no, $price, $details, $category_id]);


if($stmt) {
    header('location:rooms.php');
    }

   
   
?> 	<?php
}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="../css/dashboard.css" rel="stylesheet">

	<title>Update room</title>
</head>
<form method="post" enctype="multipart/form-data">
<table class="table table-bordered">
<h1>Update Room Details</h1><hr>
	<tr>	
		<th>Room No</th>
		<td><input type="text"  name="room_no" id="room_no" value="<?php echo $res['room_no']; ?>"  class="form-control"/>
		</td>
	</tr>

<?php 


?>







<!-- update the rooms and send data to the insert function -->


	<tr>	
		<th>Price</th>
		<td><input type="text" name="price" id="type" value="<?php echo $res['price']; ?>" class="form-control"/>
		</td>
	</tr>
	
	<tr>	
		<th>Details</th>
		<td><textarea name="details" id="details" class="form-control"><?php echo $res['details']; ?></textarea>
		</td>
	</tr>

	


	<tr>
		<!-- Select a room category -->
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
  </tr>
  <tr>
		<td colspan="2">
			<input type="submit" class="btn btn-primary" value="Update Room Details" name="update"/>
			<a href="../admin/rooms.php" class="btn btn-primary">Rooms page</a>

		</td>
	</tr>
	
</table> 
</form>
