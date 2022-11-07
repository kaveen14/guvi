	$(document).on('click','#btn',function(e){
		
		e.preventDefault();
        var name=$("#name").val();
        var dob=$("#dob").val();
        var age=$("#age").val();
        var gender=$("#gender").val();
        var nation=$("#nation").val();
        var qualify=$("#qualify").val();
        var mobile=$("#mobile").val();
        var email=$("#email").val();
        var password=$("#pass").val();
        var address=$("#address").val();
        var state=$("#state").val();
        var city=$("#city").val();
        var pincode=$("#pincode").val();
        var button=$("#btn").val();
		var atpos  = email.indexOf('@');
		var dotpos = email.lastIndexOf('.com');
			
		if(name == ''){ // check username not empty
			alert('please enter username !!'); 
		}
		else if(!/^[a-z A-Z]+$/.test(name)){ // check username allowed capital and small letters 
			alert('username only capital and small letters are allowed !!'); 
		}
        else if(dob==''){
            alert('please enter the date of birth');
        }
        else if(age==0){
            alert('please enter the age');
        }
        else if(gender==''){
            alert('please enter the gender');
        }
        else if(nation==''){
            alert('please enter the nationality');
        }
        else if(qualify==''){
            alert('please enter the qualification');
        }
        else if(mobile==''){
            alert('please enter the mobile');
        }
		else if(email == ''){ //check email not empty
			alert('please enter email address !!'); 
		}
		else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){ //check valid email format
			alert('please enter valid email address !!'); 
		}
		else if(password == ''){ //check password not empty
			alert('please enter password !!'); 
		}
		else if(password.length < 6){ //check password value length six 
			alert('password must be 6 !!');
		}
        else if(address=='' ){
            alert('please enter the address');
        }
        else if(state==''){
            alert('please enter the state');
        }
        else if(city==''){
            alert('please enter the city');
        }
        else if(pincode==''){
            alert('please enter the pincode');
        }
		else{	
            alert('successfully');		
			$.ajax({
				url:"../php/register.php",
				type: "POST",
				data: 
					{
            name:name,
            dob:dob,
            age:age,
            gender:gender,
            nation:nation,
            qualify:qualify,
            mobile:mobile,
            email:email,
            password:password,
            address:address,
            state:state,
            city:city,
            pincode:pincode,
            submit:button,
            
					},
				success: function(response){
                    
					$('#message').html(response);
                   /* if(response != 0){
                        $("#photo").attr("src",response); 
                        $(".preview img").show(); // Display image element
                     }else{
                        alert('file not uploaded');
                     }*/
				}
			});
				
			$('#registraion_form')[0].reset();
		}
        
	});

