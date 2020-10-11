<!DOCTYPE html>
<html>
<head>
	<title>New Project 1</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
	<?php
session_start();
if (isset($_SESSION['sid'])) {
	header("location:student.php");
}
include "conn.php";
$ferr = $lerr = $rerr = $cerr = $fer = $ler = $rer = $perr=$s=$er="";
function test($data) {
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}
if (isset($_POST['submit'])) {

	if (empty($_POST['fname'])) {
		$ferr = "Enter First name";
	} else {
		$fname = test($_POST['fname']);
	}
	if (empty($_POST['lname'])) {
		$lerr = "Enter Last name";
	} else {
		$lname = test($_POST['lname']);
	}
	if (empty($_POST['phone'])) {
		$perr = "Enter Phone";
	} else {
		$phone = test($_POST['phone']);
	}
	if (!empty($fname) && !empty($lname) && !empty($phone)) {
		$q1 = $db->prepare("insert into projecta (fname,lname,phone) values(:fn,:ln,:p)");
		$q1->execute([
			':fn' => $fname,
			':ln' => $lname,
			':p' => $phone,
		]);
		if ($q1) {
			$s="data insert successfully";
			// header("refresh:.5");
		} else {
			$er= 'failed';
			print_r($db->errorInfo());
			// header("refresh:.5");
		}
	}
}

?>

	<div class="container col-11">
		<div class="row">
		<div class="form col-md-6">
			<?php echo "<div class='text-center bg-success text-capitalize text-white mt-4'><h2>$s</h2></div>"; ?>
			<?php echo "<div class='text-center bg-danger text-capitalize text-white mt-4'><h2>$er</h2></div>"; ?>
			<h1 class="text-center text-primary">Register here</h1>
			<hr>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
				<div class="form-group col mx-auto">
					<label>Enter First name</label>
					<input type="text" name="fname" class="form-control">
					<span class="text-danger"><?php echo $ferr; ?></span>
				</div>
				<div class="form-group col mx-auto">
					<label>Enter Last name</label>
					<input type="text" name="lname" class="form-control">
					<span class="text-danger"><?php echo $lerr; ?></span>

				</div>
				<div class="form-group col mx-auto">
					<label>Enter Phone number</label>
					<input type="text" name="phone" class="form-control" maxlength="10">
					<span class="text-danger"><?php echo $perr; ?></span>

				</div>
				<br>
				<div class="form-group col mx-auto">
					<input type="submit" name="submit" class="btn btn-outline-success form-control">
				</div>

			</form>
		</div>

		<?php
$s = $f =$per=$fname1=$lname1=$phone1= "";
if (isset($_POST['login'])) {
	if (empty($_POST['fname'])) {
		$fer = "Enter first name";
	} else {
		$fname1 = test($_POST['fname']);
	}
	if (empty($_POST['lname'])) {
		$ler = "Enter last name";
	} else {
		$lname1 = test($_POST['lname']);
	}
	if (empty($_POST['fname'])) {
		$rer = "Enter first name";
	} else {
		$fname1 = test($_POST['fname']);
	}
	if (empty($_POST['phone'])) {
		$per = "Enter Phone number";
	} else {
		$phone1 = test($_POST['phone']);
	}
}
if (!empty($fname1) && !empty($lname1) && !empty($phone1)) {
	$q2 = $db->prepare("select * from projecta where fname=:f and lname=:l and phone=:p");
	$q2->execute([
		':f' => $fname1,
		':l' => $lname1,
		':p' => $phone1,
	]);
	$row = $q2->fetchAll();
	if ($row) {
		$_SESSION['sid'] = session_id();
		$_SESSION['fname'] = $fname1;
		$_SESSION['lname'] = $lname1;
		$_SESSION['phone'] = $phone1;
		$s = "login sucess";
		header("refresh:1;student.php");

	} else {
		$f = "something error";
		// header("refresh:1");
		// print_r(errorInfo($db));
	}
}
?>
		<div class="form col-md-6">
			<div class="text-center bg-success mt-3"><span class="text-white"><?php echo $s; ?></span></div>
			<div class="text-center bg-danger mt-3"><span class=" text-white"><?php echo $f; ?></span></div>

			<h1 class="text-center text-dark">Login Here</h1><hr>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
				<div class="form-group col mx-auto">
					<label>Enter First name</label>
					<input type="text" name="fname" class="form-control" value="<?php echo $fname1;?>">
					<span class="text-danger"><?php echo $fer; ?></span>

				</div>
				<div class="form-group col mx-auto">
					<label>Enter Last name</label>
					<input type="text" name="lname" class="form-control" value="<?php echo $lname1;?>">
					<span class="text-danger"><?php echo $ler; ?></span>

				</div>
				<div class="form-group col mx-auto">
					<label>Enter Phone number</label>
					<input type="text" name="phone" class="form-control" value="<?php echo $phone1;?>">
					<span class="text-danger"><?php echo $per; ?></span>

				</div><br>
				<div class="form-group mx-auto col">
					<input type="submit" name="login" class="btn btn-outline-dark form-control">
				</div>
			</form>
		</div>
		</div>
	</div>

</body>
</html>
