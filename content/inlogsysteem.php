<?php

if(session_ID()== ""){
    session_start();
}
include('db/database.php');/* hier moet de connectie met de database nog toegevoegd worden */
        /*  hier krijgen de variabelen GN en WW de waarde van de ingevoerde gebruikersnaam en wachtwoord door de gebruiker
            ook worden hier de ingevoerde waardes 'veilig gemaakt' door de functie 'mysqli_real_escape_string' */        
    if(!empty($_POST)){
        $gebruikersnaam = mysqli_real_escape_string($db, $_POST['gebruikersnaam']);
        $wachtwoord = mysqli_real_escape_string($db, $_POST['wachtwoord']);
        /*  hier word alles geselecteerd van de gebruiker waar de gebruikersnaam en wachtwoord matchen, als deze niet matchen, heeft
            $query geen waarde */
            $query = "SELECT * FROM user WHERE username='$gebruikersnaam' AND password='$wachtwoord'";
            $result = mysqli_query($db, $query) or die("FOUT:" . mysqli_error());
                if(mysqli_num_rows($result)>0){
                    $_SESSION["auth"]=TRUE;
                    $_SESSION["timeout"]=time() + 120;
                    $_SESSION["gebruiker"]=$gebruikersnaam;
                    
                        while($row = mysqli_fetch_assoc($result)){
                            $rol = $row['userlevel'];
                            $naam= $row["firstname"];
                        }  
                    $_SESSION["userlevel"]=$rol;
                    $_SESSION["name"]=$naam;
                }       
    }
?>