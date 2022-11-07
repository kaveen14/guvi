<?php
if(isset($_POST['submit'])){
	
	$con=new mysqli("localhost","root","","forms");
	$new_message=array(
		'name' => $_POST['name'],
		'dob'=>$_POST['dob'],
		'age'=>$_POST['age'],
		'gender'=>$_POST['gender'],
		'nation'=>$_POST['nation'],
		'qualify'=>$_POST['qualify'],
		'college'=>$_POST['college'],
		'adhar'=>$_POST['adhar'],
		'mobile'=>$_POST['mobile'],
		'email'=>$_POST['email'],
		'pass'=>$_POST['password'],
		'address'=>$_POST['address'],
		'state'=>$_POST['state'],
		'city'=>$_POST['city'],
		'pincode'=>$_POST['pincode'],
		'photo'=>" "
	 );
	$c=0;
	if(filesize("register_data.json")==0){
		$file_record=array($new_message);
		$data_to_save=$file_record;
	}
	else{
		$old_record=json_decode(file_get_contents('register_data.json'));
		
		$c= count($old_record);
		/*echo $c;
		$t=$c-1;*/
		array_push($old_record,$new_message);
		$data_to_save=$old_record;
	}
	if(!file_put_contents('register_data.json', json_encode($data_to_save,JSON_PRETTY_PRINT),LOCK_EX)){
		$error="error storing message";
		exit();
	}
	else{
		$success="message is stored success";
		$row=$old_record[$c];
		/*foreach ($old_record[$c] as $key => $value) {
			echo $value." ";
		} */
		//echo $row['name'];
		include 'C:/xampp/htdocs/mongo/vendor/autoload.php';
		$connect=new MongoDB\Client('mongodb://localhost:27017');
		$db=$connect->forms;
		$db->Capped->insertOne($row);
	}

	$name=$row['name'];
	$dob=$row['dob'];
	$age=$row['age'];
	$gender=$row['gender'];
	$nation=$row['nation'];
	$qualify=$row['qualify'];
	$college=$row['college'];
	$adhar=$row['adhar'];
	$mobile=$row['mobile'];
	$email=$row['email'];
	$pass=$row['password'];
	$address=$row['address'];
	$state=$row['state'];
	$city=$row['city'];
	$pincode=$row['pincode'];
	$photo=" ";
	
	/*$insert="INSERT INTO register(name,dob,age,gender,national,qualify,college,aadhar,mobile,email,password,address,state,city,pincode,photo) VALUES('$row["name"]','$row["dob"]',$row["age"],'$row["gender"]','$row["nation"]','$row["qualify"]','$row["college"]',$row["adhar"],$row["mobile"],'$row["email"]','$row["pass"]','$row["address"]','$row["state"]','$row["city"]',$row["pincode"],'$row["photo"]')";*/
	$insert="INSERT INTO register(name,dob,age,gender,national,qualify,college,aadhar,mobile,email,password,address,state,city,pincode,photo) VALUES('$name','$dob',$age,'$gender','$nation','$qualify','$college',$adhar,$mobile,'$email','$pass','$address','$state','$city',$pincode,'$photo')";
	$result=$con->query($insert);
	if($result==TRUE)
	{
		echo "<script>alert('Successfully registered');window.location.href='login.php';</script>";
		echo "success ".$name;
		exit();
	}
	else{
	    echo "<script>alert('Error occur'".$con->ErrorInfo.");</script>"; 
	     // keyword is wrong please check onetime kaveen
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration page</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style type="text/css">
	.row input{
		height: 45px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btn").click(function(){
			var name=$("#name").val();
			var dob=$("#dob").val();
			var age=$("#age").val();
			var gender=$("#gender").val();
			var nation=$("#nation").val();
			var qualify=$("#qualify").val();
			var college=$("#detail").val();
			var adhar=$("#adhar").val();
			var mobile=$("#mobile").val();
			var email=$("#email").val();
			var password=$("#pass").val();
			var address=$("#address").val();
			var state=$("#state").val();
			var city=$("#city").val();
			var pincode=$("#pincode").val();
			var button=$("#btn").val();
			//call ajax here
			$.post("register.php",{
				name:name,
				dob:dob,
				age:age,
				gender:gender,
				nation:nation,
				qualify:qualify,
				college:college,
				adhar:adhar,
				mobile:mobile,
				email:email,
				password:password,
				address:address,
				state:state,
				city:city,
				pincode:pincode,
				submit:button

			},
			function(data,status){
					if(data=="success"){
						$('#response').html("<div class='alert alert-info'>"+data+"</div>");
					}
					else{
						$('#response').html("<div class='alert alert-info'>"+data+"</div>");
					}
			});
		});
	});

</script>
<body>
<div class="container-fluid" style="background-color: #283593; padding:20px;  box-shadow: 0px 10px 18px #888888;
border-radius: 10px;">
	<center style="color: yellow;"><h2>REGISTERATION FORM</h2></center>
</div>

<br><br><br><!--<span id="response"></span>-->
<br>
<div class="container-fluid">
	<div class="row"> 
	<div class="col-lg-4 col-md-3 col-sm-3">
		
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6">
		<span id="response"></span>
    <input type="text" name="name" id="name" placeholder="Name" class="form-control" required /><br>
	<input type="date" name="dob" id="dob" placeholder="Date Of Birth" class="form-control" required/><br>
	<input type="number" name="age" id="age" placeholder="Age" class="form-control" required/><br>
	<select name="gender" id="gender" placeholder="Gender" class="form-control" required >
		<option value="Male">Male</option>
		<option value="Female">Female</option>
		<option value="Others">Others</option>
	</select><br>
	<!--<input type="text" name="gender" id="gender" placeholder="Gender" class="form-control" required/><br>-->
	<input type="text" name="nation" id="nation" placeholder="Nationality" class="form-control" required/><br>
	<input type="text" name="qualify" id="qualify" placeholder="Qualification" class="form-control" required/><br>
	<!--<input type="radio" name="det" id="det" class="form-check-label" required/><br>-->
	<input type="text" name="detail" id="detail" placeholder="Specify company name/ college name" class="form-control" required/><br>
	<input type="number" name="adhar" id="adhar" placeholder="Aadhar ID Number" class="form-control" required/><br>
	<input type="number" name="mobile" id="mobile" placeholder="Mobile Number" class="form-control" required/><br>
	<input type="email" name="email" id="email" placeholder="Email id" class="form-control" required/><br>
	<input type="password" name="pass" id="pass" placeholder="Password" class="form-control" required/><br>
	<textarea type="text" rows="4" cols="50" name="address" id="address" placeholder="Address..." class="form-control" required></textarea><br>
	<input type="text" name="state" id="state" placeholder="State" class="form-control" required/><br>
	<input type="text" name="city" id="city" placeholder="City" class="form-control" required/><br>
	<input type="number" name="pincode" id="pincode" placeholder="pincode" class="form-control" required/><br>
	<!--<input type="submit" name="submit" id="btn" class="form-control"/>-->
	<button class="btn btn-primary" id="btn" value="Submit" style="float:center;">submit</button>
		<button onclick='window.location.href="login.php"' class="btn btn-primary" style="float:right;">Login</button>
	</div>
	<div class="col-lg-4 col-md-3 col-sm-3">
	
	<br>
	
</div>
</body>
</html>