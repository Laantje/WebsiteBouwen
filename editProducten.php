<!DOCTYPE html>

<html>
	<head>
		
	</head>
	<body>

<?php
include 'database.php';
include "toolbar.php";
require("databasefuncties.php");
include 'functions.php';
			// Initiëren van variabelen en ze "lege" waarde toekennen
			$nameErr = $colorErr = $categoryErr = $descriptionErr = $stockErr = $priceErr = $imageErr = "";
			$name = $color = $category = $description = $stock = $price = $image = "";
				if(!empty($_GET["id"])) {
					$_SESSION["editProduct"] = $_GET["id"];
				}	
				$query = "SELECT * FROM product WHERE name ='". $_SESSION["editProduct"] . "'";
$result = mysqli_query($db, $query);
$gegevens = mysqli_fetch_assoc($result);
	$gebruikersnaam = $gegevens['name'];
	$voornaam = $gegevens['color'];
	$achternaam = $gegevens['category'];
	$descriptionadres = $gegevens['description'];
	$adres = $gegevens['stock'];
	$postcode = $gegevens['price'];
	$stad = $gegevens['image'];
			
?>
<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	//Kijk of er een error is
	$hasError = false;
//testen of de velden zijn ingevuld
        if (empty($_POST['name'])) {
          $name_Err="je moet een naam invullen";
        }
        else {
		  $name_new = mysqli_real_escape_string($db, inputTest($_POST['name']));
		  if (!preg_match("/^[a-zA-Z\d]*$/",$name_new)) {
		      			$nameErr = "Alleen letters en cijfers zijn toegestaan";
						$hasError = true;
 		   			}
        }
        if (empty($_POST['color'])) {
          $colorErr="je moet een kleur invullen ";
        }
        else {
          $color_new = mysqli_real_escape_string($db, inputTest($_POST['color']));
		  if (!preg_match("/^[a-zA-Z]*$/",$color_new)) {
		      			$colorErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
		  }
        }
        if (empty($_POST['category'])) {
          $categoryErr="je moet een categorie invullen";
        }
        else {
          $category_new = mysqli_real_escape_string($db, inputTest($_POST['category']));
		  		    	if (!preg_match("/^[a-zA-Z]*$/",$category_new)) {
		      			$categoryErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
						}
        }
        if (empty($_POST['description'])) {
          $descriptionErr="je moet een beschrijving invullen";
        }
        else {
          $description_new = mysqli_real_escape_string($db, inputTest($_POST['description']));
		  if (!preg_match("/^[a-zA-Z\d]*$/",$description_new)) {
		      			$nameErr = "Alleen letters en cijfers zijn toegestaan";
						$hasError = true;
 		   			}
        }
		if (empty($_POST['stock'])) {
          $stockErr="je moet een adres invullen";
        }
        else {
          $stock_new = mysqli_real_escape_string($db, inputTest($_POST['stock']));
		  		    		if (!preg_match("/^[a-zA-Z\d ]*$/",$stock_new)) {
		      			$stockErr = "Alleen letters en cijfers zijn toegestaan";
		      			$hasError = true;
							}
        }
		if (empty($_POST['price'])) {
          $priceErr="je moet een postcode invullen";
        }
        else {
          $price_new = mysqli_real_escape_string($db, inputTest($_POST['price']));
        if(!preg_match('/^[1-9]{1}[0-9]{3}[A-Z]{2}$/', $price_new)) {
		      			$priceErr = "Postcode moet bestaan uit 4 cijfers en 2 letters.";
		      			$hasError = true;
		}
		}
		if (empty($_POST['image'])) {
          $imageErr="je moet een stad invullen";
        }
        else {
          $image_new = mysqli_real_escape_string($db, inputTest($_POST['image']));
			if (!preg_match("/^[a-zA-Z ]*$/",$image_new)) {
		      			$imageErr = "Alleen letters zijn toegestaan";
		      			$hasError = true;
			}
		}
	if ($_SERVER["REQUEST_METHOD"]=="POST" AND !empty($name_new) AND !empty($color_new) AND !empty($category_new) AND !empty($description_new) AND !empty($stock_new) AND !empty($price_new) AND !empty($image_new) AND !empty($phone_new) AND !$hasError){
        $update="UPDATE user SET name = '$name_new', color = '$color_new', category = '$category_new', description ='$description_new', stock ='$stock_new', price = '$price_new', image = '$image_new' WHERE name = '". $_SESSION["editProduct"] . "'";
	          if(mysqli_query($db, $update)){
				  echo "het is gelukt!";
				  $gebruikersnaam = $name_new;
				  $voornaam = $color_new;
				  $achternaam = $category_new;
				  $descriptionadres = $description_new;
				  $adres = $stock_new;
				  $postcode = $price_new;
				  $stad = $image_new;
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
  			Product naam: <input type="text" name="name" value="<?php echo $gebruikersnaam;?>">
  			<span class="error">* <?php echo $nameErr;?></span>
  			<br><br>
  			Kleur: <input type="text" name="color" value="<?php echo $voornaam;?>">
  			<span class="error">* <?php echo $colorErr;?></span>
  			<br><br>
  			Categorie: <input type="text" name="category" value="<?php echo $achternaam;?>">
  			<span class="error">* <?php echo $categoryErr;?></span>
  			<br><br>
  			Beschrijving: <input type="text" name="description" value="<?php echo $descriptionadres;?>">
  			<span class="error">* <?php echo $descriptionErr;?></span>
  			<br><br>
  			Voorraad: <input type="text" name="stock" value="<?php echo $adres;?>">
  			<span class="error">* <?php echo $stockErr;?></span>
  			<br><br>
  			Prijs: <input type="text" name="price" value="<?php echo $postcode;?>">
  			<span class="error">* <?php echo $priceErr;?></span>
  			<br><br>
  			Plaatje: <input type="text" name="image" value="<?php echo $stad;?>">
  			<span class="error">* <?php echo $imageErr;?></span>
  			<br><br>
  			<input type="submit" name="submit" value="Veranderen">
</form>




</body>
</html>