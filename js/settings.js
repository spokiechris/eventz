$(document).ready(function()  {
  //Logt de gebruiker uit en stuurt deze naar de log-in pagina.
  $("#log-out").click(function()  {
    user_id=localStorage.removeItem('user_id');
    username=localStorage.removeItem("username");
    window.location.href="index.html";
  });
});
