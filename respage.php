<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login.php");
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
$sql = "SELECT sys, dia, pulse, time FROM results WHERE uid = ? ORDER BY rid DESC LIMIT 1 VALUE (?)";
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
        <script src="js/script.js"></script>
        <title>respage</title>
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
<div class="row">
        <div class="logo">
        <h1>Logo tähän</h1>
        </div>


        <div class="profile-card">
          <div class="title">latest results</div>
          <div id="lresults">
            <ul>
                <li>Sys:   <?php echo $sysl;?> </li>
                <li>Dia:   <?php echo $dial; ?></li>
                <li>Pulse: <?php echo $pulsel; ?></li>
                <li>time measured: <br> <?php echo $timel; ?> </li>
            </ul>
            <div class="profile-card">
            <div class="title">results</div>
            <h2>syötä arvot</h2>
            <div id="results">
            <fieldset>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($sys_err)) ? 'has-error' : ''; ?>">
                <label>sys</label>
                <input type="sys" name="sys" class="form-control">
                <span class="help-block"><?php echo $sys_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($dia_err)) ? 'has-error' : ''; ?>">
                <label>dia</label>
                <input type="dia" name="dia" class="form-control">
                <span class="help-block"><?php echo $dia_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($pulse_err)) ? 'has-error' : ''; ?>">
                <label>pulse</label>
                <input type="pulse" name="pulse" class="form-control">
                <span class="help-block"><?php echo $pulse_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="results">
            </div>
            </form>
            </fieldset>
            </div>
		    </div>
<footer>
<p>2019 &copy; Databois</p>
</footer>    

</body>