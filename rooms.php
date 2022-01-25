<!-- This page gives an overview of all the rooms 
	 Author: Danny van Schijndel
	 Date: 26-06-2020 -->


<?php
include '../connect.php';
session_start();
?>

<script>
	//delete function from delete-room.php
	function delRoom(id)
	{
		if(confirm("You want to delete this Room ?"))
		{
		window.location.href='delete-room.php?id='+id;	
		}
	}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="../css/dashboard.css" rel="stylesheet">

	<title>Rooms page Hotel California</title>
</head>

	


<table class="table table-bordered table-striped table-hover">
	<h1>Room Details</h1><hr>
	<tr>
	<td colspan="8"><a href="../admin/add-rooms.php" class="btn btn-primary">Add A New Category</a> 
<!-- Show all information from the rooms table -->
	</tr>
	<tr style="height:40">
		<th>ID No</th>
		<th>Image</th>
		<th>Room No</th>
		<th>Type</th>
		<th>Price</th>
		<th>Details</th>
		<th>Update</th>
		<th>Delete</th>
	</tr>
	
<?php 
// Select and repeat all from the rooms table
$i=1;
$sth = $pdo->query("SELECT * from rooms ORDER BY category_id DESC");
while($res = $sth->fetch(PDO::FETCH_ASSOC))
{
$id=$res['room_id'];	
$img=$res['image'];
$path="../Assets/Images/rooms/$img";
?>
<tr>
		<td><?php echo $i;$i++; ?></td>
		<td><img src="<?php echo $path;?>" width="50" height="50"/></td>
		<td><?php echo $res['room_no']; ?></td>
		<td><?php echo $res['category_id']; ?></td>
		<td><?php echo $res['price']; ?></td>
		<td><?php echo $res['details']; ?></td>

		<td><a href="update-room.php?&id=<?php echo $id; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>

		<!-- <td><a href="dashboard.php?option=update_room&id=<?php echo $id; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		 -->
		<td><a href="#" onclick="delRoom('<?php echo $id; ?>')"><span class="glyphicon glyphicon-remove" style='color:red'></span></a></td>
	</tr>	
<?php 	
}
?>	
	
</table>
<table class="table table-bordered table-striped table-hover">
<tr>
<td colspan="8"><a href="../admin/admin.php" class="btn btn-primary">Admin page</a>
<button class="btn btn-primary" onclick="window.print()">Print this page</button>
</tr>