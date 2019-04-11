<?php
session_start();

// redirects to login page if there is no logged in session.
if(isset($_SESSION["loggedin"]) == false){
    header("location: login_page.php");
    exit;
}

// placeholder datab connekt
require_once "config.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
    <a href="index.php">Etusivu</a>
    <a href="#">Lisää mittaustulos</a>
    <a href="respage.php">Viimeisin mittaustulos</a>
    <a href="diagram.html">Taulukko</a>
      <br><hr><br>
    <a href="#">Muokkaa profiilia</a>
    <a href="setups.html">Asetukset</a>
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
                <a href="respage.php">
                <img src="img/0_200.png"/>
                <p>Viimeisin mittaus</p>
                </a>
            </div>

            <div class="right">
                <a href="diagram.html">
                <img src="img/diagram-icon.png"/>
                <p>Taulukko</p>
                </a>    
            </div>
            
        </div>
    
    </div>
    <footer>
        <p>2019 &copy; Databois</p>
    </footer>    
    </body>