<?php
session_start();
if ( isset($_SESSION["active"]) ) {

if (isset($_GET['q']) && isset($_GET['form_id'])) {

require_once("customers.php");
$q = $_GET['q'];
$form_id = $_GET['form_id'];
$emailField = "fld_7769102";
$nameField = "fld_8323826";
$customers = new Customers($form_id, $emailField, $nameField, $q);
$form_name;
switch ($form_id) {
	case 'CF5e57e323c5eb7':
		$form_name = "Investment Registration Form";
		break;
	case 'CF5eb3faf106c8b':
		$form_name = "Top-Up Form";
		break;
	case 'CF5e8b3dc315ba0':
		$form_name = "Roll-Over Form";
		break;
	case 'CF5ee1663c7fd74':
		$form_name = "Junior Yellow Traders Form";
		break;
	default:
		$form_name = "No form selected";
		break;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Result for <em><?php echo $form_name; ?></em></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="panel panel-default" style="margin-top:20px;">
					<div class="panel-heading" style="background:#EEB220; text-align:center;">
						<h1 style="font-family:Cambria;">Search Result for <em><?php echo $form_name; ?></em></h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row" style="margin-bottom:10px;">
									<div class="col-md-4">
										<button class="btn btn-default" onclick="window.history.back()"> <i class="fa fa-arrow-circle-left"></i> Back</button>
									</div>
									<div class="col-md-4" style="text-align:center;">
										<a href="index.php"><button class="btn btn-info"><i class="fa fa-home"></i> Home</button></a>
									</div>
									<div class="col-md-4" style="text-align:right;"><?php echo $customers->logout(); ?></div>
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
											<?php $customers->search(); ?>
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
} else{
	header('Location: index.php');
}

}else{
	header("Location: login.php");
}
?>