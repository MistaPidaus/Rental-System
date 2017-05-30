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
					<li class="active"><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="reservation.php"><span class="glyphicon glyphicon-plane"></span> Reservation List</a></li>
					<li><a href="catalogue.php"><span class="glyphicon glyphicon-cloud"></span> Cars Catalogue</a></li>
					<li><a href="users.php"><span class="glyphicon glyphicon-user"></span> User Information</a></li>
					<!-- Dropdown-->
					<li><a href="about.php"><span class="glyphicon glyphicon-signal"></span> About</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>
  		<div class="col-md-10 content">
		<div class="alert alert-info" role="alert">
  Welcome to Administrator Panel, <strong><?php echo $_SESSION['admin_name']; ?></strong>!
</div>
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Dashboard
	</div>
	<div class="panel-body">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
</div>
  		</div>
  		<?php include_once 'inc/footer.php'; ?>
  	</div>