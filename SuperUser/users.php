 <?php 
session_start();
include_once '../inc/config.php';

if(!isset($_SESSION['admin']))
{
	header('Location: login.php');
	exit;
}

$result = mysqli_query($connect, "SELECT * FROM users"); 
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Administrator</title>
<?php include_once 'inc/header.php' ?>
					<li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="reservation.php"><span class="glyphicon glyphicon-plane"></span> Reservation List</a></li>
					<li><a href="catalogue.php"><span class="glyphicon glyphicon-cloud"></span> Cars Catalogue</a></li>
					<li class="active"><a href="users.php"><span class="glyphicon glyphicon-user"></span> User Information</a></li>
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
		User Information
	</div>
	<div class="panel-body">
		<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Full Name</th>
      <th>Address</th>
      <th>State</th>
	  <th>Postal Code</th>
	  <th>Phone</th>
	  <th>Email</th>
    </tr>
  </thead>
    <?php 
  while($users = mysqli_fetch_array($result))
  {
  ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $users['user_id'];?></th>
      <td><?php echo $users['name'];?></td>
      <td><?php echo $users['address'];?></td>
      <td><?php echo $users['state'];?></td>
	  <td><?php echo $users['zip'];?></td>
	  <td><?php echo $users['phone'];?></td>
	  <td><?php echo $users['email'];?></td>
    </tr>
  </tbody>
  <?php } ?>
</table>
	</div>
</div>
  		</div>
<?php include_once 'inc/footer.php'; ?>
  	