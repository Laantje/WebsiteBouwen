<?php
include "toolbar.php";
require("databasefuncties.php");
$db_handle = new Database();
?>

<head>
<title>wascessoireshop.nl</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="product-grid">
<div class="txt-heading">Klanten </div>

<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Gebruiker ID</strong></th>
<th style="text-align:left;"><strong>Gebruikersnaam</strong></th>
<th style="text-align:right;"><strong>Gebruikerlevel</strong></th>
<th style="text-align:right;"><strong>Achternaam</strong></th>
<th style="text-align:center;"><strong>Verwijderen</strong></th>
</tr>	
<?php
	$klant_array = $db_handle->runQuery("SELECT * FROM user ORDER BY user_id ASC");
	if (!empty($klant_array)) {
	//Als er producten in de database zijn:
		foreach($klant_array as $key=>$value){
		//Producten tonen op scherm
	?>
			<tr>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $klant_array[$key]["user_id"]; ?></strong></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $klant_array[$key]["username"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $klant_array[$key]["userlevel"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $klant_array[$key]["lastname"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><a href="winkelwagen.php?action=remove&id=<?php echo $klant_array[$key]["username"]; ?>" class="btnVerwijderArtikel">Verwijder Klant</a></td>
			</tr>

	
 <?php
		}
	}
?>
</tbody>
</table>	
</div>
</body>
