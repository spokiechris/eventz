$(document).ready(function()  {
  //Haalt de event-ID uit de URL en verwijst sessies zonder event-ID terug.
  substring = window.location.search.substring(1);
  event_id = substring.replace('event-id=', '');
  if(!$.isNumeric(event_id)) {
    window.location.href="new-event.html"
  }

  //Weergeeft alle gebruikers als zoekresultaat.
  $.ajax({
    type: "POST",
    url: "https://php-test-chris.000webhostapp.com/invite-select-all.inc.php",
    beforeSend:function() {
      $("#search-result").html("<h1>Laden...</h1>")
    },
    error:function(error) {
      alert("Er is iets misgegaan...");
      $("#search-result").html("Probeer het later opnieuw");
      console.log(error);
    },
    success:function(data) {
      $("#search-result").html(data);
    }
  }); //end of .ajax

  //Weergeeft het zoekresultaat.
  $("#search-submit").click(function()  {
    let search_query=$("#search-query").val();
    if (search_query!="")  {
      $.ajax({
        type: "POST",
        url:"https://php-test-chris.000webhostapp.com/invite-search-query.inc.php",
        data:{
          search_query:search_query
        },
        beforeSend:function() {
          $("#search-submit").html("Laden...");
        },
        error:function()  {
          alert("Er is iets misgegaan...");
          $("#search-submit").html("Zoeken");
        },
        success:function(data){
          $("#search-result").html(data);
          $("#search-submit").html("Zoeken");
        }
      }); //end of .ajax
    } else {
      alert("De zoekbalk is leeg.");
    }
  }); //end of .click

  //Voegt uitgenodigde gebruikers toe aan het evenement.
  $("#search-result").on("click", "button", function(event)  {
    $(event.target).html("Uitgenodigd");
    $(event.target).css("background-color","#f3f3f3");
    user_id=event.target.id;
    $.ajax({
      type: "POST",
      url:"https://php-test-chris.000webhostapp.com/invite-user.inc.php",
      data:{
        user_id:user_id,
        event_id:event_id
      },
      error:function(data)  {
        alert("Er is iets misgegaan...");
        console.log(data);
      },
      success:function(data)  {
        if (data!="") {
          alert(data);
        }
      }
    }); //end of .ajax
  }); //end of .on
}); //end of .ready
