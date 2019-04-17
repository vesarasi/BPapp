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
        <script src="js/script.js"></script>
        
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
                <li>username: <?php echo $uname;?> </li>
                <li>name: <?php if(isset($fname) xor $lname === true){echo $fname." ".$lname;}else{echo "not set";}  ?>
                  <button class="open-button" onclick="openForm()">Change</button>

                  <div class="form-popup" id="myForm">
                    <form action="/action_page.php" class="form-container">
                      <h1>Name</h1>

                      <label for="email"><b>first name</b></label>
                      <input type="text" placeholder="<?php if(isset($fname)== true){echo $fname;}else{echo "first name";}  ?>" name="fname">
                      <label for="email"><b>first name</b></label>
                      <input type="text" placeholder="<?php if(isset($lname)== true){echo $lname;}else{echo "last name";}  ?>" name="lname">

                      <button type="submit" class="btn">Apply</button>
                      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                  </div>
              
              
              
                </li>
                <li>Email: <?php if(isset($email) == true){echo $email;}else{echo "not set";}  ?>

                </li>
                <li>age: <?php if(isset($age) == true){echo $age;}else{echo "not set";} ?> 

                </li>
                <li>height: <?php if(isset($height) == true){echo $height;}else{echo "not set";}  ?> 

                </li>
                <li>weight: <?php if(isset($weight) == true){echo $weight;}else{echo "not set";}  ?> 

                </li>
                <li>Change password <br> <?php echo $a; ?> 

                </li>
            </ul>
        </div>
      </div>
<footer>
<p>2019 &copy; Databois</p>
</footer>    

</body>