<?php
session_start();
if ( isset($_POST['uname']) && isset($_POST['pword']) ) {
	$uname = $_POST['uname'];
	$pword = md5($_POST['pword']);
	require_once('customers.php');
	$ytd = new Customers();
	if ( $ytd::user_login == $uname && $ytd::user_pass == $pword ) {
		$_SESSION["active"] = $uname;
		header("Location: index.php");
	} else{
		//session_start();
		$_SESSION["log_error"] = 'Invalid login credentials.';
		header("Location: login.php");
	}
} else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | Yello Traders Customers</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style type="text/css">
		body{
			font: 16px Calibri;
		}
		.panel{
			border-radius:10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-default align-middle" style="margin-top:50px; background:#EEB220;">
					<div class="panel-heading" style="text-align:center; background:#EEB220;">
						<h2 style="font-family:tahoma; text-transform:uppercase;">Login</h2>
						<span style="text-align:center; font-style:italic; color:#900;">Login with your wordpress credentials.</span>
					</div>
					<div class="panel-body" style="font-size:18px; font-weight:100;">
						<?php if( isset($_SESSION['log_error']) ){ ?>
						<div class="alert alert-danger">
							<strong>Error!</strong> <?php echo $_SESSION['log_error']; ?>
						</div>
						<?php } unset($_SESSION['log_error']); ?>
						<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
							<div class="form-group" style="">
								<label for="uname">Username:</label>
								<input type="text" class="form-control" name="uname" id="uname" placeholder="Enter your username" required>
							</div>
							<div class="form-group">
								<label for="pword">Password:</label>
								<input type="password" class="form-control" name="pword" id="pword" placeholder="Enter your password" required>
							</div>
							<div style="text-align:center;"><button type="submit" class="btn btn-primary">Login</button></div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>
<?php
}
?>