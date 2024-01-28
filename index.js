$(document).ready(function(){

    $("#submit").click(function(e){
       e.preventDefault();
        var email=($("#email")).val();
        var pwd=($("#password")).val();
       // console.log(email,pwd);

        
        
         if(email!='' && pwd!=''){
            $('#msg').empty(); 
            $.ajax({
                type: "POST",
                url: "http://localhost/mysite/index1.php",
                data:{
                  
                   email: email,
                   pwd: pwd
                },
                dataType: "json",
                success: function (data) {
                    
                    if (data.success) 
                    {    
                      
                        localStorage.setItem("userData", JSON.stringify(data));
                         window.location.href = "http://127.0.0.1:5500/html/profile.html";
                       
                    }

                    else {
                        $('#output').empty(); 
                        $("#output").text(data.message);
                        $('#output').css("color", "red");
                    }
                }

             });
            
         }

      else{
         $('#output').empty(); 
            $('#msg').text("Enter id and password!!");
         }

    });

});
