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

$mail=$_POST['mail'];
$password=$_POST['password'];

//Controleert de ingevulde velden.
if (empty($mail) || empty($password))  {
  echo "Vul alle velden in. ";
  exit();
}
else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  echo "Uw e-mailadres is ongeldig. ";
  exit();
}
else {
  
  //Controleert of de gebruiker bestaat, controleert vervolgens het wachtwoord.
  $sql="SELECT * FROM user WHERE email=?";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Er is iets fout gegaan, probeer het later opnieuw...";
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, 's', $mail);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $passwordCheck=password_verify($password, $row['password']);
      if ($passwordCheck==false) {
        echo "Verkeerd wachtwoord, probeer het opnieuw...";
        exit();
      }
      elseif ($passwordCheck==true) {

        //Om 2 verschillende variabelen door te geven, worden ze omgezet tot JSON-pakket.
        $user_id = $row['user_id'];
        $username= $row['username'];
        echo json_encode(array("user_id"=>"$user_id","username"=>"$username"));
      }

    }
  }
}

?>
