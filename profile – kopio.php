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


$
$col = "";
$sql = "UPDATE udata SET uid = $uid , $col =   WHERE uid = $uid";
?>


<!DOCTYPE html>
<html>
    
<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
        <title>profile</title>
</head>

<body>
    
<!-- The overlay -->
<div class="navbar">
    <a href="#" onclick="history.go(-1)" class="return-btn"><i class="fas fa-arrow-left"></i></a>    
        <p>BPapp</p>
        
</div>


<div class="row">
        
        <div class=setups>
          <div class="title">Profile</div>
          <div id="lresults">
            <ul>
                <li>Käyttäjänimi: <?php echo $uname;?> </li>
                <li>Nimi: <?php if(isset($fname) xor $lname === true){echo $fname." ".$lname;}else{echo "not set";}  ?>
                  <button class="open-button" onclick="openForm()">Muuta</button>

                  <div class="form-popup" id="myForm">
                    <form action="/action_page.php" class="form-container">
                      <h1>Nimi</h1>

                      <label for="email"><b>Etunimi</b></label>
                      <input type="text" placeholder="<?php if(isset($fname)== true){echo $fname;}else{echo "first name";}  ?>" name="fname">
                      <label for="email"><b>Sukunimi</b></label>
                      <input type="text" placeholder="<?php if(isset($lname)== true){echo $lname;}else{echo "last name";}  ?>" name="lname">

                      <button type="submit" class="btn">Hyväksy</button>
                      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                  </div>
              
              
              
                </li>
                <li>Sähköposti: <?php if(isset($email) == true){echo $email;}else{echo "not set";}  ?>

                </li>
                <li>Ikä: <?php if(isset($age) == true){echo $age;}else{echo "not set";} ?> 

                </li>
                <li>Pituus: <?php if(isset($height) == true){echo $height;}else{echo "not set";}  ?> 

                </li>
                <li>Paino: <?php if(isset($weight) == true){echo $weight;}else{echo "not set";}  ?> 

                </li>
                <li>Vaihda salasana: <br> <?php echo $a; ?> 

                </li>
            </ul>
        </div>
      </div>
    </div>
<footer>
<p>2019 &copy; Databois</p>
</footer>    

</body>