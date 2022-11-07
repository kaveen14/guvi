<?php
/* It is successfully running
include 'C:/xampp/htdocs/mongo/vendor/autoload.php';
$connect=new MongoDB\Client('mongodb://localhost:27017');
$db=$connect->register;
$collection=$db->hi;
$cursor=$collection->find(); 
foreach($cursor as $result){
	print_r($result);
}
//$a=new MangoDB\Driver\Manager("mongodb://localhost:27017");
echo "Connection to database successfully";*/
$val=json_decode(file_get_contents('register_data.json'));
include 'C:/xampp/htdocs/mongo/vendor/autoload.php';
$connect=new MongoDB\Client('mongodb://localhost:27017');
$db=$connect->forms;
//$db->createCollection("posted");
/*var_dump($val);
foreach($val as $t){
	//var_dump($val[0]);
	$db->Capped->insertMany([$t]);
}*/
$tb=$db->Capped;
$cursor=$tb->find();
foreach($cursor as $result){
	echo($result['name']);
	echo "<br>";
}
require 'C:/xampp/htdocs/redis/vendor/autoload.php';
$redis=new Predis\Client();
//echo $redis->ping();
$c="hi I am kaveen";
$redis->set('name',$c);
//$redis->set('password','kaveen');
echo $redis->get('password');
echo '<br>';
$redis->expire('name',10);
echo $redis->get('name');
//$redis->flushall();
?>

<!--
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>profile page</title>
</head>
<body>

</body>
</html>-->