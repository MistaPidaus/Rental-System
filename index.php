<?php 
session_start();
include_once 'inc/config.php';

//Fetch required info
$data = mysqli_query($connect, "SELECT * FROM cars WHERE status = 'Available'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Home</title>
<?php include_once 'inc/header.php'; ?>
  
  <?php 
  while($car = mysqli_fetch_array($data))
  {
  ?><!-- Display info -->
    <div class="col-sm-4">
      <div class="thumbnail">
                    <img src="./images/cars/<?php echo $car['image']; ?>" style="height:200px;" alt="">
                    <div class="caption">
                        <h3><?php echo $car['car_name'];?></h3>
                        <p>Rent Price: <b>RM<?php echo $car['rent_cost']; ?>/hour</b></p>
                        <p>
                            <a href="car.php?id=<?php echo $car['car_id']; ?>" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
    </div>
	<?php } ?>
  </div>
</div><br>

<?php include_once 'inc/footer.php'; ?>