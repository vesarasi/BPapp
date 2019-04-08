 
<-- -------------------   connecting to db ---------------------- -->
<?php
// db credentials 
$servername = 'mysql.metropolia.fi';
$username = 'mattii';
$password = 'mummola';
$dbname = 'mattii';
$port = '3306';
//attempt to connect to dp
$link = mysqli_connect($servername, $username, $password, $dbname, $port);

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>


<-- ------------------------ creating account scripts --------------- -->

<?php

// placeholder datab connekt
require_once "config.php";

// create variables
$uid = 
$username =
$password =
$confirm_password = "";

$username_err = 
$password_err = 
$confirm_password_err = "";

// Validate username
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} else{
    // Prepare a select statement 
    $sql = "SELECT uid FROM login WHERE username = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind stuff to stuff
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set values nstuff
        $param_username = trim($_POST["username"]);

        // Attempt to send the stuff
        if(mysqli_stmt_execute($stmt)){
            // store result 
            mysqli_stmt_store_result($stmt);
            // check if uname b unique
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        //incase of shitstorm    
        } else{
            echo "Oops! you broke it.";
        }
    }    
    // Close statement
    mysqli_stmt_close($stmt);

 // Validate password that is longer than 6. no other rules
 if(empty(trim($_POST["password"]))){
    $password_err = "Please enter a password.";     
} elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Password must have atleast 6 characters.";
} else{
    $password = trim($_POST["password"]);
}   

 // Validate confirm password
 if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Please confirm password.";     
} else{
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
    }
}

    // Check for fubar before fucking the db
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement and create table statement
        $sql = "INSERT INTO login (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind values to stuff
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set values
            $param_username = $username;
            //hash pw 
            $param_password = password_hash($password, PASSWORD_DEFAULT); 


             // Attempt to execute mysql
             if(mysqli_stmt_execute($stmt)){
                $sql = "SELECT uid FROM login WHERE (username) VALUES (?)" ;
 
                //redirect to somewhere
                header("location: #");
                //incase of fubar
                }
            } else{
                echo "oops! you broke it.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);    
// Close connection?
mysqli_close($link);
    }
?>

<-- ------------------------ Login scripts -------------------------- -->


<?php
// make php sessio
session_start();
 
// Check if already in n redirect if so
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
// placeholder datab connekt
require_once "config.php";
 
// create variables
$username = $password = "";
$username_err = $password_err = "";
$randomvar = "";
// get data from form
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check user slot is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if pw is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT uid, username, password FROM login WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind the statement
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user exists, if so check pw
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind results
                    mysqli_stmt_bind_result($stmt, $uid, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true; 
                            $_SESSION["uid"] = $uid;
                            $_SESSION["username"] = $username;
                            
                          //  $randomvar = trim($_SESSION["uid"], "\" \' \`");
                          $randomvar = $_SESSION["uid"];
                            $sql = "CREATE TABLE IF NOT EXISTS `{$randomvar}` (rid INT(11) UNIQUE AUTO_INCREMENT, syd INT(3), dia INT(3), pulse INT(3), time DATETIME)";
                            if($stmt = mysqli_prepare($link, $sql)){
                                if(mysqli_stmt_execute($stmt)){
                                
                                }else{die;
                                }


                            header("location: ");
                            }                      
                            
                            // Redirect user to index page
                            header("location: ");
                        } else{
                            //error if pw is wrong
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // error if user is wrong
                    $username_err = "No account found with that username.";
                }
                //incase of fubar
            } else{
                echo "Oops! You broke it.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}

    
?>


<-------- downloading last pb measure results-------------->


<?php
// Check if logged in / redirect to login
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: Bpapp_loginpage.php");
    exit;
}
// placeholder datab connekt
require_once "config.php";

// create sum variabls. if you change the names, do so in all the files.
$sys = "";
$dia = "";
$pulse = "";


//get the last saved values from db based on session user id, sorted based on last result id.
$randomvar = $_SESSION["uid"];
$sql = "SELECT sys, dia, pulse FROM `{$randomvar}` ORDER BY rid DESC LIMIT 1";
//prep the statement
    if($stmt = mysqli_prepare($link, $sql)){
        //run it
        if(mysqli_stmt_execute($stmt)){
            //store dem datas
            mysqli_stmt_store_result($stmt);
            // Check if got sum data
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind results
                mysqli_stmt_bind_result($stmt, $syd, $dia, $pulse);

            }else{header("location:error_page.php ");}
           
        }else{header("location:error_page.php ");}

         // Close statement
         mysqli_stmt_close($stmt);

    }else{header("location:error_page.php ");}

    // Close connection
    mysqli_close($link);
    

?>

<-------- uploading  pd measures ------>
<?php
// Check if logged in / redirect to login
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: Bpapp_loginpage.php");
    exit;
}
// placeholder datab connekt
require_once "config.php";

// create sum variabls. if you change the names, do so in all the files.
$sys = 
$dia = 
$pulse = "";

$sys_err =
$dia_err =
$pulse_err = "";

//parsel the form
if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Validate systolic value
    if(empty(trim($_POST["sys"]))){
        $username_err = "insert syspb.";
    } else{$_SESSION["sys"] = $_POST["sys"];
}
{
    // Validate diastolic value
    if(empty(trim($_POST["dia"]))){
        $username_err = "insert diapb.";
    } else{$_SESSION["dia"] = $_POST["dia"];
}
{
    // Validate pulse value
    if(empty(trim($_POST["pulse"]))){
        $username_err = "insert pulse.";
    } else{$_SESSION["pulse"] = $_POST["pulse"];
}




?>


<---- we gon be here often script ----->
<?php
}else{header("location:error_page.php ");}
?>

<----- ---->
            <!-- insert results 
        
        <div class="profile-card">
            <div class="title">results</div>
            <h2>syötä arvot</h2>
            <div id="results">
            <fieldset>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($sys_err)) ? 'has-error' : ''; ?>">
                <label>sys</label>
                <input type="sys" name="sys" class="form-control" value="<?php echo $sys; ?>">
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

-->