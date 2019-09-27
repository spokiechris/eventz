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

$event_title=$_POST['event_title'];
$event_description=$_POST['event_description'];
$event_date=$_POST['event_date'];
$event_admin=$_POST['event_admin'];

//Controleert de velden.
if (empty($event_title) || empty($event_description) || empty($event_date) || empty($event_admin)) {
  echo "Vul alle velden in.";
  exit();
}
else {
  //Slaat de gegevens op in de database. 
  $sql="INSERT INTO event (event_title, event_description, event_date, event_admin) VALUES (?,?,?,?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Er is iets fout gegaan, probeer het later opnieuw...";
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, 'ssss', $event_title, $event_description, $event_date, $event_admin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $inserted_id = mysqli_insert_id($conn);
    echo $inserted_id;
  }
}
