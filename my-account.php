<?php 
session_start();
include_once 'inc/config.php';

if(!$_SESSION['userID'])
{
	header('Location: login.php');
	exit;
}
	
	$user_ID = $_SESSION['userID'];
	$data = mysqli_query($connect, "SELECT * FROM rent WHERE user_id = '".$user_ID."'");

if(isset($_POST['cancel']))
{
	$rentID = mysqli_real_escape_string($connect, $_POST['rentID']);
	$cancel = mysqli_real_escape_string($connect, $_POST['cancel']);
	
	var_dump($rentID);
	
	if(mysqli_query($connect, "UPDATE rent SET status='".$cancel."' WHERE rent_id='".$rentID."'"))
	{
		$success = "<div class='alert alert-success'><strong>Successfully Cancelled!</strong></div>";
	}else{
		$errormsg = "<div class='alert alert-danger'>Error cancelling the reservation.</div>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Heaven Car Rental - Confirm Booking</title>
<?php include_once 'inc/header.php'; ?>
  
                <div class="well">
				<?php if (isset($errormsg)) { echo $errormsg; } ?>
				<span class="text-success"><?php if (isset($success)) { echo $success; } ?></span>
				<h3>My Transaction History</h3>
                    <hr>
					<?php 
					 while($trans = mysqli_fetch_array($data))
					 {
					 ?>
                    <div class="row">
                        <div class="col-md-12">
                            Transaction Rent ID: <?php echo $trans['rent_id']; ?>
                            <span class="pull-right">Total: <b>RM <?php echo $trans['total']; ?></b></span>
							<p>Rent TimeFrame: <b><?php echo $trans['rent_tf']; ?> hours</b></p>
							<p>Price: <b> RM <?php echo $trans['price']; ?></b></p>
							<p>Status: <?php echo $trans['status']; ?>
							<p><?php if($trans['status'] == "Pending") { ?>
							<!-- Trigger the modal with a button -->
							<form action="" method="post">
							<input type="hidden" name="rentID" value="<?php echo $trans['rent_id'];?>">
							  <button type="submit" name="cancel" value="Cancelled" class="btn btn-danger">Cancel</button>
							  </form>
								<?php } else { ?>
								<button type="button" class="btn btn-danger disabled">Cancel</button>
								<?php } ?>
							</p>
                        </div>
                    </div>

                    <hr>
				<?php } ?>
                </div>

            </div>

</div><br>

<?php include_once 'inc/footer.php'; ?>