<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);


if(isset($_SESSION["loggedin"]) == false){
    header("location: login.php");
    exit;
}
// placeholder datab connekt
require_once "config.php";

$uname = $_SESSION["username"];
$fname = "";
$lname = "";
$age = "";
$height = "";
$weight = "";
$email = "";

$uid = $_SESSION["uid"];
$sql= "SELECT firstname , lastname , age, height, weight, email FROM udata WHERE uid = ?";
if($stmt = mysqli_prepare($link, $sql)){
  mysqli_stmt_bind_param($stmt, "i" , $uid);
        //run it
        if(mysqli_stmt_execute($stmt)){
            //store dem datas
            mysqli_stmt_store_result($stmt);
            // Check if got sum data
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind results
                mysqli_stmt_bind_result($stmt, $fname, $lname, $age, $height,$weight,$email);

                if(mysqli_stmt_fetch($stmt)) {
                }else{echo "z";}

                 

            }else{echo "1";}
           
        }else{echo "2";}

         // Close statement
         mysqli_stmt_close($stmt);

}else{echo "3";}



$array = "";
$sql = "INSERT INTO udata ( `{&array}` ) ";
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
          <div class="title">Profile</div>
          <div id="lresults">
            <ul>
                <li>username: <?php echo $uname;?> </li>
                <li>name: <?php if(isset($fname) xor $lname === true){echo $fname." ".$lname;}else{echo "not set";}  ?></li>
                <li>Email: <?php if(isset($email) == true){echo $email;}else{echo "not set";}  ?> </li>
                <li>age: <?php if(isset($age) == true){echo $age;}else{echo "not set";} ?> </li>
                <li>height: <?php if(isset($height) == true){echo $height;}else{echo "not set";}  ?> </li>
                <li>weight: <?php if(isset($weight) == true){echo $weight;}else{echo "not set";}  ?> </li>
                <li>Change password <br> <?php echo $a; ?> </li>
            </ul>
            <div class="profile-card">
            <div class="title">results</div>
            <h2></h2>
            <div id="results">
            <fieldset>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            </form>
            </fieldset>
            </div>
		    </div>
<footer>
<p>2019 &copy; Databois</p>
</footer>    

</body>