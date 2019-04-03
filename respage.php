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
    <!-- previous results. php magic pulls last entry from db -->

    <div class="col-5 col-s-5">
        <h1>viimeisimmät tulokset</h1>

       

    </div>
    <!--insert new results via php magic. once applied, ask for confirmation before inserting into db-->
    <div class="col-9 col-s-9">
        <form method="post">
                <label for="sys">Systolic BP</label>
                <input type="text" name="sys" id="sys"><br>
                <label for="dia">Diastolic BP</label>
                <input type="text" name="dia" id="dia"><br>
                <label for="pulse">Pulse</label>
                <input type="text" name="pulse" id="pulse"><br>
        </form>
        

    </div>
    <footer>
        <p>2019 &copy; Databois</p>
    </footer>    
</body>
</html>