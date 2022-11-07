<?php
//session_start();
//unset($_SESSION['email']);
//unset($_SESSION['pass']);

if(isset($_POST['submit'])){
   // $email=$_POST['email'];
    //$pass=$_POST['pass'];
    $con=new mysqli('localhost','root','','forms');
    $new_data=array("email"=>$_POST['email'],'password'=>$_POST['pass']);
    $c=0;
    if(filesize("login_data.json")==0){
        $file_record=array($new_data);
        $data_to_save=$file_record;
    }
    else{
        $old_record=json_decode(file_get_contents('login_data.json'));
        $c= count($old_record);
        echo $c;
        //$arr=$old_record[$c-1];
        //print_r($arr);
        array_push($old_record,$new_data);
        $data_to_save=$old_record;
    }
   if(!file_put_contents('login_data.json',json_encode($data_to_save,JSON_PRETTY_PRINT),LOCK_EX)){
     echo "Error occur";
   }
   /*else{
    //echo "success";
   }*/
   $row=json_decode(file_get_contents('login_data.json'));
   // true code $row=json_decode(file_get_contents('login_data.json'));
   //(array)json_decode(file_get_contents('login_data.json'));
   
   /* foreach($row as $key=> $value){
        echo $key." => ". $value;
    }
var_dump($row);*/

   $r=$row[$c];   // this used for [{''},{''}] code as $row[0];
   $email=$r->email; // this used for call {'key':'val'} code as   $r->key;
   $pass=$r->password;
    $sel="SELECT * FROM register WHERE email='$email' and password='$pass'";
    $result=$con->query($sel);
    //$row1=$result->fetch_assoc();
    if(!$result){
        echo "unvalid email and password";
      //  $_SESSION['email']=email;
       // $_SESSION['pass']=pass;
        exit();
    }
    else{
    echo '<script>alert("Correct email and password");</script>';

        echo  $r->password;
        echo "successfully process";
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
      .row input{
        height: 45px;
      }
      button:hover{
        background: green;
        color: white;
      }
  </style>
  <script type="text/javascript">
      $(document).ready(function(){
            $("#btn").click(function(){
                var email=$("#email").val();
                var pass=$("#pass").val();
                var button=$('#btn').val();
                $.post('login.php',{
                    email:email,
                    pass:pass,
                    submit:button
                },
                function(data,status){
                    if(data=="success"){
                        $("#response").html("<div class='alert alert-info'"+data+"</div>");
                    }
                    else{
                        $("#response").html("<div class='alert alert-info'"+data+"</div>");
                    }
                });

            });
      });
  </script>
</head>
<body>
<div class="container"  style="//background-color: #283593; padding:40px; ">   
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="
    background-color: rgba(255,255,255,0.13);
    
       
    
    border-radius: 10px;
    
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);



        " >
            <div class="container-fluid" style="color: yellow;background-color: #283593;box-shadow: 0px 0px 30px 0px #888888; border-radius:5px;"><center ><h3>LOG-IN</h3></center><br></div>
            <br><br><br>
            <div class="row form-group">
                <div class="col-lg-3 col-md-2 col-sm-2">
                </div>
                <div class="col-lg-6 col-md-8 col-sm-8">
                    <span id="response"></span>
           <h5> EMAIL ID</h5>   <input type="email" name="" id="email" class="form-control" placeholder="@gmail.com"
           required /><br>
             <h5>PASSWORD</h5><input type="password" name="" id="pass" class="form-control" placeholder="Ex: ssword14"
             required /><br>
             <br>
             <button type="submit" style="color: yellow;background-color: #283593; width: 30%;"value="Submit" id="btn"class="btn btn-primary">Login</button>
             <u><button onclick='window.location.href="register.php"' style="color: yellow;background-color: #283593;float: right; width: 30%;" class="btn btn-primary">Register
             </button>
            </u>
         </div>
                         
            <div class="col-lg-3 col-md-2 col-sm-2"></div>
            
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
        </div>

    </div>
</div>
</body>
</html>