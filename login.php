<?php 
include_once 'inc/config.php';
session_start();

if(isset($_SESSION['userID'])!= ""){
	header("Location: index.php");
	exit;
}

//check if form submitted
if(isset($_POST['login'])) {
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$pass = mysqli_real_escape_string($connect, $_POST['password']);
	$result = mysqli_query($connect, "SELECT * FROM users WHERE email = '".$email."'");
	
	if($row = mysqli_fetch_array($result)) {
		$hashed_password = $row['password'];
		if(password_verify($pass, $hashed_password)){
			$_SESSION['userID'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			header("Location: index.php");
			exit;
		}
	} else {
		$errormsg = "Incorrect Email or Password!";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Login</title>
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
        <li><a href="#">Home</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if(isset($_SESSION['userID'])) { ?>
		<li><a href="#"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
		<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
		<?php } else { ?>
        <li class="active"><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
        <li><a href="register.php"> Register</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
<h1>Login</h1>
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
<form method="POST" action="">
	<div class="form-group">
		<label for="email">Email Address:</label>
		<input type="email" class="form-control" id="email" placeholder="Enter Email.." name="email" required="required">
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" placeholder="Enter Password.." id="pwd" name="password" required="required">
	</div>
	<button type="submit" name="login" class="btn btn-default">Login</button>
</form>
  </div>
</div><br>

<?php include_once 'inc/footer.php' ?>
