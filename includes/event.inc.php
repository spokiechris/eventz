<?php

header("Access-Control-Allow-Origin: *");

//begin dbh
$servername="108.167.189.42";
$dBUsername="ccjwagen_chris";
$dBPassword="Pek58vnmql";
$dBName="ccjwagen_phonegap";
$ConnectionPort="3306";
$tcpOrUdp="TCP";

$conn=mysqli_connect($servername, $dBUsername, $dBPassword, $dBName, $ConnectionPort, $tcpOrUdp);
//eind dbh

$event_id=$_POST['event_id'];

//Haalt alle informatie over het gekozen evenement op dat in de tabel 'event' staat.
$sql="SELECT * FROM event WHERE event_id=?;";
$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql))  {
  echo "Er is iets fout gegaan, probeer het later opnieuw...";
  exit();
} else {
  mysqli_stmt_bind_param($stmt, 's', $event_id);
  mysqli_stmt_execute($stmt);
  $result =mysqli_stmt_get_result($stmt);
  $result_array=mysqli_fetch_assoc($result);

  $event_title = $result_array['event_title'];
  $event_description = $result_array['event_description'];
  $event_date = $result_array['event_date'];
  $event_admin_id = $result_array['event_admin'];

  //Haalt de gebruikersnaam van de eigenaar van het gekozen evenement op.
  $sql="SELECT username FROM user WHERE user_id=?;";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))  {
    echo "Er is iets fout gegaan, probeer het later opnieuw...";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, 's', $event_admin_id);
    mysqli_stmt_execute($stmt);
    $result =mysqli_stmt_get_result($stmt);
    $result_array=mysqli_fetch_assoc($result);

    $event_admin = $result_array['username'];

    //Haalt de gebruikersnamen op van degenen die zijn uitgenodigd.
    $sql="SELECT username FROM user WHERE user_id IN (
    SELECT user_id FROM event_user WHERE event_id=?);";
    $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))  {
      echo "Er is iets fout gegaan, probeer het later opnieuw...";
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, 's', $event_id);
      mysqli_stmt_execute($stmt);
      $result =mysqli_stmt_get_result($stmt);

      //Maakt één unordered list van alle opgehaalde gebruikersnamen.
      $invited_users="";
      while ($row=mysqli_fetch_assoc($result))  {
        $invited_users = $invited_users."<li>".$row['username']."</li>";
      }

      //Geeft alle gegevens door aan de browser. 
      echo "<h1>".$event_title."</h1>
      <hr>
      <p id='date'>".$event_date."<p><p id='author-tag'>".$event_admin."</p>
      <br><br>
      <p>".$event_description."<p>
      <br>
      <h3>Uitgenodigd:</h3>
      <ul>
        ".$invited_users."
      <ul>";
    }
  }
}
