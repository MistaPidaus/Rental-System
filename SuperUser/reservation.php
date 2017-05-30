<?php 
session_start();
include_once '../inc/config.php';

if(!isset($_SESSION['admin']))
{
	header('Location: login.php');
	exit;
}

$data = mysqli_query($connect, "SELECT * FROM rent");
$data2 = mysqli_query($connect, "SELECT r.*, c.car_id, c.car_name, u.user_id, u.name, u.state, u.address, u.zip, u.phone, u.email
FROM users u JOIN
     rent r
     ON u.user_id = r.user_id JOIN
     cars c
     ON c.car_id = r.car_id");

if(isset($_POST['assign']))
{
	$status = mysqli_real_escape_string($connect, $_POST['assign']);
	$rentID = mysqli_real_escape_string($connect, $_POST['rentID']);
	if(mysqli_query($connect, "UPDATE rent SET status='".$status."' WHERE rent_id='".$rentID."'"))
	{
		$success = "<div class='alert alert-success'><strong>Successfully Assigned Car!</strong></div>";
	}else{
		$errormsg = "<div class='alert alert-danger'>Error assigning the car.</div>";
	}
}
	 
?> 
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Administrator</title>
<?php include_once 'inc/header.php' ?>
					<li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li class="active"><a href="reservation.php"><span class="glyphicon glyphicon-plane"></span> Reservation List</a></li>
					<li><a href="catalogue.php"><span class="glyphicon glyphicon-cloud"></span> Cars Catalogue</a></li>
					<li><a href="users.php"><span class="glyphicon glyphicon-user"></span> User Information</a></li>
					<li><a href="about.php"><span class="glyphicon glyphicon-signal"></span> About</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Reservation List
	</div>
	<div class="panel-body">
	<?php if (isset($errormsg)) { echo $errormsg; } ?>
	<span class="text-success"><?php if (isset($success)) { echo $success; } ?></span>
		<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Full Name</th>
      <th>Address</th>
      <th>Phone</th>
	  <th>Email</th>
	  <th>Car</th>
	  <th>Rate Price</th>
	  <th>Hours</th>
	  <th>Total Amount</th>
	  <th>Status</th>
	  <th>Action</th>
    </tr>
  </thead>
    <?php 
  while($rsv = mysqli_fetch_array($data2))
  {
  ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $rsv['rent_id'];?></th>
      <td><?php echo $rsv['name'];?></td>
      <td><?php echo $rsv['address'];?>, <?php echo $rsv['state'];?>, <?php echo $rsv['zip'];?></td>
      <td><?php echo $rsv['phone'];?></td>
	  <td><?php echo $rsv['email'];?></td>
	  <td><?php echo $rsv['car_name'];?></td>
	  <td><?php echo $rsv['price'];?></td>
	  <td><?php echo $rsv['rent_tf'];?></td>
	  <td><?php echo $rsv['total'];?></td>
	  <td><?php echo $rsv['status'];?></td>
	  <td><form method="post" action="">
	  <input type="hidden" name="rentID" value="<?php echo $rsv['rent_id'];?>">
	  <?php if($rsv['status'] == "Pending") { ?>
		<button type="submit" name="assign" value="Success" class="btn btn-danger">Assigned Car</button>
		<?php } else { ?>
		<button type="button" class="btn btn-danger disabled">Assigned Car</button>
		<?php } ?>
		</form>
	  </td>
    </tr>
  </tbody>
  <?php } ?>
</table>
	</div>
</div>
  		</div>
<?php include_once 'inc/footer.php'; ?>
  	