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
	$naam = $gegevens['name'];
	$kleur = $gegevens['color'];
	$categorie = $gegevens['category'];
	$omschrijving = $gegevens['description'];
	$voorraad = $gegevens['stock'];
	$prijs = $gegevens['price'];
	$plaatje = $gegevens['image'];
			
?>
<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	//Kijk of er een error is
	$hasError = false;
//testen of de velden zijn ingevuld
		  $name_new = mysqli_real_escape_string($db, inputTest($_POST['name']));
          $color_new = mysqli_real_escape_string($db, inputTest($_POST['color']));
          $category_new = mysqli_real_escape_string($db, inputTest($_POST['category']));
          $description_new = mysqli_real_escape_string($db, inputTest($_POST['description']));
          $stock_new = mysqli_real_escape_string($db, inputTest($_POST['stock']));
          $price_new = mysqli_real_escape_string($db, inputTest($_POST['price']));
          $image_new = mysqli_real_escape_string($db, inputTest($_POST['image']));
}
	if ($_SERVER["REQUEST_METHOD"]=="POST" /*AND !empty($name_new) AND !empty($color_new) AND !empty($category_new) AND !empty($description_new) AND !empty($stock_new) AND !empty($price_new) AND !empty($image_new) AND !empty($phone_new) AND !$hasError*/){
        $update="Insert product SET name = '$name_new', color = '$color_new', category = '$category_new', description ='$description_new', stock ='$stock_new', price = '$price_new', image = '$image_new' WHERE name = '". $_SESSION["editProduct"] . "'";
	          if(mysqli_query($db, $update)){
				  echo "het is gelukt!";
				  $naam = $name_new;
				  $kleur = $color_new;
				  $categorie = $category_new;
				  $omschrijving = $description_new;
				  $voorraad = $stock_new;
				  $prijs = $price_new;
				  $plaatje = $image_new;
			  }
			  else {
				  echo "Updaten is niet gelukt.";
			  }
    } else {
	echo "";
	}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center">  
  			Product naam: <input type="text" name="name" value="<?php echo $naam;?>">
  			<span class="error">* <?php echo $nameErr;?></span>
  			<br><br>
  			Kleur: <input type="text" name="color" value="<?php echo $kleur;?>">
  			<span class="error">* <?php echo $colorErr;?></span>
  			<br><br>
  			Categorie: <input type="text" name="category" value="<?php echo $categorie;?>">
  			<span class="error">* <?php echo $categoryErr;?></span>
  			<br><br>
  			Beschrijving: <input type="text" name="description" value="<?php echo $omschrijving;?>">
  			<span class="error">* <?php echo $descriptionErr;?></span>
  			<br><br>
  			Voorraad: <input type="text" name="stock" value="<?php echo $voorraad;?>">
  			<span class="error">* <?php echo $stockErr;?></span>
  			<br><br>
  			Prijs: <input type="text" name="price" value="<?php echo $prijs;?>">
  			<span class="error">* <?php echo $priceErr;?></span>
  			<br><br>
  			Plaatje: <input type="text" name="image" value="<?php echo $plaatje;?>">
  			<span class="error">* <?php echo $imageErr;?></span>
  			<br><br>
  			<input type="submit" name="submit" value="Veranderen">
</form>




</body>
</html>