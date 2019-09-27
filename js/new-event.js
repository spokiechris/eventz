$(document).ready(function()  {
  //Stuurt de evenementgegevens naar new-event.inc.php en slaat het event-ID op in de URL.
  $("#event-submit").click(function() {
    let event_title=$("#event-title").val();
    let event_description=$("#event-description").val();
    let event_date=$("#event-date").val();
    let event_admin=localStorage.getItem('user_id');
    $.ajax({
      type: "POST",
      url: "https://php-test-chris.000webhostapp.com/new-event.inc.php",
      data:{
        event_title:event_title,
        event_description:event_description,
        event_date:event_date,
        event_admin:event_admin
      },
      beforeSend:function() {
        $("#event_submit").html("Laden...");
      },
      error:function(error) {
        alert("Er is iets misgegaan...");
        $("#event_submit").html("Event aanmaken");
        console.log(error);
      },
      success:function(data) {
        $("#event_submit").html("Event aanmaken");
        if ($.isNumeric(data))  {
          window.location.href="invite.html?event-id="+data;
        }
        else {
          alert(data);
        }
      }
    }); //end of .ajax
  }); //end of .click
}); //end of .ready
