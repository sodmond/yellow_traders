<?php
session_start();
if ( isset($_SESSION['active']) ) {
	unset($_SESSION['active']);
	header("Location: login.php");
} else{
	header("Location: login.php");
}
session_unset();
session_destroy();
?>