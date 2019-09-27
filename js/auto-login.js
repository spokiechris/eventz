//Stuurt ingelogde gebruikers automatisch naar hoofdpagina.
var user_id=localStorage.getItem('user_id');
if ($.isNumeric(user_id)) {
  window.location.href="main.html";
}





//
