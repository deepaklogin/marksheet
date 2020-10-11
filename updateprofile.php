<?php
session_start();
include "conn.php";
if ($_SESSION['sid'] != session_id()) {
	header("location:project1.php");
}
$id = $_SESSION['id'];
$q = $db->prepare("select * from projecta where id=:id");
$q->execute([
	':id' => $_SESSION['id'],
]);
$row = $q->fetch();
$imageshow = '<img src="' . $row['student_img'] . '">';

function test($data) {
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}
$ferr = $lerr = $aerr = $cerr = $perr = $eerr = $tenreserr = $tenerr = $tenreerr = $rerr = $twererr = $tweregerr = $twereserr = $imerr = $g_regerr="";
if (isset($_POST['update'])) {
	if (empty($_POST['fname'])) {
		$ferr = "Enter Name";
	} else {
		$fname = test($_POST['fname']);
	}
	if (empty($_POST['lname'])) {
		$lerr = "Enter last name";
	} else {
		$lname = test($_POST['lname']);
	}
	if (empty($_POST['roll'])) {
		$rerr = "Enter roll";
	} else {
		$roll = test($_POST['roll']);
	}
	if (empty($_POST['class'])) {
		$cerr = "enter class";
	} else {
		$class = test($_POST['class']);
	}
	if (empty($_POST['age'])) {
		$aerr = "enter age";
	} else {
		$age = test($_POST['age']);

	}
	if (empty($_POST['email'])) {
		$eerr = "enter email";
	} else {
		$email = test($_POST['email']);

	}
	if (empty($_POST['phone'])) {
		$perr = "enter phone";
	} else {
		$phone = test($_POST['phone']);

	}
	if (empty($_POST['ten_roll'])) {
		$tenerr = "Enter ten roll";
	} else {
		$ten_roll = $_POST['ten_roll'];

	}
	if (empty($_POST['ten_reg'])) {
		$tenreerr = "Enter Ten regesitration";
	} else {
		$ten_reg = $_POST['ten_reg'];

	}
	if (empty($_POST['ten_result'])) {
		$tenreserr = "Enter Ten result";
	} else {
		$ten_result = $_POST['ten_result'];

	}
	if (empty($_POST['twe_roll'])) {
		$twererr = "Enter twelve roll";
	} else {
		$twe_roll = $_POST['twe_roll'];

	}
	if (empty($_POST['twe_reg'])) {
		$tweregerr = "Enter twelve Registration";
	} else {
		$twe_reg =$_POST['twe_reg'];
	}
	if (empty($_POST['twe_result'])) {
		$twereserr = "Enter twelve result";
	} else {

		$twe_result = $_POST['twe_result'];
	}
	if ($_FILES['student_img']['name'] == '') {
		$imerr = "Enter Student Image";
	} else {

		$student_img = $_FILES['student_img']['name'];
		$img_tmp = $_FILES['student_img']['tmp_name'];
	}
	// graduation details
	if (empty($_POST['g_reg'])) {
		$g_regerr = "Enter Registration number";
	} else {
		$g_reg = test($_POST['g_reg']);
	}
	if (empty($_POST['g_roll'])) {
		$g_rollerr = "Enter Roll number";
	} else {
		$g_roll = test($_POST['g_roll']);
	}
	if (empty($_POST['gsem1'])) {
		$gsemerr1 = "Enter Registration number";
	} else {
		$gsem1 = test($_POST['gsem1']);
	}
	if (empty($_POST['gsem2'])) {
		$gsemerr2 = "Enter Registration number";
	} else {
		$gsem2 = test($_POST['gsem2']);
	}
	if (empty($_POST['gsem3'])) {
		$gsemerr3 = "Enter Registration number";
	} else {
		$gsem3 = test($_POST['gsem3']);
	}
	if (empty($_POST['gsem4'])) {
		$gsemerr4 = "Enter Registration number";
	} else {
		$gsem4 = test($_POST['gsem4']);
	}
	if (empty($_POST['gsem5'])) {
		$gsemerr5 = "Enter Registration number";
	} else {
		$gsem5 = test($_POST['gsem5']);
	}
	if (empty($_POST['gsem6'])) {
		$gsemerr6 = "Enter Registration number";
	} else {
		$gsem6 = test($_POST['gsem6']);
	}

	// diploma details
	if (empty($_POST['d_reg'])) {
		$d_regerr = "Enter Registration number";
	} else {
		$d_reg = $_POST['d_reg'];
	}
	if (empty($_POST['d_roll'])) {
		$d_rollerr = "Enter Roll number";
	} else {
		$d_roll = $_POST['d_roll'];
	}
	if (empty($_POST['dsem1'])) {
		$dsemerr1 = "Enter Registration number";
	} else {
		$dsem1 = test($_POST['dsem1']);
	}
	if (empty($_POST['dsem2'])) {
		$dsemerr2 = "Enter Registration number";
	} else {
		$dsem2 = test($_POST['dsem2']);
	}
	if (empty($_POST['dsem3'])) {
		$dsemerr3 = "Enter Registration number";
	} else {
		$dsem3 = test($_POST['dsem3']);
	}
	if (empty($_POST['dsem4'])) {
		$dsemerr4 = "Enter Registration number";
	} else {
		$dsem4 = test($_POST['dsem4']);
	}
	if (empty($_POST['dsem5'])) {
		$dsemerr5 = "Enter Registration number";
	} else {
		$dsem5 = test($_POST['dsem5']);
	}
	if (empty($_POST['dsem6'])) {
		$dsemerr6 = "Enter Registration number";
	} else {
		$dsem6 = test($_POST['dsem6']);
	}

	if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['roll']) && !empty($_POST['class']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['ten_roll']) && !empty($_POST['ten_reg']) && !empty($_POST['ten_result']) && !empty($_POST['twe_roll']) && !empty($_POST['twe_reg']) && !empty($_POST['twe_result'])) {
		$upload = 'image/' . uniqid() . $student_img;

		$q2 = $db->prepare("update projecta set	fname=:fn,lname=:ln,roll=:r,class=:c,age=:a,email=:e,phone=:p,ten_roll=:ten_roll,ten_reg=:ten_reg,ten_result=:ten_result,twe_roll=:twe_roll,twe_reg=:twe_reg,twe_result=:twe_result,student_img=:si,g_reg=:g_reg,g_roll=:g_roll,gsem1=:gsem1,gsem2=:gsem2,gsem3=:gsem3,gsem4=:gsem4,gsem5=:gsem5,gsem6=:gsem6,d_reg=:d_reg,d_roll=:d_roll,dsem1=:dsem1,dsem2=:dsem2,dsem3=:dsem3,dsem4=:dsem4,dsem5=:dsem5,dsem6=:dsem6 where id=:id");

		$q2->execute([
			':fn' => $fname,
			':ln' => $lname,
			':r' => $roll,
			':c' => $class,
			':a' => $age,
			':e' => $email,
			':p' => $phone,
			':ten_roll' => $ten_roll,
			':ten_reg' => $ten_reg,
			':ten_result' => $ten_result,
			':twe_roll' => $twe_roll,
			':twe_reg' => $twe_roll,
			':twe_result' => $twe_result,
			':si' => $upload,
			':g_reg'=>$g_reg,
			':g_roll'=>$g_roll,
			':gsem1'=>$gsem1,
			':gsem2'=>$gsem2,
			':gsem3'=>$gsem3,
			':gsem4'=>$gsem4,
			':gsem5'=>$gsem5,
			':gsem6'=>$gsem6,
			':d_reg'=>$d_reg,
			':d_roll'=>$d_roll,
			':dsem1'=>$dsem1,
			':dsem2'=>$dsem2,
			':dsem3'=>$dsem3,
			':dsem4'=>$dsem4,
			':dsem5'=>$dsem5,
			':dsem6'=>$dsem6,
			':id' => $id,
		]);
		if ($q2) {
			move_uploaded_file($img_tmp, $upload);
			$s = 'Profile Upload Successfully';
			echo "<div class='text-center bg-success m-4 text-white'><span style='font-size:20px'>$s</span></div>";

			header("refresh:.1");
		} else {
			$serr = $db->errorInfo();
			echo "<div class='text-center bg-danger m-4 text-white'><span style='font-size:20px'>print_r($serr)</span></div>";
		}
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>update Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
	<div class="container col-10">
	<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<div class="row">
			<div class="col-md-4 mx-auto mt-2">
				<p class="text-center text-danger">Personal Details</p>
				<hr>
				<div class="form-group">
					<label>Upload Student Image</label>
					<?php $imgname=$row['student_img']['name']; ?>
					<input type="file" name="student_img" accept="image/*" class="form-control" value="<?php echo $imgname; ?>" >
					<input type="file" name="student_img" accept="image/*" class="form-control" value="" >
				<span class="text-danger"><?php echo $imerr; ?></span>

				</div>
				<div class="form-group">
				<label>Your First Name</label>
				<input type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>">
				<span class="text-danger"><?php echo $ferr; ?></span>
				</div>
			<div class="form-group">
				<label>Your Last Name</label>
				<input type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>">
				<span class="text-danger"><?php echo $lerr; ?></span>

			</div>
			<div class="form-group">
				<label>Your Roll</label>
				<input type="text" name="roll" class="form-control" value="<?php echo $row['roll']; ?>" >
				<span class="text-danger"><?php echo $rerr; ?></span>

			</div>
			<div class="form-group">
				<label>Present Class</label>
				<input type="text" name="class" class="form-control" value="<?php echo $row['class']; ?>">
				<span class="text-danger"><?php echo $cerr; ?></span>

			</div>
			<div class="form-group">
				<label>Your Age</label>
				<input type="text" name="age" class="form-control" value="<?php echo $row['age']; ?>">
				<span class="text-danger"><?php echo $aerr; ?></span>

			</div>
			<div class="form-group">
				<label>Your Email</label>
				<input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">
				<span class="text-danger"><?php echo $eerr; ?></span>

			</div>
			<div class="form-group">
				<label>Your Phone number</label>
				<input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
				<span class="text-danger"><?php echo $perr; ?></span>

			</div>


			<!-- 2nd column -->

			</div>
			<div class="col-md-4 mt-2 mx-auto">
				<p class="text-center text-danger">10th Details</p>
				<hr>
				<div class="form-group">
					<label>10th Roll number</label>
					<input type="text" name="ten_roll" class="form-control" value="<?php echo $row['ten_roll']; ?>">
				<span class="text-danger"><?php echo $tenerr; ?></span>

				</div>
				<div class="form-group">
					<label>10th Registration number</label>
					<input type="text" name="ten_reg" class="form-control" value="<?php echo $row['ten_reg']; ?>">
				<span class="text-danger"><?php echo $tenreerr; ?></span>

				</div>
				<div class="form-group">
					<label>10th Result number</label>
					<input type="text" name="ten_result" class="form-control" value="<?php echo $row['ten_result']; ?>">
				<span class="text-danger"><?php echo $tenreserr; ?></span>

				</div>
				<p class="text-center text-danger mt-2">12th Details</p>
				<hr>
				<div class="form-group">
					<label>12th Roll number</label>
					<input type="text" name="twe_roll" class="form-control" value="<?php echo $row['twe_roll']; ?>">
				<span class="text-danger"><?php echo $twererr; ?></span>

				</div>
				<div class="form-group">
					<label>12th Registration number</label>
					<input type="text" name="twe_reg" class="form-control" value="<?php echo $row['twe_reg']; ?>">
				<span class="text-danger"><?php echo $tweregerr; ?></span>

				</div>
				<div class="form-group">
					<label>12th Result number</label>
					<input type="text" name="twe_result" class="form-control" value="<?php echo $row['twe_result']; ?>">
				<span class="text-danger"><?php echo $twereserr; ?></span>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5 mx-auto">
				<p class="text-center bg-primary mt-4 p-2 text-white text-capitalize">Graduation details</p>
				<div class="form-group">
					<label>Registration number</label>
					<input type="text" name="g_reg" value="<?php echo $row['g_reg']?>" class="form-control" >
					<span class="text-danger"><?php echo $g_regerr; ?></span>

				</div>
				<div class="form-group">
					<label>Exam Roll number</label>
					<input type="text" name="g_roll" value="<?php echo $row['g_roll']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 1</label>
					<input type="text" name="gsem1" value="<?php echo $row['gsem1']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 2</label>
					<input type="text" name="gsem2" value="<?php echo $row['gsem2']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 3</label>
					<input type="text" name="gsem3" value="<?php echo $row['gsem3']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 4</label>
					<input type="text" name="gsem4" value="<?php echo $row['gsem4']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 5</label>
					<input type="text" name="gsem5" value="<?php echo $row['gsem5']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 6</label>
					<input type="text" name="gsem6" value="<?php echo $row['gsem6']?>" class="form-control" >
				</div>

			</div>
			<div class="col-md-4 mx-auto">
				<p class="text-center bg-primary mt-4 p-2 text-white text-capitalize">Diploma details</p>
				<div class="form-group">
					<label>Registration number</label>
					<input type="text" name="d_reg" value="<?php echo $row['d_reg']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Exam Roll number</label>
					<input type="text" name="d_roll" value="<?php echo $row['d_roll']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 1</label>
					<input type="text" name="dsem1" value="<?php echo $row['dsem1']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 2</label>
					<input type="text" name="dsem2" value="<?php echo $row['dsem2']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 3</label>
					<input type="text" name="dsem3" value="<?php echo $row['dsem3']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 4</label>
					<input type="text" name="dsem4" value="<?php echo $row['dsem4']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 5</label>
					<input type="text" name="dsem5" value="<?php echo $row['dsem5']?>" class="form-control" >
				</div>
				<div class="form-group">
					<label>Semester 6</label>
					<input type="text" name="dsem6" value="<?php echo $row['dsem6']?>" class="form-control" >
				</div>

			</div>
		</div>
		<br>
		<div class="form-group col-md-6 mx-auto">
			<input type="submit" name="update" class="form-control btn btn-outline-success">
			<br><br><a href="student.php" class="btn btn-outline-info form-control">Back</a><br><br>

		</div>
		</form>
		<div>
</body>
</html>
