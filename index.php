<?php
session_start();
/*
// redirects to login page if there is no logged in session.
if(isset($_SESSION["loggedin"]) or $_SESSION["loggedin"] == false){
    header("location: login_page.php");
    exit;
}
*/
// placeholder datab connekt
require_once "config.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/script.js"></script>
        <title>Homepage</title>
    </head>
    <body>
<!-- The overlay -->
<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <!-- Overlay content -->
  <div class="overlay-content">
    <a href="#">Lisää mittaustulos</a>
    <a href="#">Viimeisin mittaustulos</a>
    <a href="#">Diagrammi</a>
      <br><hr><br>
    <a href="#">Muokkaa profiilia</a>
    <a href="#">Asetukset</a>
    <a href="#">Kirjaudu ulos</a>  
  </div>

</div>

<!-- Use any element to open/show the overlay navigation menu -->       
    <div class="navbar">
        <p>BPapp</p>
        <span class="menubtn" onclick="openNav()">&#9776;</span>
    </div>
        
       <div class="row">
        <div class="logo">
        <h1>Logo tähän</h1>
        </div>
        
        <button class="addresults-btn">+ lisää mittaustulos</button><br> 
        
        <!-- user profile -->
        
        <div class="profile-card">
            <div class="title">Käyttäjä</div>
            <img src="img/0_200.png"/>
            <h2><?php echo $firstname ." ".$lastname ;?> </h2>
            <ul>
                <li>IKÄ:<?php echo $age;?> </li>
                <li>PITUUS:<?php echo $length;?> </li>
                <li>PAINO: <?php echo $weight;?></li>
            </ul>
        </div>  
    
        <!-- diagram and last measurement here -->
        <div class="wrap">
            <div class="left">
                <img src="img/0_200.png"/>
                <p>Viimeisin mittaus</p>
            </div>

            <div class="right">
                <a href="diagram.html">
                <img src="img/diagram-icon.png"/>
                Taulukko
                </a>    
            </div>
            
        </div>
    
    </div>
    <footer>
        <p>2019 &copy; Databois</p>
    </footer>    
    </body>