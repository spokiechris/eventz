$(document).ready(function()  {
  //Stuurt de gegevens naar signup.inc.php en slaat de gebruikersnaam en het ID op.
  $("#signup-submit").click(function() {
    let mail=$("#mail").val();
    let username=$("#username").val();
    let password=$("#password").val();
      $.ajax({
        type:"POST",
        url:"https://php-test-chris.000webhostapp.com/signup.inc.php",
        dataType:"JSON",
        data:{
          mail:mail,
          username:username,
          password:password
        },
        beforeSend:function() {
          $("#signup-submit").html("Laden...");
        },
        error:function(error)  {
          alert("Er is iets misgegaan...");
          console.log(error);
          $("#signup-submit").html("Sign up");
        },
        success:function(data)  {
          $("#signup-submit").html("Sign up");
          if ($.type(data)=="object") {
            username=data["username"];
            user_id=data['user_id'];
            localStorage.setItem('username', username);
            localStorage.setItem('user_id', user_id);
            window.location.href="main.html";
          }
          else {
            alert(data);
          }
        }
      }); //end of .ajax
  }); //end of .click
}); // end of .ready
