<style>
/* Style The Dropdown Button */
.dropbtn {
    background-color: #FFFFFF;
    color: white;
    padding: 1px;
    font-size: 1px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    text-align: left;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 8px 12px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #FFFFFF}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #FFFFFF;
}
</style>

<div class="dropdown">
  <button class="dropbtn"><img src="menu.png" height="25px"></button>
  <div class="dropdown-content">
  	<a href="producten.php"><img src="product.png" height="15px"> Productpagina</a>
    <?php
    if(isset(($_SESSION["gebruiker"])) != null) {
    	echo '<a href="#"><img src="account.png" height="15px"> Account</a>';
        echo '<a href="content/logout.php"><img src="logout.png" height="15px"> Uitloggen</a>';
    }
    else {
    	echo '<a href="register.php"><img src="register.png" height="15px"> Registreren</a>';
    }
    ?>
  </div>
</div>