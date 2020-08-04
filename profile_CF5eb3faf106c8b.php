<?php
session_start();
if ( isset($_SESSION["active"]) ) {

require_once("customers.php");
$form_id = "CF5eb3faf106c8b";
$customer = new Customers();
$records = $customer->getUserProfile($_GET['entry_id'], $form_id);
$marital_status = explode('"', $records['marital_status']);
$gender = explode('"', $records['gender']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div style="padding:10px;">
		<button class="btn btn-default" onclick="window.print();" style="float:right;"><i class="fa fa-print"></i> Print</button></div>
	<div id="main" style="width:595px; max-height:842px; background:#FFF;">
		<div id="header" style="width:100%; height:20%;">
			<table style="width:100%;">
				<tr>
					<td style="width:60%;" align="center">
						<img src="img/logo.png" style="width:120px;">
						<h4>TOP-UP APPLICATION FORM</h4>
						<p><span>REG NO:</span> __________________</p>
					</td>
					<td align="right" style="width:40%;">
						<img class="img-thumbnail" src="<?php echo $records['upload_your_passport_photograph'] ?>" style="width:65%; height:150px; margin-right:10%;">
					</td>
				</tr>
			</table>
		</div>
		<div id="content" style="width:100%; height:66%; padding:5px;">
			<table class="" style="width:100%;">
				<tr><td><span>FULL NAME:</span> <?php echo $records['full_name'] ?> </td></tr>
				<tr><td><span>MARITAL STATUS:</span> <?php echo $marital_status[3] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>GENDER:</span> <?php echo $gender[3] ?> </td></tr>
				<tr><td><span>RESIDENTIAL ADDRESS:</span> <span style="text-transform:lowercase; font-weight:normal; font-size:15px;"><?php echo $records['residential_address'] ?></span> </td></tr>
				<tr><td><span>PHONE NUMBER:</span> <?php echo $records['phone_number'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>OTHER NUMBERS:</span> <?php echo $records['none'] ?> </td></tr>
				<tr><td><span>EMAIL:</span> <?php echo $records['email_address'] ?> </td></tr>
				<tr><td><span>TOP UP AMOUNT:</span> <?php echo $records['amount_to_topup'] ?> </td></tr>
				<tr><td><span>PREVIOUS AMOUNT:</span> <?php echo $records['previous_amount'] ?> </td></tr>
				<tr><td><span>TOTAL INVESTMENT:</span> <?php echo $records['total_investment'] ?> </td></tr>
				<tr><td><span>AMOUNT IN WORDS:</span> <?php echo $records['amount_in_words'] ?> </td></tr>
				<tr><td><span>MONTHLY ROI:</span> <?php echo $records['monthly_roi'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>MONTHLY %:</span> <?php echo $records['monthly_'] ?> </td></tr>
				<tr><td><span>PREVIOUS ROI DATE:</span> <?php echo $records['previous_roi_date'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>TOP-UP DATE:</span> <?php echo $records['new_roi_date'] ?> </td></tr>
				<tr><td><span>ACCOUNT NAME:</span> <?php echo $records['account_name'] ?> </td></tr>
				<tr><td><span>ACCOUNT NUMBER:</span> <?php echo $records['account_number'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>BANK:</span> <?php echo $records['bank'] ?> </td></tr>
				<tr><td><span>DEPOSITORS NAME:</span> <?php echo $records['depositors_name'] ?> </td></tr>
				<tr><td><span>ATTESTATION:</span> <span style="font-size:14px; font-weight:normal; text-transform:none;">I <u><?php echo $records['attestation'] ?></u> do hereby confirm that all information given is true and correct and that if found to be false should lead to the disqualification of my application.</span></td></tr>
				<tr><td><span>APPLICANT'S SIGNATURE:</span> ____________________________ <span>DATE:</span> <?php echo $records['attestation_date'] ?></td></tr>
			</table>
		</div>
		<div id="footer" style="width:100%; border-top:1px solid #222;">
			<div id="footer1" style="background: #EEB220; padding:3px; text-align:center;">
				<h4>OFFICE ADDRESS / CONTACT</h4>
				<div>17, Iyalla street, beside shoprite, ikeja, Lagos.</div>
				<div>07027487313, 07064555084, 08080340064</div>
			</div>
			<div id="footer2">
				<span style="font-style:italic;">DISCLAIMER:</span> <span>Please note that all payment should be made to only the account below</span><br>
				<span>GTBANK, YELLOW POINT MEDIA, 0018519250 ... Any other account is at owners risk</span>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php
}
else{
	header("Location: login.php");
}
?>