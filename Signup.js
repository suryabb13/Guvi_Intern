$(document).ready(function(){

$("#submit").click(function(e){
   e.preventDefault();
    var fname=($("#fname")).val();
    var lname=($("#lname")).val();
    var mobile=($("#mobile")).val();
    var dob=(($("#dob")) || null).val();
    var email=($("#email")).val();
    var pwd=($("#password")).val();
    var repwd=($("#re-password")).val();
    var em=0;
    var pd=0;
    var fill=false;
   
    
    if(fname!='' && lname!='' && pwd!='' && repwd!='' && email!='')
    {

         $('#pwdmsg').empty();
         fune();
         funp();
             if(em>0 && pd>0){
               
                  $.ajax({
                     type: "POST",
                     url: "http://localhost/mysite/Signup.php",
                     data:{
                        fname: fname,
                        lname: lname,
                        mobile: mobile,
                        dob: dob,
                        email: email,
                        pwd: pwd
                     },

                     cache: false,
                     success: function(data){
                        $('#pwdmsg').empty();
                        console.log(data);
                        $('#msg').text(data);
                       $('#msg').css("color", "green");
                     },
                     error: function(xhr,status,error){
                        console.log("not");
                        console.error(xhr);
                     }

               });
             }
            
         function fune(){
               if (IsEmail(email) === false) {
                  $('#emailmsg').text("Entered Email is not Valid!!");
                
                  return false;
               }  
               else{
                
                  $('#emailmsg').empty();
                  em +=1;
                
                  return true;
               }
   
               function IsEmail(email) {
                     const regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                     if (!regex.test(email)) {
                                 
                        return false;
                     }
                     else {
                        return true;
                     }
               }
            }    
         function funp(){
            if(pwd==repwd)
            {
               $('#pwdmsg').empty();
               pd+=1;
            }
            else{
               $('#pwdmsg').text("password not match");
            }
   
         }
           
       
      }
     

 
  else{
      $('#pwdmsg').text("Name, Email ,Password must be filled");
   }
   
   
   
   
});

});



