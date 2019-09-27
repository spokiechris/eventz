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

//Selecteert alle gebruikers en geeft deze door aan de browser. 
$sql = "SELECT username, user_id FROM user;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))    {
  echo "<div>"
          .$row['username']."(".$row['user_id'].")
          <button class='invite-button' id='".$row['user_id']."'>Uitnodigen</button>
        </div>";
}
?>
