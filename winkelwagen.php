<?php
session_start();
require("databasefuncties.php");
$db_handle = new Database();

if(!empty($_GET["action"])) {
//Als er op een knop is gedrukt, voer uit:
	switch($_GET["action"]) {
		case "add":
		//Als er op "Toevoegen" wordt gedrukt:
			if(!empty($_POST["aantal"])) {
			//Als er een aantal bij het product waar toevoegen op gedrukt is, is ingevoerd, voer uit:
				$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE naam='" . $_GET["id"] . "'"); 
				//Query pakken waar naam gelijk is aan naam van "toevoegen"
				$itemArray = array($productByCode[0]["naam"]=>array('naam'=>$productByCode[0]["naam"], 'productid'=>$productByCode[0]["productid"], 'aantal'=>$_POST["aantal"], 'prijs'=>$productByCode[0]["prijs"]));
				//Array maken van gegevens geselecteerde product en het ingevoerde aantal
			
				if(!empty($_SESSION["winkelkar"])) {
				//Als winkelkar niet leeg is:
					if(in_array($productByCode[0]["naam"],array_keys($_SESSION["winkelkar"]))) {
					//Als product al in de winkelkar zit:
						foreach($_SESSION["winkelkar"] as $k => $v) {
						//Zoeken naar product in winkelkar dat overeenkomt met product dat toegevoegd moet worden
							if($productByCode[0]["naam"] == $k) {
							//Als nieuw toegevoegde product overeenkomt met winkelkar product				
								$_SESSION["winkelkar"][$k]["aantal"] += $_POST["aantal"];
								//Huidige aantal + nieuwe aantal								
							}
						}
					} else {
						$_SESSION["winkelkar"] = array_merge($_SESSION["winkelkar"],$itemArray);
						//Product zat nog niet in winkelkar, maar winkelkar was niet leeg, nieuw product wordt toegevoegd aan winkelkar
					}
				} else {
					$_SESSION["winkelkar"] = $itemArray;
					//Winkelcar wordt gevuld met eerste product
				}
			}
		break;
		case "remove":
		//Als er op "verwijder artikel" wordt gedrukt:
			if(!empty($_SESSION["winkelkar"])) {
			//Als winkelkar leeg is:
				foreach($_SESSION["winkelkar"] as $k => $v) {
				//Zoeken naar product in kar dat verwijdert moet worden
					if($_GET["id"] == $k)
					//Als ID van verwijder artikel gelijk is aan het id van het product:
						unset($_SESSION["winkelkar"][$k]);
						//product verwijderen uit winkelkar
					if(empty($_SESSION["winkelkar"]))
					//Als winkelkar nu leeg is, winkelkar verwijderen
						unset($_SESSION["winkelkar"]);
				}
			}
		break;
		case "empty":
		//Als er op "Mandje leeg gooien" wordt gedrukt, voer uit:
			unset($_SESSION["winkelkar"]);
		break;	
	}
}
?>
<html>
<head>
<title>wascessoireshop.nl</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<!-- Winkelmandje -->
<div id="shopping-cart">
<div class="txt-heading">Winkelmandje <a id="btnEmpty" href="winkelwagen.php?action=empty">Mandje leeg gooien</a></div>
<?php
if(isset($_SESSION["winkelkar"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Naam</strong></th>
<th style="text-align:left;"><strong>ID</strong></th>
<th style="text-align:right;"><strong>Aantal</strong></th>
<th style="text-align:right;"><strong>Prijs</strong></th>
<th style="text-align:center;"><strong>Verwijderen</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["winkelkar"] as $item){
		//Producten die geselecteerd zijn, laten zien in winkelmandje
		?>
			<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["naam"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["productid"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["aantal"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "€".$item["prijs"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="winkelwagen.php?action=remove&id=<?php echo $item["naam"]; ?>" class="btnVerwijderArtikel">Verwijder artikel</a></td>
			</tr>
		<?php
        $item_total += ($item["prijs"]*$item["aantal"]);
		}
		?>

<tr>
	<td colspan="5" align=right><strong>Total:</strong> <?php echo "€".number_format((float)$item_total, 2, '.', ''); ?></td> <!-- number_format zorgt er voor dat er 2 decimalen achter de komma te zien zijn -->
</tr>
<tr>
	<td colspan="5" align=right><input type="submit" value="Betalen" class="btnToevoegen" /></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>
<!-- Producten -->
<div id="product-grid">
	<div class="txt-heading">Producten</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY naam ASC");
	if (!empty($product_array)) {
	//Als er producten in de database zijn:
		foreach($product_array as $key=>$value){
		//Producten tonen op scherm
	?>
		<div class="product-item">
			<form method="post" action="winkelwagen.php?action=add&id=<?php echo $product_array[$key]["naam"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["plaatje"]; ?>"></div>
			<div><strong><?php echo $product_array[$key]["naam"]; ?></strong></div>
			<div class="beschrijving"><?php echo $product_array[$key]["beschrijving"];?></div>
			<div class="product-price"><?php echo "€".$product_array[$key]["prijs"]; ?></div>
			<div><input type="text" name="aantal" value="1" size="2" /><input type="submit" value="Toevoegen" class="btnToevoegen" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
</div>
</body>
</html>