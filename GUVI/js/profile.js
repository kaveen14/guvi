$(document).ready(function(){
    $("#logout").click(function(){
        var button=$('#logout').val();
        $.post('../php/login.php',{  // call using ajax 
            logout:button
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