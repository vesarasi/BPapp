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
 
 
 
 
 <!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>BP App Login</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		<div id="loginPage">
			<div id="headline"><p>Welcome to BPapp <br> </p></div>
            <fieldset>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                Create new user<br>
                <br>
            Username <br> <input type="text" name="username">
            <br> 
            <br>
            Password <br> <input type="password" name="confirm_password">
            <br> 
            <br>
            Password again <br> <input type="password" name="pwd">
            <input type="hidden" name="form_submitted" value="1" />
            <br><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="BPapp_loginpage.php">Login here</a>.</p>
        </form>
            <br>
            <input type="submit" value="Create profile"><br>
            </fieldset>
        </form>
		</div>
	</body>
</html> 
