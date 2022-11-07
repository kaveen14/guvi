
<?php
require 'C:/xampp/htdocs/redis/vendor/autoload.php';
$redis=new Predis\Client();
$emailr=$redis->get('email');
$passr=$redis->get('password');
//echo $email;
if(empty($emailr) and empty($passr)){
	echo <<<_END
    <script >window.alert("Wrong access");
    window.location.href="../html/login.html";</script>
    _END;    
}
else{
//It is successfully running
include 'C:/xampp/htdocs/mongo/vendor/autoload.php';
$connect=new MongoDB\Client('mongodb://localhost:27017');
$val=json_decode(file_get_contents('../json/register.json'));
$db=$connect->forms;
$tb=$db->Capped;
$filter=['email'=>$emailr , 'pass'=>$passr];
$cursor=$tb->find($filter);
$i=0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>profile page</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../js/profile.js">
  </script>
  <link href='../css/profile.scss' rel="stylesheet"/>
</head>
<body>
<?php

foreach($cursor as $row){
	
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
		

}
//$redis->flushall();
}
?>

<div class="container">
	
	    <center><h3><b>Welcome </b><h4><?php echo $name;?></h4></h3></center>
<table class="table table-hover" ><tbody>
	<tr><th> Date of Birth : </th> <td><?php echo $dob;?> </th></tr>
	<tr><th> Age : </th><td> <?php echo $age; ?> </td></tr>
	<tr><th> Gender : </th><td><?php echo  $gender; ?> </td></tr>
	<tr><th> Nationality : </th><td><?php echo $nation; ?> </td></tr>
	<tr><th> qualification : </th><td> <?php echo $qualify; ?> </td></tr>
	<tr><th> Mobile number : </th><td><?php echo  $mobile; ?> </td></tr>
	<tr><th> Email ID : </th><td><?php echo $email; ?> </td></tr>
	<tr><th> Address : </th><td> <?php echo $address; ?> </td></tr>
	<tr><th> State : </th><td><?php echo  $state; ?> </td></tr>
	<tr><th> City : </th><td><?php echo $city; ?> </td></tr>
	<tr><th> Pincode : </th><td><?php echo $pincode; ?> </td></tr>
	<tr><th></th><td><button id='logout' onclick="window.location.href='../html/login.html'" name="logout" value="log-out" class="btn btn-primary">Logout </button>
</td></tr>
</tbody>
</table>
</div>

</body>
</html>