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

//Haalt de zoekterm op en voegt wildcards toe (dit is niet mogelijk bij de vraagtekens van het prepared statement).
$search_query = $_POST['search_query'];
$search_query = '%'.$search_query.'%';

//Vergelijkt de zoekvraag met alle gebruikersnamen en ID's.
$sql = "SELECT username, user_id FROM user WHERE user_id LIKE ? OR username LIKE ?;";
$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql))  {
  echo "Er is iets fout gegaan, probeer het later opnieuw...";
} else {
  mysqli_stmt_bind_param($stmt, 'ss', $search_query, $search_query);
  mysqli_stmt_execute($stmt);
  $result=mysqli_stmt_get_result($stmt);
  $numRows = mysqli_num_rows($result);
  if ($numRows>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div>"
              .$row['username']."(".$row['user_id'].")
              <button id='".$row['user_id']."'>Uitnodigen</button>
            </div>";
    }
  } else {
    echo "<h1>Geen resultaten...</h1>";
  }
}
?>
