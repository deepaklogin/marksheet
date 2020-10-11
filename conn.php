<?php
$db = new PDO('mysql:host=sql107.epizy.com;dbname=epiz_26378805_shoppingmobile', 'epiz_26378805', 'Deepak1802');
if (!$db) {
	echo "Connection lost";
} else {
	// echo 'successfull';
}

// $q=$db->query("create database project1")

//$q = $db->query("create table projecta(id int(6) auto_increment primary key,fname varchar(50),lname varchar(50),roll int(5),class varchar(10))");

// if ($q) {
// 	echo 'table create sucess';
// } else {
// 	echo 'table exists';
// }

// $db = mysqli_connect("localhost", "root", "", "project1");
// if (!$db) {
// 	echo 'failed';
// }

?>
