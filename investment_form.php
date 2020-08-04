<?php
session_start();
if ( isset($_SESSION["active"]) ) {

	require_once("customers.php");
	$form_id = "CF5e57e323c5eb7";
	$emailField = "fld_7769102";
	$nameField = "fld_8323826";
	$customers = new Customers($form_id, $emailField, $nameField);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Investment Registration List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="panel panel-default" style="margin-top:20px;">
					<div class="panel-heading" style="background:#EEB220; text-align:center;">
						<h1 style="font-family:Cambria;">Investment Registration List</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row" style="margin-bottom:10px;">
									<div class="col-md-3">
										<a href="index.php"><button class="btn btn-info"><i class="fa fa-home"></i> Home</button></a>
									</div>
									<div class="col-md-6" style="text-align:center;">
										<form method="get" action="search.php" class="form-inline">
											<div class="form-group">
												<input type="text" class="form-control" name="q" style="width:300px;">
												<input type="hidden" name="form_id" value="<?php echo $form_id ?>">
											</div>
											<button type="submit" class="btn btn-default">
												<i class="fa fa-search"></i> Search
											</button>
										</form>
									</div>
									<div class="col-md-3" style="text-align:right;"><?php echo $customers->logout(); ?></div>
								</div>
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th>Full Name</th>
											<th>Email Address</th>
											<th>Date-Time</th>
											<th>Action</th>
										</thead>
										<tbody>
											<?php $customers->getList(); ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row" style="text-align:center;"><?php $customers->pagination(); ?></div>
					</div>
				</div>
			</div>
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