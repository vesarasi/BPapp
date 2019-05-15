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
    $username_err = "Kirjoita käyttäjänimi";
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
                $username_err = "Käyttäjänimi on jo käytössä";
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
    $password_err = "Kirjoita salasana.";     
} elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Salasanassa täytyy olla vähintään 6 merkkiä.";
} else{
    $password = trim($_POST["password"]);
}   

 // Validate confirm password
 if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Vahvista salasana.";     
} else{
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Salasanat eivät täsmää.";
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
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"><br>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Salasana</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Vahvista salasana</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Vahvista">
            </div>
            <p>Sinulla on jo tunnukset? <a href="login_page.php">Kirjaudu täältä</a>.</p>
        </form>
            </fieldset>
            </div>
        </div>
        </div>
	</body>
</html> 
