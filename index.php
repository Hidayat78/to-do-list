<?php

session_start();
date_default_timezone_set('asia/calcutta');
if(isset($_POST['add'])){
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['task'])){
		$_POST['date'] = date('D-M-Y', time());
		$_SESSION['Task'][time().uniqid()] = $_POST;
		
	}
}

// delete
if(isset($_POST['delete'])){
    $x = $_POST['delete'];
    unset($_SESSION['Task'][$x]); 
    // echo "<h1>$x</h1>";
}

// update
if(isset($_POST['update'])){
	$_SESSION['update_key'] = $_POST['update'];
	
	echo "<form action='' method='POST'>
	<input type='text' name='name' placeholder='Enter name'><br>
	<input type='email' name='email' placeholder='Enter email'><br>
	<input type='task' name='task' placeholder='Enter name'><br>
	<input type='submit' name='update_task' value='Update Task'><br>
	</form>";


  
    
}

if(isset($_POST['update_task'])){
	$updatekey = $_SESSION['update_key'];
    $_POST['date'] = date('D-M-Y', time());
    $name = $_POST['name'];
    $email = $_POST['email'];
    $task = $_POST['task'];
    $date = $_POST['date'];
    $storeTask = compact('name', 'email', 'task', 'date');
	
	$_SESSION['Task'][$updatekey] = $storeTask;


}    

if(isset($_SESSION['Task'])){
	if(!empty($_SESSION['Task'])){
		echo "<table class='mt-table'>
		<tr>
		<th>Name</td>
		<th>Email</td>
		<th>Task</td>
		<th>Date</td>
		</tr>";
		foreach ($_SESSION['Task'] as $key => $value) {
              echo "<tr>";
			foreach ($value as $key1 => $value1) {
				if($key1 == 'add'){
					continue;
				}
	             		echo "<td>$value1</td>";

				}
				echo "<td>
				<form acton='' method='POST'>
			    <button type='submit' value='$key' name='delete'>Delete</button> 
			    <button type='submit' value='$key' name='update'>Update</button> 
				</form>
				</td>";
				echo "</tr>";
			}

			echo "</table>";
		}
	}






 /*echo "<pre>";
 print_r($_POST);
 echo "</pre>";


 echo "session";
 echo "<pre>";
 print_r($_SESSION);
 echo "</pre>";
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		.mt-table th,td{
			border: 1px solid black;

		}
		.mt-table{
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<form action="" method="POST">
		<table>
			<tr>
				<td><input type="text" name="name" id="" placeholder="Name"></td>
			</tr>
			<tr>
				<td><input type="email" name="email" id="" placeholder="email"></td>
			</tr>
			<tr>
				<td><input type="task" name="task" id="" placeholder="task"></td>
			</tr>
			<tr>
				<td><input type="submit" name="add" value="Add" id=""></td>
			</tr>
		</table>
	</form>
</body>
</html>