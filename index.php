<?php
session_start();
if ( isset($_SESSION["active"]) ) {
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yello Traders Customers Form List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style type="text/css">
		button{
			width: 70%; 
			height: 50px;
			margin: 50px 0px 50px 0px;
			font: bold 28px Calibri;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default" style="margin-top:50px;">
					<div class="panel-heading" style="background:#EEB220; text-align:center;">
						<h1 style="font-family:Cambria;">Yello Traders Customers Form List</h1>
					</div>
					<div class="panel-body" style="text-align:center;">
						<div style="text-align:right;">
							<a href="#"><input type="button" class="btn btn-danger" value="Logout" onclick="window.location.assign('logout.php')"></a>
						</div>
						<a href="investment_form.php"><button type="button" class="btn btn-warning">Investment Registration Form</button></a>
						<a href="top_up_form.php"><button type="button" class="btn btn-warning">Top-Up Form</button></a>
						<a href="roll_over_form.php"><button type="button" class="btn btn-warning">Roll-Over Form</button></a>
						<a href="junior_yellow_traders.php"><button type="button" class="btn btn-warning">Junior Yellow Traders Form</button></a>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
<?php
}
else{
	header("Location: login.php");
}
?>