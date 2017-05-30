<?php 
session_start();
include_once 'inc/config.php';

if(!$_SESSION['userID'])
{
	header('Location: login.php');
	exit;
}else{
	
	$carID = $_SESSION['carID'];
	$price = $_SESSION['price'];
	$hours = $_SESSION['hours'];
	$userID = $_SESSION['userID'];
	
	$data = mysqli_query($connect, "SELECT * FROM cars WHERE car_id = '".$carID."'");
	$car = mysqli_fetch_array($data);
	
	$total = 0;
	
	//calculation
	$total = ($price * $hours);
	
	if(isset($_POST['confirm'])){
		//insert required data to db
		if(mysqli_query($connect, "INSERT INTO rent(user_id, car_id, rent_tf,  total, price, status) VALUES
			('".$userID."', '".$carID."', '".$hours."', '".$total."', '".$price."', 'Pending')")){
				$success = "<div class='alert alert-success'><strong>Success!</strong> You Have Successfully Booked! We will contact you soon.</div>"; 
				//just in case the user wants to order another car
				unset($carID);
				unset($hours);
				unset($price);
		}else{ 
			$errormsg = "<div class='alert alert-danger'>There is a problem with your current request. Please try again later or contact support.</div>";
		}
	}//if cancel, unset the session value
	if(isset($_POST['cancel'])){
		unset($carID);
		unset($hours);
		unset($price);
		header('Location: index.php');
	exit;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Confirm Booking</title>
<?php include_once 'inc/header.php'; ?>
	<?php if (isset($errormsg)) { echo $errormsg; } ?>

	<span class="text-success"><?php if (isset($success)) { echo $success; } ?></span>
   <div class="thumbnail">
   <form action="" method="post">
                    <img class="img-responsive" src="./images/cars/<?php echo $car['image']; ?>" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right">RM<?php echo $car['rent_cost']; ?>/hour</h4>
                        <h4><a href="#"><?php echo $car['car_name']; ?></a>
                        </h4>
                        <p>Car Type: <?php echo $car['car_type']; ?></p>
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
						<div class="text-right">
						<p><h3><b>Total: RM <?php echo $total ?></b></h3></p>
						<button type="submit" name="cancel" class="btn btn-default">Cancel</button>
						<button type="submit" name="confirm" class="btn btn-success">Confirm >></button>
                    </div>
                    </div>
					</form>
                </div>
  </div>
</div><br>

<?php include_once 'inc/footer.php'; ?>