<!DOCTYPE HTML>

<!-- hiermee roepen we het stijlblad op -->
<link href="stijlblad.css" rel="stylesheet" type="text/css"/> 
<!-- hiermee roepen we de toolbar op -->
    <?php include("toolbar.php");
          include("inlogsysteem.php"); ?>
        <!-- hier start de div inloggen met daarin de forms -->
        <div id="inloggen">
            <?php
                if(isset(($_SESSION["gebruiker"])) != null) {
                    if(!empty($_POST)) {
                        header("Location: homep.php");
                    }
                    echo '<h2>U bent al ingelogd.</h2>';
                }
                else {  
                    echo '<form method="post">
                Gebruikersnaam: <br/><input type="text" min="6" max="15" name="gebruikersnaam">
                <a href="">Gebruikersnaam vergeten?</a>
                Wachtwoord: <br/><input type="password" name="wachtwoord">
                <a href="">Wachtwoord vergeten?</a>
                <br/><input type="submit" name="inloggen" value="inloggen">
            </form>';
                    if(!empty($_POST) && empty($_SESSION['gebruiker'])) {
                        echo '<h4 style="color:red;">Uw gebruikersnaam en/of wachtwoord kloppen niet.</h4>';
                    }
                }
            ?>
        </div>
    <?php include("footer.php");?>
</HTML>