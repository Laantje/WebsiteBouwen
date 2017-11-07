<HTML>
	<HEAD>
		<TITLE>Wascessoires - Register</TITLE>
		<style>
			.error {color: #FF0000;}
		</style>
    <?php
      include ('toolbar.php');
    ?>
	</HEAD>
	<BODY BGCOLOR="FFFFFF">
		<?php
			require_once ('database.php');
			// Required field names
			$required = array('username', 'password', 'firstname', 'lastname', 'email', 'adress', 'postalcode', 'city', 'phone', 'gender');
			// Initiëren van variabelen en ze "lege" waarde toekennen
			$usernameErr = $passwordErr = $firstnameErr = $lastnameErr = $emailErr = $adressErr = $postalcodeErr = $cityErr = $phoneErr = $genderErr = "";
			$username = $password = $firstname = $lastname = $email = $adress = $postalcode = $city = $phone = $gender = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				//Kijk of er een postfield empty is
				$emptyField = false;
				$hasError = false;
  				//Als een postfield empty is, ga bij elke field langs
  				if (empty($_POST["username"])) {
    				$usernameErr = "Gebruikersnaam is verplicht";
    				$emptyField = true;
  				} else {
		    		$username = test_input($_POST["username"]);
		    		// check of $username uitsluitend uit letters en nummers bestaan
		    		if (!preg_match("/^[a-zA-Z\d]*$/",$username)) {
		      			$usernameErr = "Alleen letters en cijfers zijn toegestaan";
		      			$hasError = true;
 		   			}
            else {
              //Kijk of username al bestaat
              $mysql_get_users = mysqli_query($db, "SELECT * FROM user where username='$username'");
              $get_rows = mysqli_affected_rows($db);
              if($get_rows >=1){
                $usernameErr = "Gebruikersnaam bestaat al.";
                $hasError = true;
              }
            }
 		 		}
 		 		if (empty($_POST["password"])) {
    				$passwordErr = "Wachtwoord is verplicht";
    				$emptyField = true;
  				} else {
		    		$password = test_input($_POST["password"]);
		    		// check of $password uitsluitend uit letters en nummers bestaan
		    		if (!preg_match("/^[a-zA-Z\d]*$/",$password)) {
		      			$passwordErr = "Alleen letters en cijfers zijn toegestaan";
		      			$hasError = true;
 		   			}
 		 		}
 		 		if (empty($_POST["firstname"])) {
    				$firstnameErr = "Voornaam is verplicht";
    				$emptyField = true;
  				} else {
		    		$firstname = test_input($_POST["firstname"]);
		    		// check of $firstname uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z]*$/",$firstname)) {
		      			$firstnameErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
 		   			}
 		 		}
 		 		if (empty($_POST["lastname"])) {
    				$lastnameErr = "Lastname is verplicht";
    				$emptyField = true;
  				} else {
		    		$lastname = test_input($_POST["lastname"]);
		    		// check of $lastname uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z]*$/",$lastname)) {
		      			$lastnameErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
 		   			}
 		 		}
  				if (empty($_POST["email"])) {
    				$emailErr = "Email is verplicht";
    				$emptyField = true;
  				} else {
    				$email = test_input($_POST["email"]);
    				// check of het e-mailadres aan de eisen voldoet
    				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      					$emailErr = "E-mail is niet valide";
      					$hasError = true;
    				}
  				}
  				
  				if (empty($_POST["adress"])) {
    				$adressErr = "Adres is verplicht";
    				$emptyField = true;
  				} else {
		    		$adress = test_input($_POST["adress"]);
		    		// check of $adress uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z\d ]*$/",$adress)) {
		      			$adressErr = "Alleen letters en cijfers zijn toegestaan";
		      			$hasError = true;
 		   			}
 		 		}
 		 		if (empty($_POST["postalcode"])) {
    				$postalcodeErr = "Postcode is verplicht";
    				$emptyField = true;
  				} else {
		    		$postalcode = test_input($_POST["postalcode"]);
		    		// check of $postalcode uitsluitend uit letters bestaan
		    		if(!preg_match('/^[1-9]{1}[0-9]{3}[A-Z]{2}$/', $postalcode)) {
		      			$postalcodeErr = "Postcode moet bestaan uit 4 cijfers en 2 letters.";
		      			$hasError = true;
 		   			}
 		 		}
 		 		if (empty($_POST["city"])) {
    				$cityErr = "Woonplaats is verplicht";
    				$emptyField = true;
  				} else {
		    		$city = test_input($_POST["city"]);
		    		// check of $lastname uitsluitend uit letters bestaan
		    		if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
		      			$cityErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
 		   			}
 		 		}
 		 		if (empty($_POST["phone"])) {
    				$phoneErr = "Telefoonnummer is verplicht";
    				$emptyField = true;
  				} else {
		    		$phone = test_input($_POST["phone"]);
		    		// check of $phone uitsluitend uit letters bestaan
		    		if (!preg_match("/^[\d]*$/",$phone)) {
		      			$phoneErr = "Alleen cijfers zijn toegestaan";
		      			$hasError = true;
 		   			}
 		 		}
  				if (empty($_POST["gender"])) {
    				$genderErr = "Geslacht is verplicht";
    				$emptyField = true;
  				} else {
    				$gender = test_input($_POST["gender"]);
  				}
			
				//Als er geen empty post fields zijn en geen errors, stuur de gegevens naar de database
  				if(!$emptyField && !$hasError) {
  					//Check gender, change to number
  					if($gender == "man") {
  						$gender = 0;
  					}
  					else if($gender == "vrouw") {
  						$gender = 1;
  					}
  					//Maak sql query aan
					  $query = "INSERT INTO user (username,password,userlevel,firstname,lastname,gender,email,adress,postalcode,city,phone) VALUES ('$username','$password','0','$firstname','$lastname','$gender','$email','$adress','$postalcode','$city','$phone')";
					  //Verwerk sql query
					  $data = mysqli_query ($db, $query)or die(mysqli_error($db)); 
					  if($data) { 
						  header("Location: register_confirm.php");
					  }
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
  			<input type="submit" name="submit" value="Versturen">  
		</form>
	</BODY>
  <FOOTER>
    <?php
      include ('footer.php');
    ?>
  </FOOTER>
</HTML>