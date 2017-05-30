 <?php 
session_start();
include_once '../inc/config.php';

if(!isset($_SESSION['admin']))
{
	header('Location: login.php');
	exit;
}

$result = mysqli_query($connect, "SELECT * FROM cars"); 
$result2 = mysqli_query($connect, "SELECT * FROM cars"); 
$result3 = mysqli_query($connect, "SELECT * FROM cars"); 

if(isset($_POST['insert'])) 
{
	$cname = mysqli_real_escape_string($connect, $_POST['cname']);
	$ccost = mysqli_real_escape_string($connect, $_POST['ccost']);
	$ctype = mysqli_real_escape_string($connect, $_POST['ctype']);
	$ccapa = mysqli_real_escape_string($connect, $_POST['ccapa']);
	$cstatus = mysqli_real_escape_string($connect, $_POST['cstatus']);
	
	$target_dir = "../images/cars/";
	$target_file = $target_dir . basename($_FILES["imageup"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk = 1;
	
	if ($_FILES["imageup"]["size"] > 500000) {
    $errormsg = "<div class='alert alert-danger'>Sorry your file is too large.</div>";
	$uploadOk = 0;
	}
	
	if (file_exists($target_file)) {
    $errormsg = "<div class='alert alert-danger'>Error, File already exists!</div>";
    $uploadOk = 0;
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $errormsg = "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
	}
	
	if ($uploadOk == 0) {
		$err = "<div class='alert alert-danger'>Sorry, your file was not uploaded.</div>";
	// if everything is ok, try to upload file
	}else {	
		if(move_uploaded_file($_FILES["imageup"]["tmp_name"], $target_file)) {
			if(mysqli_query($connect, "INSERT INTO cars(car_name, car_type, image, rent_cost, capacity, status) VALUES
			('".$cname."', '".$ctype."', '". basename( $_FILES["imageup"]["name"]). "', '".$ccost."', '".$ccapa."', '".$cstatus."')")){
				$success = "<div class='alert alert-success'><strong>Successfully Inserted!</strong></div>";
			}else{
				$errormsg = "<div class='alert alert-danger'>Error inserting item.</div>";
			}
		}
	}
}

if(isset($_POST['update']))
{
	$upname = mysqli_real_escape_string($connect, $_POST['upcarname']);
	$uprent = mysqli_real_escape_string($connect, $_POST['uprent']);
	$uptype = mysqli_real_escape_string($connect, $_POST['upcartype']);
	$upcapa = mysqli_real_escape_string($connect, $_POST['upcarcap']);
	$upstat = mysqli_real_escape_string($connect, $_POST['upcarstat']);
	$updatec = mysqli_real_escape_string($connect, $_POST['listcar']);
	
	$target_dir = "../images/cars/";
	$target_file = $target_dir . basename($_FILES["imageup2"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk = 1;
	
	if ($_FILES["imageup2"]["size"] > 500000) {
    $errormsg = "<div class='alert alert-danger'>Sorry your file is too large.</div>";
	$uploadOk = 0;
	}
	
	if (file_exists($target_file)) {
    $errormsg = "<div class='alert alert-danger'>Error, File already exists!</div>";
    $uploadOk = 0;
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $errormsg = "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
	}
	
	if ($uploadOk == 0) {
		$err = "<div class='alert alert-danger'>Sorry, your file was not uploaded.</div>";
	// if everything is ok, try to upload file
	}else {	
		if(move_uploaded_file($_FILES["imageup2"]["tmp_name"], $target_file)) {
			if(mysqli_query($connect, "UPDATE cars SET car_name='".$upname."', car_type='".$uptype."', image='". basename( $_FILES["imageup2"]["name"]). "', rent_cost='".$uprent."', capacity='".$upcapa."', status='".$upstat."' WHERE car_id='".$updatec."'"))
			{
				$success = "<div class='alert alert-success'><strong>Successfully Updated Item!</strong></div>";
			}else{
				$errormsg = "<div class='alert alert-danger'>Error updating the item.</div>";
			}
		}
	}
}	
	
if(isset($_POST['delete']))
{
	$deletec = mysqli_real_escape_string($connect, $_POST['delcar']);
	if(mysqli_query($connect, "DELETE FROM cars WHERE car_id='".$deletec."'"))
	{
		$success = "<div class='alert alert-success'><strong>Successfully Deleted!</strong></div>";
	}else{
		$errormsg = "<div class='alert alert-danger'>Error deleting the item.</div>";
	}
}
	
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Administrator</title>
<?php include_once 'inc/header.php' ?>
					<li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="reservation.php"><span class="glyphicon glyphicon-plane"></span> Reservation List</a></li>
					<li class="active"><a href="catalogue.php"><span class="glyphicon glyphicon-cloud"></span> Cars Catalogue</a></li>
					<li><a href="users.php"><span class="glyphicon glyphicon-user"></span> User Information</a></li>
					<!-- Dropdown-->
					<li><a href="about.php"><span class="glyphicon glyphicon-signal"></span> About</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>

<div class="col-md-10 content">
  	<div class="panel panel-default">
		<div class="panel-heading">
		Modify an item
		</div>
		<div class="panel-body">
		<?php if (isset($err)) { echo $err; } ?>
	<?php if (isset($errormsg)) { echo $errormsg; } ?>
	<span class="text-success"><?php if (isset($success)) { echo $success; } ?></span>

  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#update">Update</button>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#insert">Insert</button>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#delete">Delete</button>
  <div id="update" class="collapse">
  </br>
    <form enctype="multipart/form-data" action="" method="post" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Update an Item</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Select an existing item</label>
  <div class="col-md-4">
    <select id="selectbasic" name="listcar" class="form-control">
      <?php
		while($update = mysqli_fetch_array($result2)) { ?>
      <option value="<?php echo $update['car_id']; ?>"><?php echo $update['car_name']; ?></option>
	 <?php } ?> 
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">New Car Name</label>  
  <div class="col-md-4">
  <input id="textinput" name="upcarname" type="text" placeholder="Enter car name.." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">New Rent Cost</label>  
  <div class="col-md-4">
  <input id="textinput" name="uprent" type="number" placeholder="Enter rent cost.." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">New Car Type</label>  
  <div class="col-md-4">
  <input id="textinput" name="upcartype" type="text" placeholder="Enter car type.." class="form-control input-md" required="">
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">New Image File</label>
  <div class="col-md-4">
    <input id="filebutton" name="imageup2" class="input-file" type="file">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">New Capacity</label>  
  <div class="col-md-4">
  <input id="textinput" name="upcarcap" type="number" placeholder="Enter car capacity.." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Status</label>
  <div class="col-md-4">
    <select id="selectbasic" name="upcarstat" class="form-control">
      <option value="Available">Available</option>
      <option value="Not Available">Not Available</option>
    </select>
  </div>
</div>
 
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="update" class="btn btn-success">Update</button>
  </div>
</div>

</fieldset>
</form>

	
  </div>
  <div id="insert" class="collapse">
    </br>
	<form enctype="multipart/form-data" class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Insert an Item</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Car Name</label>  
  <div class="col-md-4">
  <input id="textinput" name="cname" type="text" placeholder="Enter car name.." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Rent Cost</label>  
  <div class="col-md-4">
  <input id="textinput" name="ccost" type="number" placeholder="Enter rent cost.." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Car Type</label>  
  <div class="col-md-4">
  <input id="textinput" name="ctype" type="text" placeholder="Enter car type.." class="form-control input-md" required="">
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">Image File</label>
  <div class="col-md-4">
    <input id="filebutton" name="imageup" class="input-file" type="file">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Capacity</label>  
  <div class="col-md-4">
  <input id="textinput" name="ccapa" type="number" placeholder="Enter car capacity.." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Status</label>
  <div class="col-md-4">
    <select id="selectbasic" name="cstatus" class="form-control">
      <option value="Available">Available</option>
      <option value="Not Avaialble">Not Available</option>
    </select>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="insert" class="btn btn-success">Insert</button>
  </div>
</div>

</fieldset>
</form>

  </div>
  <div id="delete" class="collapse">
  </br>
    <form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Delete an Item</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Status</label>
  <div class="col-md-4">
    <select id="selectbasic" name="delcar" class="form-control">
	<?php
	while($delete = mysqli_fetch_array($result3)) { ?>
      <option value="<?php echo $delete['car_id']; ?>"><?php echo $delete['car_name']; ?></option>
	 <?php } ?> 
    </select>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" type="submit" name="delete" class="btn btn-success">Delete</button>
  </div>
</div>

</fieldset>
</form>

  </div>
</div>
</div>
	
		
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Car Catalogue
	</div>
	<div class="panel-body">
		<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Car Name</th>
      <th>Car Type</th>
      <th>Image</th>
	  <th>Rent Cost</th>
	  <th>Capacity</th>
	  <th>Status</th>
    </tr>
  </thead>
    <?php 
  while($cars = mysqli_fetch_array($result))
  {
  ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $cars['car_id'];?></th>
      <td><?php echo $cars['car_name'];?></td>
      <td><?php echo $cars['car_type'];?></td>
      <td><img src="../images/cars/<?php echo $cars['image']; ?>" style="height: 100px; width: 200px;" alt="cars"></td>
	  <td><?php echo $cars['rent_cost'];?></td>
	  <td><?php echo $cars['capacity'];?></td>
	  <td><?php echo $cars['status'];?></td>
    </tr>
  </tbody>
  <?php } ?>
</table>
	</div>
</div>
  		</div>
<?php include_once 'inc/footer.php'; ?>
  	