$("document").ready(function()  {
  //haalt alle evenementen voor deze gebruiker op.
  $.ajax({
    type:"POST",
    url:"https://php-test-chris.000webhostapp.com/main.inc.php",
    data:{
      user_id:user_id
    },
    beforeSend:function() {
      $("main").html("<h1 class='message'>Laden...</h1>");
    },
    error:function(error)  {
      alert("Er is iets misgegaan...");
      $("main").html("<h1 class='message'>Probeer het later opnieuw</h1>");
      console.log(error);
    },
    success:function(data) {
      if (data=="")  {
        $("main").html("<h1 class='message'>Helaas, u bent nog niet uitgenodigd voor een evenement. Maak er zelf een aan!</h1>");
      }
      else {
        $("main").html(data);
      }
    }
  });
});
