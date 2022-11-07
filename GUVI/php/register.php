<?php
if(isset($_POST['submit'])){
	$filepath="";
if(isset($_FILES['photo'])){
$filepath ="assets/".$_FILES["photo"]["name"];
//echo $filepath."<br>";

if(move_uploaded_file($_FILES["photo"]["tmp_name"], $filepath)) 
{
echo "<script>window.alert('<img src=".$filepath." height=200 width=300 />');</script>";
exit();
} 
else 
{
echo '<script>alert("Error in uploading photo so made correct it  !!")</script>';
exit();
}
}

	$con=new mysqli("localhost","root","","forms");
	$new_message=array(
		'name' => $_POST['name'],
		'dob'=>$_POST['dob'],
		'age'=>$_POST['age'],
		'gender'=>$_POST['gender'],
		'nation'=>$_POST['nation'],
		'qualify'=>$_POST['qualify'],
		'mobile'=>$_POST['mobile'],
		'email'=>$_POST['email'],
		'pass'=>$_POST['password'],
		'address'=>$_POST['address'],
		'state'=>$_POST['state'],
		'city'=>$_POST['city'],
		'pincode'=>$_POST['pincode']
	 );
	$c=0;
	if(filesize("../json/register.json")==0){
		$file_record=array($new_message);
		$data_to_save=$file_record;
	}
	else{
		$old_record=json_decode(file_get_contents('../json/register.json'));
		$c= count($old_record);
		array_push($old_record,$new_message);
		$data_to_save=$old_record;
	}
	if(!file_put_contents('../json/register.json', json_encode($data_to_save,JSON_PRETTY_PRINT),LOCK_EX)){
		$error="error storing message";
		exit();
	}
	else{
		$success="message is stored success";
		$old_record=json_decode(file_get_contents('../json/register.json'));
		$row=$old_record[$c];
		/*foreach ($old_record[$c] as $key => $value) {
			echo $value." ";
		} */
		//echo $row['name'];
	}

	$name=$row->name;
	$dob=$row->dob;
	$age=$row->age;
	$gender=$row->gender;
	$nation=$row->nation;
	$qualify=$row->qualify;
	$mobile=$row->mobile;
	$email=$row->email;
	$pass=$row->pass;
	$address=$row->address;
	$state=$row->state;
	$city=$row->city;
	$pincode=$row->pincode;
	
	$insert="INSERT INTO `register`(`name`,`dob`,`age`,`gender`,`national`,`qualify`,`mobile`,`email`
	,`password`,`address`,`state`,`city`,`pincode`) VALUES('$name','$dob',$age,'$gender','$nation'
	,'$qualify',$mobile,'$email','$pass','$address','$state','$city',$pincode)";
	$result=$con->query($insert);
	if($result==TRUE)
	{
		echo '<script>alert("Successfully registered");window.location.href="../html/login.html";</script>';
		echo "success ".$name;
//		exit();
	}
	else{
	    echo "<script>alert('Error occur'".$con->ErrorInfo.");</script>"; 
	     // keyword is wrong please check onetime kaveen
//		exit();
	}
}
?>
