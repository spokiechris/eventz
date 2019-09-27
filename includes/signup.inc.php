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
$username=$_POST['username'];
$password=$_POST['password'];

//Controleert de ingevulde velden.
if (empty($mail) || empty($username) || empty($password))  {
  echo "Vul alle velden in. ";
  exit();
}
else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  echo "Uw e-mailadres is ongeldig. ";
  exit();
}
else {
  //Controleert of de gebruiker al bestaat.
  $sql = "SELECT email FROM user WHERE email=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))  {
    echo "Er is iets fout gegaan, probeer het later opnieuw...";
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, 's', $mail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $numRows=mysqli_stmt_num_rows($stmt);
    if ($numRows>0) {
      echo "Dit e-mailadres is al in gebruik, heeft u al een account?";
      exit();
    }
    else {

      //Slaat de gegevens op in de database. 
      $sql = "INSERT INTO user (email, username, password) VALUES (?,?,?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Er is iets fout gegaan, probeer het later opnieuw...";
        exit();
      }
      else {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'sss', $mail, $username, $hashedpassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $inserted_id = mysqli_insert_id($conn);
        echo json_encode(array("user_id"=>"$inserted_id","username"=>"$username"));

      }
    }
  }
}

?>
