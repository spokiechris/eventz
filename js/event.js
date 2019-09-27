$(document).ready(function() {
  //Haalt het event-ID uit de URL.
  substring=window.location.search.substring(1);
  event_id=substring.replace("event_id=","");

  //Haalt de informatie van het evenement op.
  $.ajax({
    type:"POST",
    url:"https://php-test-chris.000webhostapp.com/event.inc.php",
    data:{
      event_id:event_id
    },
    beforeSend:function() {

    },
    error:function(error) {
      alert("Er is iets misgegaan...");
      console.log(error);
    },
    success:function(data)  {
      $("article").html(data);
    }
  });
});
