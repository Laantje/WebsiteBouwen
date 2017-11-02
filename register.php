<HTML>
	<HEAD>
		<TITLE>Website Titel</TITLE>
		<style>
			.error {color: #FF0000;}
		</style>
	</HEAD>
	<BODY BGCOLOR="FFFFFF">
		<?php
			// Initiëren van variabelen en ze "lege" waarde toekennen
			$usernameErr = $passwordErr = $firstnameErr = $lastnameErr = $emailErr = $adressErr = $postalcodeErr = $cityErr = $phoneErr = $genderErr = "";
			$username = $password = $firstname = $lastname = $email = $adress = $postalcode = $city = $phone = $gender = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
  				if (empty($_POST["username"])) {
    				$usernameErr = "Gebruikersnaam is verplicht";
  				} else {
		    		$username = test_input($_POST["username"]);
		    		// check of $username uitsluitend uit letters en nummers bestaan
		    		if (!preg_match("/^[a-zA-Z\d]*$/",$username)) {
		      			$usernameErr = "Alleen letters en cijfers zijn toegestaan";
 		   			}
 		 		}

 		 		if (empty($_POST["password"])) {
    				$passwordErr = "Wachtwoord is verplicht";
  				} else {
		    		$password = test_input($_POST["password"]);
		    		// check of $password uitsluitend uit letters en nummers bestaan
		    		if (!preg_match("/^[a-zA-Z\d]*$/",$password)) {
		      			$passwordErr = "Alleen letters en cijfers zijn toegestaan";
 		   			}
 		 		}

 		 		if (empty($_POST["firstname"])) {
    				$firstnameErr = "Voornaam is verplicht";
  				} else {
		    		$firstname = test_input($_POST["firstname"]);
		    		// check of $firstname uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z]*$/",$firstname)) {
		      			$firstnameErr = "Alleen letters zijn toegestaan";
 		   			}
 		 		}

 		 		if (empty($_POST["lastname"])) {
    				$lastnameErr = "Lastname is verplicht";
  				} else {
		    		$lastname = test_input($_POST["lastname"]);
		    		// check of $lastname uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z]*$/",$lastname)) {
		      			$lastnameErr = "Alleen letters zijn toegestaan";
 		   			}
 		 		}

  				if (empty($_POST["email"])) {
    				$emailErr = "Email is verplicht";
  				} else {
    				$email = test_input($_POST["email"]);
    				// check of het e-mailadres aan de eisen voldoet
    				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      					$emailErr = "E-mail is niet valide";
    				}
  				}
  				
  				if (empty($_POST["adress"])) {
    				$adressErr = "Adres is verplicht";
  				} else {
		    		$adress = test_input($_POST["adress"]);
		    		// check of $adress uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z\d ]*$/",$adress)) {
		      			$adressErr = "Alleen letters en cijfers zijn toegestaan";
 		   			}
 		 		}

 		 		if (empty($_POST["postalcode"])) {
    				$postalcodeErr = "Postcode is verplicht";
  				} else {
		    		$postalcode = test_input($_POST["postalcode"]);
		    		// check of $postalcode uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z\d]*$/",$postalcode)) {
		      			$postalcodeErr = "Alleen letters en cijfers zijn toegestaan";
 		   			}
 		 		}

 		 		if (empty($_POST["city"])) {
    				$cityErr = "Woonplaats is verplicht";
  				} else {
		    		$city = test_input($_POST["city"]);
		    		// check of $lastname uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
		      			$cityErr = "Alleen letters zijn toegestaan";
 		   			}
 		 		}

 		 		if (empty($_POST["phone"])) {
    				$phoneErr = "Telefoonnummer is verplicht";
  				} else {
		    		$phone = test_input($_POST["phone"]);
		    		// check of $phone uitsluitend uit letters bestaan
		    		if (!preg_match("/^[\d]*$/",$phone)) {
		      			$phoneErr = "Alleen cijfers zijn toegestaan";
 		   			}
 		 		}

  				if (empty($_POST["gender"])) {
    				$genderErr = "Geslacht is verplicht";
  				} else {
    				$gender = test_input($_POST["gender"]);
  				}
			}

			function test_input($data) {
  				$data = trim($data);
  				$data = stripslashes($data);
  				$data = htmlspecialchars($data);
  				return $data;
			}
		?>

		<h1 align="center">Register</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center">  
  			Gebruikersnaam: <input type="text" name="username" value="<?php echo $username;?>">
  			<span class="error">* <?php echo $usernameErr;?></span>
  			<br><br>
  			Wachtwoord: <input type="password" name="password" value="">
  			<span class="error">* <?php echo $passwordErr;?></span> 
  			<br><br>
  			Voornaam: <input type="text" name="firstname" value="<?php echo $firstname;?>">
  			<span class="error">* <?php echo $firstnameErr;?></span>
  			<br><br>
  			Achternaam: <input type="text" name="lastname" value="<?php echo $lastname;?>">
  			<span class="error">* <?php echo $lastnameErr;?></span>
  			<br><br>
  			E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  			<span class="error">* <?php echo $emailErr;?></span>
  			<br><br>
  			Adres: <input type="text" name="adress" value="<?php echo $adress;?>">
  			<span class="error">* <?php echo $adressErr;?></span>
  			<br><br>
  			Postcode: <input type="text" name="postalcode" value="<?php echo $postalcode;?>">
  			<span class="error">* <?php echo $postalcodeErr;?></span>
  			<br><br>
  			Woonplaats: <input type="text" name="city" value="<?php echo $city;?>">
  			<span class="error">* <?php echo $cityErr;?></span>
  			<br><br>
  			Telefoonnummer: <input type="text" name="phone" value="<?php echo $phone;?>">
  			<span class="error">* <?php echo $phoneErr;?></span>
  			<br><br>
  			Geslacht:
  			<input type="radio" name="gender" <?php if (isset($gender) && $gender=="man") echo "checked";?> value="man">Man
  			<input type="radio" name="gender" <?php if (isset($gender) && $gender=="vrouw") echo "checked";?> value="vrouw">Vrouw
  			<span class="error">* <?php echo $genderErr;?></span>
  			<br><br>
  			<input type="submit" name="submit" value="Vesturen">  
		</form>
	</BODY>
</HTML>