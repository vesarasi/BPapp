<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);


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

//get the last saved values from db based on session user id, sorted based on last result id.

$uid = $_SESSION["uid"];
$sql = "SELECT sys, dia, pulse, time FROM results WHERE uid = ? ORDER BY rid DESC LIMIT 1";
//prep the statement
if($stmt = mysqli_prepare($link, $sql)){
  mysqli_stmt_bind_param($stmt, "i",$uid);
        //run it
        if(mysqli_stmt_execute($stmt)){
            //store dem datas
            mysqli_stmt_store_result($stmt);
            // Check if got sum data
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind results
                mysqli_stmt_bind_result($stmt, $sysl, $dial, $pulsel, $timel);

                if(mysqli_stmt_fetch($stmt)) {
                }else{echo "z";}

                 

            }else{echo "1";}
           
        }else{echo "2";}

         // Close statement
         mysqli_stmt_close($stmt);

    }else{echo "3";}



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
         <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
        <title>respage</title>
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

    <div class="navbar">
            <a href="#" onclick="history.go(-1)" class="return-btn"><i class="fas fa-arrow-left"></i></a>
           <span class="menubtn" onclick="openNav()"><i class="fas fa-bars"></i></span>
    </div>
        
    <div class="row">
       
        <div class="result-card">
            <div class="title">viimeisimmät tulokset</div>
            <div class="lresults">
                <ul>
                    <li><label>Sys</label><br>   <span><?php echo $sysl;?></span></li>
                    <li><label>Dia</label><br>   <span><?php echo $dial; ?></span></li>
                    <li><label>Pulssi</label><br> <span><?php echo $pulsel; ?></span></li>
                    <li><label>mittausaika</label> <br> <span class="time"><?php echo $timel; ?></span> </li>
                </ul>
            </div>
        </div>
        
        <div class="input-card">
            <div class="title">syötä arvot</div>
            <div class="results">
            <fieldset>
            <form id="resform" name="resform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
               <input type="submit" class="btn btn-primary" value="tallenna" onClick="this.form.reset()">
            </div>
            </form>
            </fieldset>
            </div>
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
                <a href="diagram.php">
                <i class="fas fa-chart-bar"></i>
                <p>Taulukko</p>
                </a>    
            </div>
        </div>
        
    </div>
<footer>
<p>2019 &copy; Databois</p>
</footer>    

</body>