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

$user_id=$_POST['user_id'];
$event_id=$_POST['event_id'];

//Controleert of de gebruiker al is uitgenodigd voor het evenement.
$sql="SELECT * FROM event_user WHERE user_id=? AND event_id=?";
$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql))  {
  echo "Er is iets fout gegaan, probeer het later opnieuw...";
  exit();
} else {
  mysqli_stmt_bind_param($stmt, 'ss', $user_id, $event_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $resultCheck=mysqli_stmt_num_rows($stmt);
  if ($resultCheck>0) {
    echo "Deze gebruiker is al uitgenodigd.";
  } else {

    //Slaat de gegevens op in de database. 
    $sql="INSERT INTO event_user (event_id, user_id) VALUES (?,?)";
    $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "Er is iets fout gegaan, probeer het later opnieuw...";
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, 'ss', $event_id, $user_id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
    }
  }
}
?>
