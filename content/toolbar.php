<!DOCTYPE HTML>
<?php include("content/inlogsysteem.php"); ?>
<!-- hiermee roepen we het stijlblad op -->
<link href="css/stijlblad1.css" rel="stylesheet" type="text/css"/> 
    <!-- hier starten de divs, de stijl van de divs wordt aangegeven op het stijlblad -->
    <div id="header">
        <div id="homeknop">
            </br><a href="index.php"><img src="img/home.png" height="30px" title="Homepagina"></a>
        </div>    
            <div id="topmenu">
                    </br>    
                <!-- hier wordt eerst gechecked of er iemand ingelogd is door te kijken of de "userlevel" een waarde heeft.
                     Als dat zo is wordt er gekeken of de waarde "1" is, wat staat voor admin. Zo ja wordt er "Welkom admin" geëchoed.
                     Zo niet wordt er "Welkom klant" geëchoed. -->
                <?php
                    
                    if(isset(($_SESSION["userlevel"]))=="0"){
                        echo ("");
                    }
                    elseif(($_SESSION["userlevel"])=="1"){
                        echo ("welkom admin");
                    }
                    elseif(isset($_SESSION["name"])=="1"){
                        echo("welkom " . $_SESSION["name"]);
                    }
                ?>&nbsp&nbsp&nbsp&nbsp
                <!-- dit zijn de icons voor de knoppen in de toolbar -->
                <?php include('content/popup.php');?>&nbsp&nbsp
                <a href="inlogpagina.php"><img src="login.png" height="25px" title="Inloggen"></a>&nbsp&nbsp
                <a href="winkelwagen.php"><img src="cart2.png" height="25px" title="Winkelmandje"></a>
    <?php
                if(isset(($_SESSION["userlevel"]))=="0"){
                    echo ("");
                }
                elseif(($_SESSION["userlevel"])=="1"){
                    ?>&nbsp<a href="admin.php"><img src="admin.png" height="25px"></a><?php
                }
                else{
                    echo ("");
                }         
    ?>
                <!-- dit is het logo -->
                
            </div>
            <div id="logo"><a href="index.php"><img src="logo.png" align="middle"></a></div>

    </div>
    <!-- dit stukje code maakt een lijn, waar de header stopt en waar de content van de site begint -->
<hr color="#000000">

</HTML>