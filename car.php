<?php 
/*
* Display available car 
*/
session_start();
include_once 'inc/config.php';

$data = mysqli_query($connect, "SELECT * FROM cars WHERE car_id = '".$_GET['id']."'");
$car = mysqli_fetch_array($data);

if($car == 0)
{
	header('Location: 404.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - <?php echo $car['car_name']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center banner">
    <h1><div class="heads">Heaven Car Rental</div></h1>      
    <p class="heads">Fast, Smooth &amp; Affordable!</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="./images/logo.png" height="20"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if(isset($_SESSION['userID'])) { ?>
		<li><a href="#"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
		<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
		<?php } else { ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
        <li><a href="register.php"> Register</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
  <div class="text-center">
  <h1>Welcome to Heaven Car Rental</h1>
  <p>We provide you a various car to rent for your needs with affordable price!</p>
  </div><br>
   <div class="thumbnail">
                    <img class="img-responsive" src="./images/cars/<?php echo $car['image']; ?>" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right">RM<?php echo $car['rent_cost']; ?>/day</h4>
                        <h4><a href="#"><?php echo $car['car_name']; ?></a>
                        </h4>
                        <p>Car Type: <?php echo $car['car_type']; ?></p>
                        <p>Capacity: <?php echo $car['capacity']; ?></p>
						<p>Status: <?php echo $car['status']; ?></p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">3 reviews</p>
                        <p>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            4.0 stars
                        </p>
						<p>
						Choose start date:
						</p>
						<div class="text-right">
                        <a href="booking.php?id=<?php echo $car['car_id']; ?>" class="btn btn-success">Book now >></a>
                    </div>
                    </div>
                </div>
  </div>
</div><br>

<?php include_once 'inc/footer.php'; ?>