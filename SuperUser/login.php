<?php 
include_once '../inc/config.php';
session_start();

//if login, just redirect to homepage
if(isset($_SESSION['admin'])!= ""){
	header("Location: index.php");
	exit;
}

//check if form submitted
if(isset($_POST['admin_login'])) {
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$pass = mysqli_real_escape_string($connect, $_POST['password']);
	$result = mysqli_query($connect, "SELECT * FROM admin_user WHERE email = '".$email."'");
	$row = mysqli_fetch_array($result);
	
	if($row == 0) {
		$error = "<div class='alert alert-danger'><strong>Error!</strong> Account not Exist!</div>";
		} else {
		
		$hashed_password = $row['password'];
		if(password_verify($pass, $hashed_password)){
			$_SESSION['admin'] = $row['admin_id'];
			$_SESSION['admin_name'] = $row['name'];
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
  <title>Heaven Car Rental - Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Administrator - Login</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <?php if (isset($error)) { echo $error; } ?>
                            
                        <form id="loginform" method="post" action="" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="email" class="form-control" name="email" value="" placeholder="email" required="required">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required="required">
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" type="submit" name="admin_login" class="btn btn-success">Login  </button>

                                    </div>
                                </div>
                            </form>     



                        </div>                     
                    </div>  
        </div>
                            </form>
                         </div>
    

<?php include_once '../inc/footer.php' ?>
