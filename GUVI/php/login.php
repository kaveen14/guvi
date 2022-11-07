<?php
require 'C:/xampp/htdocs/redis/vendor/autoload.php';
$redis=new Predis\Client();
if(isset($_POST['logout'])){
    $redis->flushall();
    echo <<<_END
    <script>window.location.href='../html/login.html'</script>
    _END;
}

if(isset($_POST['submit'])){
    $con=new mysqli('localhost','root','','forms');
    $new_data=array("email"=>$_POST['email'],'password'=>$_POST['pass']);
    $c=0;
    if(filesize("../json/login.json")==0){
        $file_record=array($new_data);
        $data_to_save=$file_record;
    }
    else{
        $old_record=json_decode(file_get_contents('../json/login.json'));
        $c= count($old_record);
        array_push($old_record,$new_data);
        $data_to_save=$old_record;
    }
   if(!file_put_contents('../json/login.json',json_encode($data_to_save,JSON_PRETTY_PRINT),LOCK_EX)){
     echo "Error occur";
   }
   $row=json_decode(file_get_contents('../json/login.json'));
    /*
    var_dump($row);*/

   $r=$row[$c];   // this used for [{''},{''}] code as $row[0];
   $email=$r->email; // this used for call {'key':'val'} code as   $r->key;
   $pass=$r->password;

    echo '<br>';

    $sel="SELECT * FROM `register` WHERE `email`='$email' AND `password`='$pass'";
    $result=$con->query($sel);
    $row1=$result->fetch_assoc();
    $num=$result->num_rows;
    if($num<1){
        echo '<script>alert("unvalid email and password");
        window.location.href="login.html";</script>';
        exit();
    }
    else{
    echo '<script>alert("Correct email and password");</script>';
    $view_data=array(
    'name' => $row1['name'],
    'dob'=>$row1['dob'],
    'age'=>$row1['age'],
    'gender'=>$row1['gender'],
    'nation'=>$row1['national'],
    'qualify'=>$row1['qualify'],
    'mobile'=>$row1['mobile'],
    'email'=>$row1['email'],
    'pass'=>$row1['password'],
    'address'=>$row1['address'],
    'state'=>$row1['state'],
    'city'=>$row1['city'],
    'pincode'=>$row1['pincode']
 );
 // only for storing the details in mongodb
$c1=0;
$f=0;
if(filesize("../json/profile.json")==0){
    $file_record1=array($view_data);
    $data_to_save1=$file_record1;
    if(!file_put_contents('../json/profile.json', json_encode($data_to_save1,JSON_PRETTY_PRINT),LOCK_EX)){
        $error="error storing message";
        exit();
    }
    
}
else{
$old_record1=json_decode(file_get_contents('../json/profile.json'));
foreach($old_record1 as $old){
    if(($old->email==$view_data['email']) and ($old->pass==$view_data['pass']))
    {
           $f=$f+1;
            break;
    }   
}
if($f==0){


    $c1= count($old_record1);
    array_push($old_record1,$view_data);
    $data_to_save1=$old_record1;


if(!file_put_contents('../json/profile.json', json_encode($data_to_save1,JSON_PRETTY_PRINT),LOCK_EX)){
    $error="error storing message";
    exit();
}
else{
    $success="message is stored success";
}
}

}
//mongodb checking
include 'C:/xampp/htdocs/mongo/vendor/autoload.php';
$connect=new MongoDB\Client('mongodb://localhost:27017');
$db=$connect->forms;
$tb =$db->Capped;

$em=$view_data['email'];
$pas=$view_data['pass'];

$filter=['email'=>$em,'pass'=>$pas];
$b=$tb->findOne($filter);
//var_dump($b);
if(!empty($b)){
    echo "data Already stored in database";
}
else{
$tb->insertOne($view_data);
echo<<<_END
<script>window.alert("Successfully registered data in mongoDB");</script>
_END;
}
    $redis->set('email',$email);
    $redis->set('password',$pass);
    //echo $row1[1];
    //echo "success ".$email;
    echo <<<_END
    <script >window.location.href="../php/profile.php";</script>
    _END;
    //exit();
    }
}
?>
