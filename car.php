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

$carID = $car['car_id'];
$car_name = $car['car_name'];
$price = $car['rent_cost'];
$type = $car['car_type'];
$capa = $car['capacity'];
$status = $car['status'];
$image = $car['image'];

if(isset($_POST['booking'])){ //nanti betulkan, aku kene buat session. skng gi tido
	//insert mysql dalam table booking
	$carID = $_SESSION['carID'] = mysqli_real_escape_string($connect, $_POST['carId']);
	$price = $_SESSION['price'] = mysqli_real_escape_string($connect, $_POST['price']);
	$hours = $_SESSION['hours'] = mysqli_real_escape_string($connect, $_POST['hours']);
	header('Location: booking.php'); 
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - <?php echo $car_name; ?></title>
<?php include_once 'inc/header.php'; ?>
   <div class="thumbnail">
                    <img class="img-responsive" src="./images/cars/<?php echo $image; ?>" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right">RM<?php echo $price; ?>/hour</h4>
                        <h4><a href="#"><?php echo $car_name; ?></a>
                        </h4>
                        <p>Car Type: <?php echo $type; ?></p>
                        <p>Capacity: <?php echo $capa; ?></p>
						<p>Status: <?php echo $status; ?></p>
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
						<form id="eventForm" method="post" action="" class="form-horizontal">
						<input type="hidden" name="carId" value="<?php echo $carID; ?>"/>
						<input type="hidden" name="price" value="<?php echo $price; ?>" />
						<div class="form-group">
							<label class="col-xs-3 control-label">Hours</label>
							<div class="col-xs-1">
								<input type="number" class="form-control" name="hours" min="1" value="0" />
							</div>
						</div>

    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" name="booking" class="btn btn-default">Book Now >></button>
        </div>
    </div>
</form>
                    </div>
    </div>
  </div>
</div><br>

<?php include_once 'inc/footer.php'; ?>