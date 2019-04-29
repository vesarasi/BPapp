<?php

session_start();

// redirects to login page if there is no logged in session.
if(isset($_SESSION["loggedin"]) == false){
    header("location: login_page.php");
    exit;
}

// placeholder datab connekt
require_once "config.php";

// create sum variabls. if you change the names, do so in all the files.
$sysl = "";
$dial = "";
$pulsel = "";
$timel = "";

$sys_err =
$dia_err =
$pulse_err = "";


//parsel the form
if($_SERVER["REQUEST_METHOD"] == "POST"){
     // Validate systolic value
    if(empty(trim($_POST["sys"]))){
        $sys_err = "insert syspb.";
    } else{$_SESSION["sys"] = $_POST["sys"];
}

    // Validate diastolic value
    if(empty(trim($_POST["dia"]))){
        $dia_err = "insert diapb.";
    } else{$_SESSION["dia"] = $_POST["dia"];
}

    // Validate pulse value
    if(empty(trim($_POST["pulse"]))){
        $pulse_err = "insert pulse.";
    } else{$_SESSION["pulse"] = $_POST["pulse"];
      
    $sys = $_SESSION["sys"] ; 
    $dia = $_SESSION["dia"] ;
    $pulse = $_SESSION["pulse"];

    $sql2 = "INSERT INTO results (uid, sys, dia, pulse) VALUES (?, ?, ?, ?)";
    $uid = $_SESSION["uid"];

    if($stmt = mysqli_prepare($link, $sql2)){
      mysqli_stmt_bind_param($stmt, "iiii", $uid, $sys, $dia, $pulse);
    }else{echo "1";
    }
    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_close($stmt);
    
    }
    }
  }




?>



<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="js/script.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
          ['2004/05',  165,      938,         522,             998,           450,      614.6],
          ['2005/06',  135,      1120,        599,             1268,          288,      682],
          ['2006/07',  157,      1167,        587,             807,           397,      623],
          ['2007/08',  139,      1110,        615,             968,           215,      609.4],
          ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
     <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
        <title>Chart</title>
    </head>
    <body onload="ClearForm()">
<!-- The overlay -->
<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <!-- Overlay content -->
  <div class="overlay-content">
    <a href="index.php">Etusivu</a>
    <a href="respage.php">Viimeisin mittaustulos</a>
    <a href="diagram.html">Taulukko</a>
      <br><hr><br>
    <a href="profile.php">Muokkaa profiilia</a>
    <a href="setups.php">Asetukset</a>
    <a href="#">Kirjaudu ulos</a> 
  </div>

</div>

<!-- Use any element to open/show the overlay navigation menu -->       
    <div class="navbar">
        <a href="#" onclick="history.go(-1)" class="return-btn"><i class="fas fa-arrow-left"></i></a> 
        <span class="menubtn" onclick="openNav()"><i class="fas fa-bars"></i></span>
    </div>
        
        
       <div class="row">
         <div class="title">Taulukko</div>
        <!-- toiminta ongelmia. palataan jos ehditän
        <div class="info-content">
         
        <div class="tab-navbar">    
        <button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Home</button>
        <button class="tablink" onclick="openPage('News', this, 'green')" >News</button>
        <button class="tablink" onclick="openPage('Contact', this, 'blue')">Contact</button>
        <button class="tablink" onclick="openPage('About', this, 'orange')">About</button>
        </div>     
            
           <div id="Home" class="tabcontent">
                <div id="chart_div" class="chart"></div>
           </div>

           <div id="News" class="tabcontent">
               <h3>News</h3>
               <p>Some news this fine day!</p> 
           </div>

           <div id="Contact" class="tabcontent">
                <h3>Contact</h3>
                <p>Get in touch, or swing by for a cup of coffee.</p>
           </div>

           <div id="About" class="tabcontent">
               <h3>About</h3>
               <p>Who we are and what we do.</p>
           </div>
        </div>

        -->
        <div class="output">
            
            
        </div>     
           
        <button class="addresults-btn" onclick="openForm()">+ lisää mittaustulos</button> 
        

           

           <div class="form-popup" id="myForm" name="myform">
            <form id="resform" name="resform" action="respage.php",  class="form-container" method="post">
            
                <a href="javascript:void(0)" class="closebtn" onclick="closeForm()">&times;</a> 
                <br>   
            <h1>Syötä arvot</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($sys_err)) ? 'has-error' : ''; ?>">
                <label>sys</label><br>
                <input type="sys" name="sys" class="form-control">
                <span class="help-block"><?php echo $sys_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($dia_err)) ? 'has-error' : ''; ?>">
                <label>dia</label><br>
                <input type="dia" name="dia" class="form-control">
                <span class="help-block"><?php echo $dia_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($pulse_err)) ? 'has-error' : ''; ?>">
                <label>pulssi</label><br>
                <input type="pulse" name="pulse" class="form-control">
                <span class="help-block"><?php echo $pulse_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="tallenna">
            </div>
                
                </form>
  
               </form>
           </div>
                            
        <!-- diagram and last measurement here -->
        <div class="wrap">
            <div class="left">
                <a href="index.php">
                <i class="fas fa-home"></i>
                <p>Etusivu</p>
                </a>
            </div>

            <div class="right">
                <a href="respage.php">
                <i class="fas fa-heartbeat"></i>
                <p>Viimeisin mittaustulos</p>
                </a>    
            </div>
        </div>
    
    </div>
    <footer>
        <p>2019 &copy; Databois</p>
    </footer>    
    </body>