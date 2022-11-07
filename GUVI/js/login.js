$(document).ready(function(){
    $("#btn").click(function(){
        var email=$("#email").val();
        var pass=$("#pass").val();
        var button=$('#btn').val();
        $.post('../php/login.php',{  // call using ajax 
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