<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
 
// Check if already in n redirect to index if so

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;}

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
                                                                           
                            // Redirect user to index page-------------------------------------------------
                            header("location: index.php");
                        } else{
                            //error if pw is wrong
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // error if user is wrong
                    $username_err = "Login failed.";
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
 <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
        <title>BP App Login</title>
	</head>

	<body>
        <div class="row">
            
            <div class="headline">
                <div class="logo">
                    <img src="img/BPapp_logo.png">
                    <p>BPapp</p>
                </div>
            </div>
            

            <div class="input-card">
                <div class="login">
                <fieldset>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Käyttäjänimi</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Salasana</label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Kirjaudu">
                        </div>
                    </form>
                    <p>TAI</p><br>
                    <a class="navi" href="create_user.php">Luo uusi käyttäjä</a>
                </fieldset>
                </div>
            </div>
		
        </div>
	</body>
</html> 