<?php

// https redirect
if($_SERVER['HTTPS'] !== 'on'){
    $redirectURL = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirectURL");
    exit;       
}

// We are using sessions to propagate login
// We must call session_start() in order to access the $_SESSION array
if(!session_start()){
    // If the session couldn't start, present an error
    header("Location: error.php");
    exit;
}

$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];

if(!$loggedIn){
    header("Location: login.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0, s-maxage=0");
header("Pragma:no-cache");
header("Expires:0");
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Configure Paid Settings</title>

    <!-- Google font link -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- External CSS Link -->
    <link rel="stylesheet" href="styles.css">
    
    <!-- jQuery Link -->
    <link rel="stylesheet" type="text/css" href="./jquery-ui-1.11.4.custom/jquery-ui.min.css">
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    
    <script>
        $(function() {
            $("input[type=submit]").button();
            
            $("#password, #confirmPass").keyup(function(){
               var password = $("#password").val();
                var confirmPassword = $("#confirmPass").val();
                
                if(password.localeCompare(confirmPassword) != 0){
                    document.getElementById("confirmPass").setCustomValidity("Passwords Don't Match!");
                }
                else {
                    document.getElementById("confirmPass").setCustomValidity("");
                }
            });
        });

    </script>

</head>

<body>
    <!-- Create the navbar and links -->
    <div class="navContainer">
        <ul id="navbar">
            <li class="nav"><a class="navLinks" href="configure_form.php">Configure</a></li>
            <li class="nav"><a class="navLinks" href="history.php">History</a></li>
            <li class="nav" id="active"><a class="navLinks" href="paid_form.php">Paid</a></li>
            <li class="nav"><a class="navLinks" href="logout.php">Logout</a></li>
        </ul>
    </div>


    <div class="spacer"></div>

    <div class="loginWrapperDiv">
        
        <div id="loginWidget" class="ui-widget">
            <h1>Select Settings For Paid Services</h1>

            
            <?php
                if($error) {
                    print "<div class=\"ui-state-error\">$error</div>\n";
                }
            ?>

            <form name="tetrisForm" action="join.php" method="post">

                <input type="hidden" name="action" value="do_create">

                <div class="stack">
                    <label for="ami">Choose Your AMI:</label>
                    <select id="ami" name="ami" class="ui-widget-content ui-corner-all" autofocus required>
                        <option value="Linux">Linux</option>
                        <option value="Rhel">RHEL</option>
                        <option value="Ubuntu">Ubuntu</option>
                        <option value="Mac">Mac</option>
                        <option value="Windows">Windows</option>
                    </select>
                </div>

                <div class="stack">
                    <label for="type">Select Type:</label>
                    <select id="type" name="type" class="ui-widget-content ui-corner-all" required>
                        <option value="t2micro">t2.micro</option>
                        <option value="t4gmicro">t4g.micro</option>
                    </select>
                </div>
                
                <div class="stack">
                    <label for="count">Number of Instances:</label>
                    <input type="number" min="1"  id="count" name="count" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="securityGroup">Set Security Group:</label><br>
                    <input type="checkbox" id="option1" name="option1" value="SSH" class="ui-widget-content ui-corner-all" required>
                    <label for="option1">SSH</label><br>
                    <input type="checkbox" id="option2" name="option2" value="HTTP" class="ui-widget-content ui-corner-all" required>
                    <label for="option2">HTTP</label><br>
                    <input type="checkbox" id="option3" name="option3" value="HTTPS" class="ui-widget-content ui-corner-all" required>
                    <label for="option3">HTTPS</label><br>
                </div>
                
                <div class="stack">
                    <label for="region">Choose Region:</label>
                    <select id="region" name="region" class="ui-widget-content ui-corner-all" required>
                        <option value="useast1">US East 1 (Virginia)</option>
                        <option value="useast2">US East 2 (Ohio)</option>
                        <option value="uswest1">US West 1 (N. California)</option>
                        <option value="uswest2">US West 2 (Oregon)</option>
                    </select>
                </div>
                
                <div class="stack">
                    <label for="keyPair">Enter Key-Pair Filename:</label>
                    <input type="text" id="keyPair" name="keyPair" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="action">Choose Action:</label>
                    <select id="action" name="action" class="ui-widget-content ui-corner-all" required>
                        <option value="start">Start</option>
                        <option value="stop">Stop</option>
                        <option value="terminate">Terminate</option>
                    </select>
                </div>

                <div class="stack">
                    <input type="submit" value="Submit">
                </div>

            </form>
            <br>
            <div id="outputDiv"></div>
            
        </div>
    </div>

</body>

</html>