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

if($_SERVER["REQUEST_METHOD"] == "POST"){


 $col = "";
 $col2 = "";
 $value = "";
 $value2= "";

 $sql1 = "UPDATE udata SET uid = $uid , $col = $value , $col2 = $value2 ,  WHERE uid = $uid ";
 if($stmt = mysqli_prepare($link, $sql1)){
 }else{echo "1";
 }
 if(mysqli_stmt_execute($stmt)){
  mysqli_stmt_close($stmt);
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
        <script src="js/form.js"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
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
        <div class="title">Profiili</div>
          <div id="lresults">
            <ul>
                 <li>Käyttäjänimi: <?php echo $uname;?>
               </li>

                <li>Nimi: <?php if(isset($fname) xor $lname === true){echo $fname." ".$lname;}else{echo "Ei asetettu";}  ?>
                  <button class="open-button" onclick="openForm1()">Muuta</button>

                 <div class="form-popup" id="myForm1">
                    <form action="profile.php" class="form-container" method="post">
                      <h1>Nimi</h1>

                      <label for="fname"><b>etunimi</b></label>
                      <input type="text" placeholder="<?php if(isset($fname)== true){echo $fname;}else{echo "etunimi";}  ?>" name="firstname">
                      <label for="lname"><b>sukunimi</b></label>
                      <input type="text" placeholder="<?php if(isset($lname)== true){echo $lname;}else{echo "sukunimi";}  ?>" name="lastname">

                      <button type="submit" class="btn" onclick=<?php $col="firstname"; $col2="lastname";?>     >tallenna</button>
                      <button type="button" class="btn cancel" onclick="closeForm1()">sulje</button>
                    </form>
                  </div>
              
              
              
                </li>
                <li>Sähköposti: <?php if(isset($email) == true){echo $email;}else{echo "Ei asetettu";}  ?>
                <button class="open-button" onclick="openForm2()">Muuta</button>
                
                <div class="form-popup" id="myForm2">
                  <form action="profile.php" class="form-container" method="post">
                    <h1>Sähköposti</h1>
                      
                    <label for="email"><b>Email osoite</b></label>
                    <input type="text" placeholder="<?php if(isset($email)== true){echo $email;}else{echo "example@email.com";}  ?>" name="email">

                    <button type="submit" class="btn" onclick=<?php $col="email";?>>tallenna</button>
                    <button type="button" class="btn cancel" onclick="closeForm2()">sulje</button>
                  </form>
                </div>
                
                </li>
                <li>Ikä: <?php if(isset($age) == true){echo $age;}else{echo "ei asetettu";} ?>
                <button class="open-button" onclick="openForm3()">Muuta</button>

                <div class="form-popup" id="myForm3">
                  <form action="profile.php" class="form-container" method="post">
                    <h1>Ikä</h1>

                    <label for="age"><b>Ikä</b></label>
                    <input type="text" placeholder="<?php if(isset($age)== true){echo $age;}else{echo "ei asetettu";}  ?>" name="age">

                    <button type="submit" class="btn"onclick=<?php $col="age"; ?> >tallenna</button>
                    <button type="button" class="btn cancel" onclick="closeForm3()">sulje</button>
                  </form>
                </div> 

                </li>
                <li>Pituus: <?php if(isset($height) == true){echo $height;}else{echo "not set";}  ?> 
                <button class="open-button" onclick="openForm4()">Muuta</button>

                <div class="form-popup" id="myForm4">
                  <form action="profile.php" class="form-container" method="post">
                    <h1>Pituus</h1>

                    <label for="height"><b>Pituus</b></label>
                    <input type="text" placeholder="<?php if(isset($height)== true){echo $height;}else{echo "Ei asetettu";}  ?>" name="height">

                    <button type="submit" class="btn" onclick=<?php $col="height";?>   >tallenna</button>
                    <button type="button" class="btn cancel" onclick="closeForm4()">sulje</button>
                  </form>
                </div> 

                </li>
                <li>Paino: <?php if(isset($weight) == true){echo $weight;}else{echo "Ei asetettu";}  ?> 
                <button class="open-button" onclick="openForm5()">Muuta</button>

                <div class="form-popup" id="myForm5">
                  <form action="/profile.php" class="form-container" method="post">
                    <h1>Paino</h1>

                    <label for="weight"><b>Paino</b></label>
                    <input type="text" placeholder="<?php if(isset($weight)== true){echo $weight;}else{echo "not set";}  ?>" name="weight">

                    <button type="submit" class="btn" onclick=<?php $col="weight"; ?>   >tallenna</button>
                    <button type="button" class="btn cancel" onclick="closeForm5()">sulje</button>
                  </form>
                </div>

                </li>
            </ul>
        </div>
      </div>
    </div>
<footer>
<p>2019 &copy; Databois</p>
</footer>    

</body>