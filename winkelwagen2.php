<?php
if (session_id() == ""){
//check of er al een session is
	session_start();
}
require("databasefuncties.php");
$db_handle = new Database();
include "toolbar.php";
?>

<html>
<head>
<title>wascessoireshop.nl</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="product-grid">
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
</body>
<footer>
<?php
include "footer.php";
?>
</footer>
</html>