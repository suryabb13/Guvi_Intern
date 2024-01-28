$(document).ready(function(){
        
    var mail= JSON.parse(localStorage.getItem("userData"));

      
        // console.log(key);
        if(mail!= null){
            var key =  mail.sec;
        $.ajax({
            type: "POST",
            url: "http://localhost/mysite/profile2.php",
            data:{
              key : key
            },

            cache: false,
            success: function(data3){
                if(data3){
                       var email=data3;
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/mysite/profile3.php",
                        data:{
                          
                           email: email,
                           
                        },
                        dataType: "json",
                        success: function (fun) {
                            
                                   
                            // console.log(fun.email,fun.fname , fun.lname , fun.mobile,fun.password);
                                    $("#fname").val(fun.fname || ''); 
                                    $("#lname").val(fun.lname || ''); 
                                    $("#mobile").val(fun.mobile || ''); 
                                    $("#dob").val(fun.dob || ''); 
                                    $("#email").text(fun.email);
                                    $("#password").val(fun.password || '') ;
                                    if(fun.gender=='Male')
                                    {
                                        $("#Male").prop("checked", true);
                                    }
                                    else if(fun.gender=='Female'){
                                        $("#Female").prop("checked", true);
                                    }
                                    else{
                                        $("#Male").prop("checked", false);
                                        $("#Female").prop("checked", false);

                                    }

                          
                        }
        
                     });

                }
            
            },
            error: function(xhr,status,error){
               console.log("not");
               console.error(xhr);
            }

        

      });

        }

    


    
    else {
     
        console.error("User data is null");
       
        window.location.href = "http://127.0.0.1:5500/html/index.html";
    }
  

       

        $("#update").click(function(){
            
            var fname=($("#fname")).val();
            var lname=($("#lname")).val();
            var mobile=($("#mobile")).val();
            var dob=($("#dob")).val();
            // var email=($(".email")).val();
            // var email=(key.email);
            var email= $("label[for='username']").text();
            var pwd=($("#password")).val();
            var gender=$("input[name='Gender']:checked").val();
            
            if(fname!='' && lname!='' && pwd!=''){
                $('#pwdmsg').empty();
            $.ajax({
                type: "POST",
                url: `http://localhost/mysite/profile.php`,
                data:{
                   
                   fname: fname,
                   lname: lname,
                   mobile: mobile,
                   dob: dob,
                   email: email,
                   pwd: pwd,
                   gender: gender
                },
               
                cache: false,
                success: function(data1){
                    // alert(data);
                    $('#pwdmsg').text(data1);
                    $('#pwdmsg').css("color", "green");
                 },
                 error: function(xhr,status,error){
                    console.error(xhr);
                 }
          });
        }
        else{
            $('#pwdmsg').text("Name, Email, Password must be filled!!");
        }
            
        });





    });

    $("#logout").click(function(){
            
        window.location.href = "http://127.0.0.1:5500/html/index.html"
        localStorage.removeItem("userData");
        
    });
