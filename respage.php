<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
<<<<<<< HEAD
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
    <!--connects to mysql dp via php magick-->
    <?php
    $servername = 'mysql.metropolia.fi';
    $username = 'mattii';
    $password = 'mummola';
    $dbname = 'mattii';
    $port = '3036';

    $link = mysqli_connect($servername, $username, $password, $dbname, $port);
    
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
    
    mysqli_close($link);
    ?>
    

    <!-- dropdown menu?-->
    <div class="menu">
        <ul>
            <li></li>
        </ul>
    </div>
    <!-- header?-->
    <div class="row">
        <div class="logo">
        <h1>BPapp</h1>
=======
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/script.js"></script>
        <title>Homepage</title>
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

<!-- Use any element to open/show the overlay navigation menu -->       
    <div class="navbar">
        <p>BPapp</p>
        <span class="menubtn" onclick="openNav()">&#9776;</span>
    </div>
        
       <div class="row">
        <div class="logo">
        <h1>Logo tähän</h1>
>>>>>>> 79898a39bdd2a601b8ac36cdb8e184d6eb9f1d98
        </div>
    <!-- previous results. php magic pulls last entry from db -->

    <div class="col-5 col-s-5">
        <h1>viimeisimmät tulokset</h1>
<<<<<<< HEAD
        <?php
        $sql = 'SELECT * FROM `results mockup`  ORDER BY `time` DESC LIMIT 1';
        $retval = mysql_query( $sql, $link )
        echo
        if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }
         
         while($row = mysql_fetch_array($retval, MYSQL_NUM)) {
            echo
               "Systolic :{$row[0]}  <br> ".
               "Diastolic : {$row[1]} <br> ".
               "pulse : {$row[2]} <br> ".
               "--------------------------------<br>";}

        mysql_free_result($retval)
       
       ?>
=======

       
>>>>>>> 79898a39bdd2a601b8ac36cdb8e184d6eb9f1d98

    </div>
    <!--insert new results via php magic. once applied, ask for confirmation before inserting into db-->
    <div class="col-9 col-s-9">
        <form method="post">
                <label for="sys">Systolic BP</label>
                <input type="text" name="sys" id="sys"><br>
                <label for="dia">Diastolic BP</label>
                <input type="text" name="dia" id="dia"><br>
                <label for="pulse">Pulse</label>
                <input type="text" name="pulse" id="pulse"><br>
        </form>
        
<<<<<<< HEAD
        //<!--php magick that uses sql magic to create or update the table named after the uses uid for name containing the measurement results. -->
        <?php
        $sql = "UPDATE TABLE $UID (
        `SYS` INT(3) NOT NULL,
        `DIA` INT(3) NOT NULL,
        `pulse` INT(3) NOT NULL, 
        `TIME` TIMESTAMP
        )";
        $sql = "INSERT INTO $UID (SYS, DIA, PULSE, `TIME` )
        VALUES ("sys", ";$dia;", ";$pulse;", TIMESTAMP )"; 
        ?>
    </div>
=======

    </div>
    <footer>
        <p>2019 &copy; Databois</p>
    </footer>    
>>>>>>> 79898a39bdd2a601b8ac36cdb8e184d6eb9f1d98
</body>
</html>