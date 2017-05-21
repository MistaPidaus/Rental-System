<?php 
include_once 'inc/config.php';
session_start();

if(isset($_SESSION['userID'])) {
	header("Location: index.php");
	exit;
}

//set error as false
$error = false;

//Check if form submitted
if(isset($_POST['register'])){
	$name = mysqli_real_escape_string($connect, $_POST['fullname']);
	$address = mysqli_real_escape_string($connect, $_POST['address']);
	$state = mysqli_real_escape_string($connect, $_POST['state']);
	$zip = mysqli_real_escape_string($connect, $_POST['postcode']);
	$phone = mysqli_real_escape_string($connect, $_POST['phone']);
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$pass = mysqli_real_escape_string($connect, $_POST['password']);
	$cpass = mysqli_real_escape_string($connect, $_POST['confirmPassword']);
	
	//name can contain only alpha characters and space
	if(!preg_match("/^[a-zA-Z ]+$/", $name)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please enter a valid email address";
	}
	
	if(strlen($pass) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	
	if($pass != $cpass){
		$error = true;
		$cpass_error = "Your confirmation passwords did not match";
	}
	
	if(!$error){
	
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
	
		if(mysqli_query($connect, "INSERT INTO users(name, address, state, zip, phone, email, password) VALUES
		('".$name."', '".$address."', '".$state."', '".$zip."', '".$phone."', '".$email."', '".$hashed_password."')")){
			$success = "Successfully Registered! <a href='login.php'>Click here to login</a>";
		}else{
			$errormsg = "Error in register. Please try again later.";
		}
	}	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Register</title>
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
        <li><a href="index.php">Home</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if(isset($_SESSION['userID'])) { ?>
		<li><a href="#"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
		<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
		<?php } else { ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
        <li class="active"><a href="register.php"> Register</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
<h1>Register</h1>

<span class="text-success"><?php if (isset($success)) { echo $success; } ?></span>
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

<form method="POST" action="register.php" autocomplete="off">
	<div class="form-group">
		<label for="email">Email Address:</label>
		<input type="email" name="email" class="form-control" id="email" value="<?php if($error) echo $email; ?>" placeholder="Email Address" required>
	<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" name="password" class="form-control" value="<?php if($error) echo $pass; ?>" placeholder="Password" id="pwd" required>
	<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
	</div>
	<div class="form-group">
		<label for="password">Confirm Password:</label>
		<input type="password" name="confirmPassword" class="form-control" value="<?php if($error) echo $cpass; ?>" placeholder="Confirm Password" id="pwd" required>
	<span class="text-danger"><?php if (isset($cpass_error)) echo $cpass_error; ?></span>
	</div>
	<div class="form-group">
		<label for="password">Full Name:</label>
		<input type="name" name="fullname" class="form-control" id="name" value="<?php if($error) echo $name; ?>" placeholder="Full Name" required="required">
	<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
	</div>
	<div class="form-group">
		<label for="address">Address:</label>
		<input type="address" name="address" class="form-control" placeholder="Enter Your Full Address" id="address" required="required">
	</div>
	<div class="form-group">
		<label for="state">State:</label>
		<input type="state" name="state" class="form-control" placeholder="State" id="state" required="required">
	</div>
	<div class="form-group">
		<label for="postcode">Postcode:</label>
		<input type="zipcode" name="postcode" class="form-control" placeholder="Postcode/Zipcode" maxlength="5" id="postcode" required="required">
	</div>
	<div class="form-group">
		<label for="phone">Phone Number:</label>
		<input type="phone" name="phone" class="form-control" placeholder="Phone Number" id="phone" maxlength="13" required="required">
	</div>
	<button type="submit" name="register" class="btn btn-default">Register</button>
</form>
  </div>
</div><br>

<?php include_once 'inc/footer.php' ?>
