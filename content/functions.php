<?php
function inputTest($x){
	$x=stripcslashes($x);
	$x=trim($x);
	$x=htmlspecialchars($x);
	
	return $x;
}
?>