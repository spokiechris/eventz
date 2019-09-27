$(document).ready(function()  {
  //haalt ID en gebruikersnaam op.
  user_id=localStorage.getItem('user_id');
  username=localStorage.getItem("username");

  //stuurt gebruikers die niet zijn ingelogd terug naar de log-in pagina.
  if (user_id==null) {
    window.location.href="index.html";
  }
  //Zet de gebruikersnaam en het ID in de header.
  else {
    $("#user-tag").html(username+"("+user_id+")");
  }
});



//
