<?php 
session_start();
include_once '../inc/config.php';

if(!isset($_SESSION['admin']))
{
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Administrator</title>
<?php include_once 'inc/header.php'; ?>
					<li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="reservation.php"><span class="glyphicon glyphicon-plane"></span> Reservation List</a></li>
					<li><a href="catalogue.php"><span class="glyphicon glyphicon-cloud"></span> Cars Catalogue</a></li>
					<li><a href="users.php"><span class="glyphicon glyphicon-user"></span> User Information</a></li>
					<!-- Dropdown-->
					<li class="active"><a href="about.php"><span class="glyphicon glyphicon-signal"></span> About</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Dashboard
	</div>
	<div class="panel-body">
		Welcome to Rental Car System!
		</br>
		System proudly developed by <strong>Pidaus</strong>
	</div>
</div>
  		</div>
  		<?php include_once 'inc/footer.php'; ?>
  	</div>