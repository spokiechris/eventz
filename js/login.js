$(document).ready(function()  {
  //Stuurt gegevens naar login.inc.php en slaat de gebruikersnaam en het ID op.
  $("#login-submit").click(function() {
    let mail=$("#mail").val();
    let password=$("#password").val();
      $.ajax({
        type:"POST",
        url:"https://php-test-chris.000webhostapp.com/login.inc.php",
        dataType:"JSON",
        data:{
          mail:mail,
          password:password
        },
        beforeSend:function() {
          $("#login-submit").html("Laden...");
        },
        error:function(error)  {
          alert("Er is iets misgegaan...");
          console.log(error);
          $("#login-submit").html("Log in");
        },
        success:function(data)  {
          $("#login-submit").html("Log in");
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
