<?php
include "content/toolbar.php";
require("db/databasefuncties.php");
$db_handle = new Database();
if(!empty($_GET["action"])) {
//Als er op een knop is gedrukt, voer uit:
	switch($_GET["action"]) {
		case "add":
		break;
		
		case "edit":
			
		break;
		
		case "remove":
			$sql = "Delete from product where name ='". $_GET["id"] . "'";
			if (mysqli_query($conn, $sql)) {
				echo "Product verwijderd";
			} else {
				echo "Error verwijderen product: " . mysqli_error($conn);
			}
		break;
	}
}
?>

<head>
<title>wascessoireshop.nl</title>
</head>
<body>
<div id="product-grid">
<div class="txt-heading">Klanten </div>

<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
	<th style="text-align:right;"><strong>Product ID</strong></th>
	<th style="text-align:right;"><strong>Product Naam</strong></th>
	<th style="text-align:right;"><strong>Gebruikerlevel</strong></th>
	<th style="text-align:right;"><strong>Achternaam</strong></th>
	<th style="text-align:center;"><strong></strong></th>
</tr>	
<?php
	$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY product_id ASC");
	if (!empty($product_array)) {
	//Als er producten in de database zijn:
		foreach($product_array as $key=>$value){
		//Producten tonen op scherm
	?>
			<tr>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $product_array[$key]["product_id"]; ?></strong></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $product_array[$key]["name"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $product_array[$key]["price"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $product_array[$key]["image"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;">
					<a href="viewProducten.php?action=remove&id=<?php echo $product_array[$key]["name"]; ?>"><img width="15" height="15" src="img/verwijder.png"></a>
					<a href="editProducten.php?action=edit&id=<?php echo $product_array[$key]["name"]; ?>"><img width="15" height="15" src="img/edit.png"></a>
				</td>
			</tr>

	
 <?php
		}
	}
?>
<form action="addProduct.php?action=add">
	<input type="submit" value="Product Toevoegen">
</form>
</tbody>
</table>	
</div>
</body>