<?php 
session_start();

if(isset($_SESSION['admin'])) {
	session_destroy();
	unset($_SESSION['admin']);
	$success = "<div class='panel panel-info'><div class='panel-heading'><div class='panel-title'>You have successfully logout. Redirecting..</div></div></div>";
} else {
	header("Location: index.php");
	exit;
}
//nanti implement design cakap dah logout
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Register Admin Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="3;url=index.php"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $(function () {
  	$('.navbar-toggle-sidebar').click(function () {
  		$('.navbar-nav').toggleClass('slide-in');
  		$('.side-body').toggleClass('body-slide-in');
  		$('#search').removeClass('in').addClass('collapse').slideUp(200);
  	});

  	$('#search-trigger').click(function () {
  		$('.navbar-nav').removeClass('slide-in');
  		$('.side-body').removeClass('body-slide-in');
  		$('.search-input').focus();
  	});
  });
  </script>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a class="navbar-brand" href="#">
				Heaven Car Rental - Administrator
			</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		</div><!-- /.container-fluid -->
	</nav>  	
<br>

<div class="container">                      
    <?php echo $success; ?>
</div>                     

<?php include_once '../inc/footer.php' ?>
