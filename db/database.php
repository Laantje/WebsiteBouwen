<?php
  //Database connection configuratie
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = ""; //Alleen veranderen als er een wachtwoord is toegepast
  $dbname = "wasknijperdb";
  $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  //De connectie testen
  if(mysqli_connect_errno()) {
    die("De verbinding met de database is mislukt: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
  }
?>