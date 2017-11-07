<!DOCTYPE html>

<html>
	<head>
		<title>Accountinstellingen</title>
	</head>
	<body>
	<h2 align="center">Accountinstellingen</h2>
<?php
include 'database.php';
include 'functions.php';
$naam = "persoon1";



			// Initiëren van variabelen en ze "lege" waarde toekennen
			$usernameErr = $firstnameErr = $lastnameErr = $emailErr = $adressErr = $postalcodeErr = $cityErr = $phoneErr = "";
			$username = $firstname = $lastname = $email = $adress = $postalcode = $city = $phone =  "";

$query = "SELECT username, firstname, lastname, email, adress, postalcode, city, phone FROM user WHERE username = '$naam'";


$result = mysqli_query($db, $query);
$gegevens = mysqli_fetch_assoc($result);

	$gebruikersnaam = $gegevens['username'];
	$voornaam = $gegevens['firstname'];
	$achternaam = $gegevens['lastname'];
	$emailadres = $gegevens['email'];
	$adres = $gegevens['adress'];
	$postcode = $gegevens['postalcode'];
	$stad = $gegevens['city'];
	$telefoon = $gegevens['phone'];

?>
<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
//testen of de velden zijn ingevuld
        if (empty($_POST['username'])) {
          $username_Err="je moet een gebruikersnaam invullen";
        }
        else {
          $username_new = mysqli_real_escape_string($db, inputTest($_POST['username']));
		  if (!preg_match ("/^[a-zA-Z\d]*$/",$username)) {
			  $usernameErr = "Alleen letters en cijfers zijn toegestaan";
		  }
			  
        }

        if (empty($_POST['firstname'])) {
          $firstnameErr="je moet een voornaam invullen ";
        }
        else {
          $firstname_new = mysqli_real_escape_string($db, inputTest($_POST['firstname']));
        }

        if (empty($_POST['lastname'])) {
          $lastnameErr="je moet een achternaam invullen";
        }
        else {
          $lastname_new = mysqli_real_escape_string($db, inputTest($_POST['lastname']));
        }
        if (empty($_POST['email'])) {
          $emailErr="je moet een emailadres invullen";
        }
        else {
          $email_new = mysqli_real_escape_string($db, inputTest($_POST['email']));
        }
		if (empty($_POST['adress'])) {
          $adressErr="je moet een adres invullen";
        }
        else {
          $adress_new = mysqli_real_escape_string($db, inputTest($_POST['adress']));
        }
		if (empty($_POST['postalcode'])) {
          $postalcodeErr="je moet een postcode invullen";
        }
        else {
          $postalcode_new = mysqli_real_escape_string($db, inputTest($_POST['postalcode']));
        }
		if (empty($_POST['city'])) {
          $cityErr="je moet een stad invullen";
        }
        else {
          $city_new = mysqli_real_escape_string($db, inputTest($_POST['city']));
        }
		if (empty($_POST['phone'])) {
          $phoneErr="je moet een telefoonnummer invullen";
        }
        else {
          $phone_new = mysqli_real_escape_string($db, inputTest($_POST['phone']));
        }
	if ($_SERVER["REQUEST_METHOD"]=="POST" AND !empty($username_new) AND !empty($firstname_new) AND !empty($lastname_new) AND !empty($email_new) AND !empty($adress_new) AND !empty($postalcode_new) AND !empty($city_new) AND !empty($phone_new)){

    $update="UPDATE user SET username = '$username_new', firstname = '$firstname_new', lastname = '$lastname_new', email ='$email_new', adress ='$adress_new', postalcode = '$postalcode_new', city = '$city_new', phone = '$phone_new' WHERE username = '$naam';";

	          if(mysqli_query($db, $update)){
				  echo "het is gelukt!";
			  }
			  else {
				  echo "Updaten is niet gelukt.";
			  }
    } else {
	echo "Het veranderen van de gegevens is niet gelukt, er was nog een veld open of niet goed ingevuld";
	}
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center">  
  			Gebruikersnaam: <input type="text" name="username" value="<?php echo $gebruikersnaam;?>">
  			<span class="error">* <?php echo $usernameErr;?></span>
  			<br><br>
  			Voornaam: <input type="text" name="firstname" value="<?php echo $voornaam;?>">
  			<span class="error">* <?php echo $firstnameErr;?></span>
  			<br><br>
  			Achternaam: <input type="text" name="lastname" value="<?php echo $achternaam;?>">
  			<span class="error">* <?php echo $lastnameErr;?></span>
  			<br><br>
  			E-mail: <input type="text" name="email" value="<?php echo $emailadres;?>">
  			<span class="error">* <?php echo $emailErr;?></span>
  			<br><br>
  			Adres: <input type="text" name="adress" value="<?php echo $adres;?>">
  			<span class="error">* <?php echo $adressErr;?></span>
  			<br><br>
  			Postcode: <input type="text" name="postalcode" value="<?php echo $postcode;?>">
  			<span class="error">* <?php echo $postalcodeErr;?></span>
  			<br><br>
  			Woonplaats: <input type="text" name="city" value="<?php echo $stad;?>">
  			<span class="error">* <?php echo $cityErr;?></span>
  			<br><br>
  			Telefoonnummer: <input type="text" name="phone" value="<?php echo $telefoon;?>">
  			<span class="error">* <?php echo $phoneErr;?></span>
  			<br><br>
  			<input type="submit" name="submit" value="Veranderen">
</form>




</body>
</html>