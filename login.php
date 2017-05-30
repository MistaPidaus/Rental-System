<?php 
include_once 'inc/config.php';
session_start();

//if login, just redirect to homepage
if(isset($_SESSION['userID'])!= ""){
	header("Location: index.php");
	exit;
}

//check if form submitted
if(isset($_POST['login'])) {
	//escape everything 
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$pass = mysqli_real_escape_string($connect, $_POST['password']);
	$result = mysqli_query($connect, "SELECT * FROM users WHERE email = '".$email."'");
	$row = mysqli_fetch_array($result);
	
	if($row == 0) {
		$error = "<div class='alert alert-danger'><strong>Error!</strong> Account not Exist!</div>";
		} else {
		
		$hashed_password = $row['password'];
		if(password_verify($pass, $hashed_password)){
			$_SESSION['userID'] = $row['user_id'];
			$_SESSION['name'] = $row['name'];
			header("Location: index.php");
			exit;
		
		} else {
			$error = "<div class='alert alert-danger'><strong>Error!</strong> Incorrect Email or Password!</div>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Login</title>
<?php include_once 'inc/header.php'; ?>

<div class="container">    
<h1>Login</h1>
<span class="text-danger"><?php if(isset($error)) { echo $error; } ?></span>
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
	<br>
	<br>
	<p>Not a member yet? <a href="register.php">Click here</a> to register.</p>
</form>
  </div>
</div><br>

<?php include_once 'inc/footer.php' ?>
