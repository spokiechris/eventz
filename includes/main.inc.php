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

//Haalt alle evenementen waarvoor de gebruik is uitgenodigd op.
$sql="SELECT * FROM event WHERE event_id in (
        SELECT event_id FROM event_user WHERE user_id=?);";
$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo "Er is iets fout gegaan, probeer het later opnieuw...";
  exit();
} else {
  mysqli_stmt_bind_param($stmt, 's', $user_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<a href='event.html?event_id=".$row['event_id']."'><article>
          <h1>".$row['event_title']."</h1>
          <hr>
          <p>".$row['event_description']."</p>
          </article></a>\n";
  }

}
?>
