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
        <script src="js/form.js"></script>
         <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
        <title>Homepage</title>
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
    <a href="diagram.php">Taulukko</a>
      <br><hr><br>
    <a href="profile.php">Muokkaa profiilia</a>
    <a href="setups.php">Asetukset</a>
    <a href="logout.php">Kirjaudu ulos</a> 
  </div>

</div>

<!-- Use any element to open/show the overlay navigation menu -->       
    <div class="navbar">
        <span class="menubtn" onclick="openNav()"><i class="fas fa-bars"></i></span>
    </div>
        
       <div class="row">
        <div class="logo">
            <img src="img/BPapp_logo.png">
            <p>BPapp</p>
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
                    
           
           
        <!-- Chart here-->
        
        <div class="output">
            
            
        </div>  
    
        
        <div class="wrap">
            
            <!-- User profile -->
        
            <div class="profile">
                <div class="title">Käyttäjä</div>
                <img src="img/0_200.png"/>
                <!-- <i class="fas fa-user"></i> -->
                    <h2><?php echo $firstname ." ".$lastname ;?> </h2>
                <ul>
                    <li>IKÄ:<?php echo $age;?> </li>
                    <li>PITUUS:<?php echo $length;?> </li>
                    <li>PAINO: <?php echo $weight;?></li>
                </ul>
                <a href="profile.php"><button>Muokkaa tietoja</button></a>
            </div>
            
            <!-- buttons -->
            
            <div class="buttons-right">
                
                <div id="btn1" class="button">
                    <a href="diagram.php">
                    <i class="fas fa-chart-bar"></i>
                    <p>Taulukko</p>
                    </a>    
                </div>
                
                <div id="btn2" class="button">
                    <a href="respage.php">
                    <i class="fas fa-heartbeat"></i>
                    <p>Viimeisin mittaus</p>
                    </a>
                </div>
                
                
            </div>
            
            
        </div>
    
    </div>
    <footer>
        <p>2019 &copy; Databois</p>
    </footer>    
    </body>