<?php
session_start();
if ($_SESSION['sid'] != session_id()) {
	header("location:index.php");
}

include "conn.php";
$q = $db->prepare("select * from projecta where fname=:fn and lname=:ln and phone=:p");
$q->execute([
	":fn" => $_SESSION['fname'],
	":ln" => $_SESSION['lname'],
	":p" => $_SESSION['phone'],
]);
$row = $q->fetch();
$_SESSION['id'] = $row['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="text-center text-success">Student Details</h1>
		<hr>
		<div class="float-right">
			<a href="updateprofile.php"><button class="btn btn-outline-info">Update Profile</button></a>
			<a href="logout.php"><button class="btn btn-outline-info">Log Out</button></a>
		</div>

		<div class="col-md-10 text-center mx-auto mt-5">

			<img src="<?php echo $row['student_img']; ?>" alt="student image" class="img-circle mt-3" style="width:250px;height: 200px;border-radius: 100px"><br />
		</div>
		<div class="text-center col-md-10 mt-2 ml-4">
			<a href="<?php echo $row['student_img']; ?>" download><button class="btn btn-outline-success">Download Image</button></a>
		</div>
		<?php
				if(isset($_POST['submit']))
				{
					if($_FILES['img']['name']!='')
					{
						$img=$_FILES['img']['name'];
						$imgtmp=$_FILES['img']['tmp_name'];

						$upload='image/'.uniqid().$img;
						$q1=$db->prepare("update projecta set student_img=:si where id=:id");
						$q1->execute([
							':si'=>$upload,
							':id'=>$_SESSION['id'],
						]);
						if($q)
						{
							move_uploaded_file($imgtmp,$upload);
						}
						else {
							echo "file not uploaded";
						}
					}else {
						echo "file can't be empty";
						// header("refresh:.5");
					}
				}
		 ?>
		<div class="text-center col-md-10 mt-2 ml-4">
			<form class="" action="" method="post">
				<div class="form-group">
					<input type="file" name="img" value="" class="form-control">
					<input type="submit" name="submit" value="Upload File" class="btn btn-primary">
				</div>
			</form>

		</div>
		<div class="row">
			<div class="col-md-5 mx-auto mt-2">
				<p class="text-center text-danger">Personal Details</p>
				<hr>
				<div class="form-group">
				<label>Your First Name</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['fname']; ?>" readonly>
				</div>
			<div class="form-group">
				<label>Your Last Name</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['lname']; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Your Roll</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['roll']; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Present Class</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['class']; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Your Age</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['age']; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Your Email</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['email']; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Your Phone number</label>
				<input type="text" name="" class="form-control" value="<?php echo $row['phone']; ?>" readonly>
			</div>
			</div>
			<div class="col-md-5 mt-2 mx-auto">
				<p class="text-center text-danger">10th Details</p>
				<hr>
				<div class="form-group">
					<label>10th Roll number</label>
					<input type="text" name="" class="form-control" value="<?php echo $row['ten_roll']; ?>" readonly >
				</div>
				<div class="form-group">
					<label>10th Registration number</label>
					<input type="text" name="" class="form-control"value="<?php echo $row['ten_reg']; ?>" readonly >
				</div>
				<div class="form-group">
					<label>10th Result number</label>
					<input type="text" name="" class="form-control" value="<?php echo $row['ten_result']; ?>" readonly >
				</div>
				<p class="text-center text-danger">12th Details</p>
				<hr>
				<div class="form-group">
					<label>12th Roll number</label>
					<input type="text" name="" class="form-control"value="<?php echo $row['twe_roll']; ?>" readonly >
				</div>
				<div class="form-group">
					<label>12th Registration number</label>
					<input type="text" name="" class="form-control" value="<?php echo $row['twe_reg']; ?>" readonly >
				</div>
				<div class="form-group">
					<label>12th Result number</label>
					<input type="text" name="" class="form-control" value="<?php echo $row['twe_result']; ?>" readonly >
				</div>
			</div>
		</div>
		<!-- gradution details -->

		<div class="row mb-5">
			<div class="col-md-5	 mx-auto">
				<p class="text-center bg-primary mt-4 p-2 text-white text-capitalize">Graduation details</p>
				<div class="form-group">
					<label>Registration number</label>
					<input type="text" name="" value="<?php echo $row['g_reg']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Exam Roll number</label>
					<input type="text" name="" value="<?php echo $row['g_roll']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 1</label>
					<input type="text" name="" value="<?php echo $row['gsem1']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 2</label>
					<input type="text" name="" value="<?php echo $row['gsem2']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 3</label>
					<input type="text" name="" value="<?php echo $row['gsem3']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 4</label>
					<input type="text" name="" value="<?php echo $row['gsem4']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 5</label>
					<input type="text" name="" value="<?php echo $row['gsem5']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 6</label>
					<input type="text" name="" value="<?php echo $row['gsem6']?>" class="form-control" readonly="">
				</div>

			</div>
			<div class="col-md-5 mx-auto">
				<p class="text-center bg-primary mt-4 p-2 text-white text-capitalize">Diploma details</p>
				<div class="form-group">
					<label>Registration number</label>
					<input type="text" name="" value="<?php echo $row['d_reg']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Exam Roll number</label>
					<input type="text" name="" value="<?php echo $row['d_roll']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 1</label>
					<input type="text" name="" value="<?php echo $row['dsem1']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 2</label>
					<input type="text" name="" value="<?php echo $row['dsem2']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 3</label>
					<input type="text" name="" value="<?php echo $row['dsem3']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 4</label>
					<input type="text" name="" value="<?php echo $row['dsem4']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 5</label>
					<input type="text" name="" value="<?php echo $row['dsem5']?>" class="form-control" readonly="">
				</div>
				<div class="form-group">
					<label>Semester 6</label>
					<input type="text" name="" value="<?php echo $row['dsem6']?>" class="form-control" readonly="">
				</div>

			</div>
		</div>
	</div>
</body>
</html>
