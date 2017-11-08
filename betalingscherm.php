<!DOCTYPE html>
<?php 
include ("content/toolbar.php");
if (empty($_SESSION['gebruiker'])){
	echo "Je bent nog niet ingelogd";

}
else {
?>
<html>
	<head>
		<title>Bestelpagina</title>
	</head>
	<body>
	<h2 align="center">Betaalpagina</h2>
<?php
include 'functions.php';
include ("db/database.php");
$gebruiker = $_SESSION['gebruiker'];
$done = "undone";
 
			$usernameErr = $firstnameErr = $lastnameErr = $emailErr = $adressErr = $postalcodeErr = $cityErr = $phoneErr = "";
			$username = $firstname = $lastname = $email = $adress = $postalcode = $city = $phone =  "";
$gebruikersnaam = "";
$voornaam = "";
$achternaam = "";
$emailadres = "";
$adres = "";
$postcode = "";
$stad = "";
$telefoon = "";
?>

<form action="" method="post">
<input type="radio" name="radio" value="Accountgegevens">Accountgegevens
<input type="radio" name="radio" value="Andere">Andere gegevens
<input type="submit" name="submit" value="proceed" />
</form>
<br><br>



<?php
if (isset($_POST['submit'])) {
if(isset($_POST['radio'])){
	$keuze = $_POST['radio'];
?>
<br><br>
<?php
if (empty($keuze)){
	echo "Er zijn geen gegevens ingevuld";
}
else {
	if($keuze == "Accountgegevens"){
		//input field invullen met accountgegevens
		$query = "SELECT username, firstname, lastname, email, adress, postalcode, city, phone FROM user WHERE username = '$gebruiker'";


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
	

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	//Kijk of er een error is
	$hasError = false;
//testen of de velden zijn ingevuld
        if (empty($_POST['username'])) {
          $username_Err="je moet een gebruikersnaam invullen";
        }
        else {
		  $username_new = mysqli_real_escape_string($db, inputTest($_POST['username']));
		  if (!preg_match("/^[a-zA-Z\d]*$/",$username_new)) {
		      			$usernameErr = "Alleen letters en cijfers zijn toegestaan";
						$hasError = true;
 		   			}
        }

        if (empty($_POST['firstname'])) {
          $firstnameErr="je moet een voornaam invullen ";
        }
        else {
          $firstname_new = mysqli_real_escape_string($db, inputTest($_POST['firstname']));
		  if (!preg_match("/^[a-zA-Z]*$/",$firstname_new)) {
		      			$firstnameErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
		  }
        }

        if (empty($_POST['lastname'])) {
          $lastnameErr="je moet een achternaam invullen";
        }
        else {
          $lastname_new = mysqli_real_escape_string($db, inputTest($_POST['lastname']));
		  		    	if (!preg_match("/^[a-zA-Z]*$/",$lastname_new)) {
		      			$lastnameErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
						}
        }
        if (empty($_POST['email'])) {
          $emailErr="je moet een emailadres invullen";
        }
        else {
          $email_new = mysqli_real_escape_string($db, inputTest($_POST['email']));
		  if (!filter_var($email_new, FILTER_VALIDATE_EMAIL)) {
      					$emailErr = "E-mail is niet valide";
      					$hasError = true;
		  }
        }
		if (empty($_POST['adress'])) {
          $adressErr="je moet een adres invullen";
        }
        else {
          $adress_new = mysqli_real_escape_string($db, inputTest($_POST['adress']));
		  		    		if (!preg_match("/^[a-zA-Z\d ]*$/",$adress_new)) {
		      			$adressErr = "Alleen letters en cijfers zijn toegestaan";
		      			$hasError = true;
							}
        }
		if (empty($_POST['postalcode'])) {
          $postalcodeErr="je moet een postcode invullen";
        }
        else {
          $postalcode_new = mysqli_real_escape_string($db, inputTest($_POST['postalcode']));
        if(!preg_match('/^[1-9]{1}[0-9]{3}[A-Z]{2}$/', $postalcode_new)) {
		      			$postalcodeErr = "Postcode moet bestaan uit 4 cijfers en 2 letters.";
		      			$hasError = true;
		}
		}
		if (empty($_POST['city'])) {
          $cityErr="je moet een stad invullen";
        }
        else {
          $city_new = mysqli_real_escape_string($db, inputTest($_POST['city']));
			if (!preg_match("/^[a-zA-Z ]*$/",$city_new)) {
		      			$cityErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
			}
		}
		if (empty($_POST['phone'])) {
          $phoneErr="je moet een telefoonnummer invullen";
        }
        else {
          $phone_new = mysqli_real_escape_string($db, inputTest($_POST['phone']));
			if (!preg_match("/^[\d]*$/",$phone_new)) {
		      			$phoneErr = "Alleen cijfers zijn toegestaan";
		      			$hasError = true;
			}
		}
	
	}
	if ($_SERVER["REQUEST_METHOD"]=="POST" AND !empty($username_new) AND !empty($firstname_new) AND !empty($lastname_new) AND !empty($email_new) AND !empty($adress_new) AND !empty($postalcode_new) AND !empty($city_new) AND !empty($phone_new) AND !$hasError){
	  
		$done = "done";
		header('Location: bevesteging.php');
}
	else {
		//geen gegevens invullen
		echo "Vul andere gegevens in en klik op bevestigen";
	}
}
}
}
}
?>
<br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="left">  
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
  			<input type="submit" name="submit2" value="bevestigen">
</form>
<?php if (isset($_POST['submit2'])) {
		if($done == "done"){
			header('Location: bevesteging.php');
		}
		else {
			echo "Er zijn ergens nog geen gegevens in gevuld";
		}
}
?>	
</body>
</html>
<?php } ?>