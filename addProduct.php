<HTML>
	<HEAD>
		<TITLE>Wascessoires - Register</TITLE>
		<style>
			.error {color: #FF0000;}
		</style>
    <?php
      include 'db/database.php';
	include "content/toolbar.php";
	require("db/databasefuncties.php");
	include 'content/functions.php';
    ?>
	</HEAD>
	<BODY BGCOLOR="FFFFFF">
		<?php
			require_once ('db/database.php');
			// Required field names
			$required = array('name', 'color', 'category', 'description', 'stock', 'price', 'image');
			// Initiëren van variabelen en ze "lege" waarde toekennen
			$nameErr = $colorErr = $categoryErr = $descriptionErr = $stockErr = $priceErr = $imageErr = "";
			$name = $color = $category = $description = $stock = $price = $image = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				//Kijk of er een postfield empty is
				$emptyField = false;
				$hasError = false;
  				//Als een postfield empty is, ga bij elke field langs
						$name = inputTest($_POST['name']);
						$color = inputTest($_POST['color']);
						$category = inputTest($_POST['category']);
						$description = inputTest($_POST['description']);
						$stock = inputTest($_POST['stock']);
						$price = inputTest($_POST['price']);
						$image = inputTest($_POST['image']);

			
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
					$query = "INSERT INTO product (name,color,category,description,stock,price,image) 
					VALUES ('$name','$color','$category','$description','$stock','$price','$image')";
					//Verwerk sql query
					$data = mysqli_query ($db, $query)or die(mysqli_error($db)); 
					if($data) { 
						header("Location: viewProducten.php");
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

		<h1 align="center">Nieuw Product</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center">  
  			Product naam: <input type="text" name="name" value="<?php echo $name;?>">
  			<span class="error">* <?php echo $nameErr;?></span>
  			<br><br>
  			Kleur: <input type="text" name="color" value="<?php echo $color;?>">
  			<span class="error">* <?php echo $colorErr;?></span>
  			<br><br>
  			Categorie: <input type="text" name="category" value="<?php echo $category;?>">
  			<span class="error">* <?php echo $categoryErr;?></span>
  			<br><br>
  			Beschrijving: <input type="text" name="description" value="<?php echo $description;?>">
  			<span class="error">* <?php echo $descriptionErr;?></span>
  			<br><br>
  			Voorraad: <input type="text" name="stock" value="<?php echo $stock;?>">
  			<span class="error">* <?php echo $stockErr;?></span>
  			<br><br>
  			Prijs: <input type="text" name="price" value="<?php echo $price;?>">
  			<span class="error">* <?php echo $priceErr;?></span>
  			<br><br>
  			Plaatje: <input type="text" name="image" value="<?php echo $image;?>">
  			<span class="error">* <?php echo $imageErr;?></span>
  			<br><br>
  			<input type="submit" name="submit" value="Veranderen">
</form>
	</BODY>
  <FOOTER>
    <?php
      include ('content/footer.php');
    ?>
  </FOOTER>
</HTML>