<?php
session_start();
if ($_SESSION['sid'] != session_id()) {
	header("location:index.php");
}
session_unset();
session_destroy();
header("location:index.php");

?>
