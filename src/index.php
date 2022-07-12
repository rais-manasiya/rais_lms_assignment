<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//set default  values
$fullname = '';
$pin = '';
$loan_amount = '';
$loan_period = '';
$purpose = '';

if(count($_POST) > 0){

	require "autoload.php";

	$loan = new Loan();
	$errors = $loan->register($_POST);

	extract($_POST);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Loan Management System</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<style type="text/css">
	.form-control{margin-bottom:10px;}

	</style>
	<form method="post" style="padding: 10px;border: solid thin #aaa; border-radius: 10px;margin:auto;width: 500px;">
		
		<?php if(isset($errors) && is_array($errors) && count($errors) > 0):?>
			<div class="alert alert-danger">
				<ul>
				<?php foreach($errors as $error):?>
				<li><?=$error?></li>
				<?php endforeach;?>
				</ul>
			</div>
		<?php endif;?>

		

		<h4 class="text-center">Loan Management System</h4>
		<hr>
		<input type="text" id="fullname" name="fullname"  placeholder="Full Name" class="form-control" value="<?php echo $fullname?>" />
		<input type="text" id="pin" name="pin" class="form-control" placeholder="Personal Identification Number" value="<?php echo $pin?>" />
		<input type="text" id="loan_amount" name="loan_amount" class="form-control" placeholder="Loan Amount" value="<?php echo $loan_amount?>" />
		<input type="text" id="loan_period" name="loan_period" class="form-control" placeholder="Period in months" value="<?php echo $loan_period?>" />
		<select class="form-control" name="purpose">
			<option value="" selected="selected">-- Purpose of use --</option>
			<option value="holiday" <?php if($purpose==='holiday'){echo 'selected="selected"';}?>>Holiday</option>
			<option value="repair" <?php if($purpose==='repair'){echo 'selected="selected"';}?>>Repair</option>
			<option value="consumer electronics" <?php if($purpose==='consume electronics'){echo 'selected="selected"';}?>>Consumer electronics</option>
			<option value="wedding" <?php if($purpose==='wedding'){echo 'selected="selected"';}?>>Wedding</option>
			<option value="rental" <?php if($purpose==='rental'){echo 'selected="selected"';}?>>Rental</option>
			<option value="car" <?php if($purpose==='car'){echo 'selected="selected"';}?>>Car</option>
			<option value="school" <?php if($purpose==='school'){echo 'selected="selected"';}?>>School</option>
			<option value="investment" <?php if($purpose==='investment'){echo 'selected="selected"';}?>>Investment</option>
        </select>
		<button  class="btn btn-success" type="submit">Submit</button>
		<!-- <input class="btn btn-submit" type="submit" value="Submit">
		 -->
		<br style="clear: both;">
	</form>

</body>
</html>