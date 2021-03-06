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
	//declare vars and prevent sqli
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
	
	//validate email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please enter a valid email address";
	}
	
	//validate pass length
	if(strlen($pass) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	
	//validate confirm pass
	if($pass != $cpass){
		$error = true;
		$cpass_error = "Your confirmation passwords did not match";
	}
	
	//if there's no error..
	if(!$error){
	
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
	
		if(mysqli_query($connect, "INSERT INTO users(name, address, state, zip, phone, email, password, admin_rank) VALUES
		('".$name."', '".$address."', '".$state."', '".$zip."', '".$phone."', '".$email."', '".$hashed_password."', '0')")){
			$success = "<div class='alert alert-success'><strong>Successfully Registered!</strong> <a href='login.php'>Click here to login</a></div>";
		}else{
			$errormsg = "<div class='alert alert-danger'>Error in register. Please try again later or contact support.</div>";
		}
	}	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Register</title>
<?php include_once 'inc/header.php'; ?>

<div class="container">    
<h1>Register</h1>
<p>Already a member? <a href="login">Click here</a> to login.</p>
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
