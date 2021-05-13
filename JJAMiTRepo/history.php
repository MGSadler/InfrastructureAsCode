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
    <title>Account History</title>

    <!-- Google font link -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- External CSS Link -->
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>
    <!-- Create the navbar and links -->
    <div class="navContainer">
        <ul id="navbar">
            <li class="nav"><a class="navLinks" href="configure_form.php">Configure</a></li>
            <li class="nav" id="active"><a class="navLinks" href="history.php">History</a></li>
            <li class="nav"><a class="navLinks" href="paid_form.php">Paid</a></li>
            <li class="nav"><a class="navLinks" href="logout.php">Logout</a></li>
        </ul>
    </div>


    <div class="spacer"></div>

    <div class="wrapperDiv">
        <h1 class="wrapperHeader">Your Account History</h1>
        <a class="instructions" href="instructions_page.php">AWS Connection Instructions</a>
        <a class="instructions" href="instructions_page_azure.php">Azure Connection Instructions</a>
        
        <h2 class="contentHeader">View The Settings of Your Current and Previous Configurations</h2>

        <div class="contentWrapper">
            
            
            <!--
                Reference: https://www.w3schools.com/howto/howto_js_tabs.asp
                - Start
            -->
            
            
            <div class="configsWrapper">
                <!-- Tab links -->
                <div class="configsTabs">
                    <button class="tablinks" onclick="openVideo(event, 'AWS')">AWS</button>
                    <button class="tablinks" onclick="openVideo(event, 'Azure')">Azure</button>
                </div>
            
                <!-- Tab content -->
                <div id="AWS" class="tabcontent">
                    <h3>AWS Configurations</h3>
                    <p>Here is a review of your AWS Configurations</p>
                    <?php $selection = "aws";?>
                    
                    <?php
                    if($selection == "aws"){
                        display_aws();
                    }
                    
                    function display_aws(){
                        require 'db.conf';

                        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                        // Check for errors
                        if ($mysqli->connect_error){
                            $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
                            require "configure_form.php";
                            exit;
                        }
                        
                        $usernameForQuery = $_SESSION['loggedin'];

                        $sql_query = "SELECT id FROM users WHERE username like '$usernameForQuery'";

                        $result = mysqli_query($mysqli, $sql_query);
                        
                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $name = $row['username'];
                            $user_id = $row['id'];

                            $_SESSION["user_id"] = $user_id;
                            
                            $query = "SELECT * FROM aws WHERE userID = $user_id";
                            
                            $result = mysqli_query($mysqli, $query);
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "****** No AWS Configurations Found ******";
                            }
                            
                            $configuration = 1;
                               
                        }

                            if($result = $mysqli->query($query)) {
                                while ($row = $result->fetch_assoc()){
                                    $field1 = $row["ami"];
                                    $field2 = $row["instanceType"];
                                    $field3 = $row["count"];
                                    $field4 = $row["securityGroup"];
                                    $field5 = $row["region"];
                                    $field6 = $row["keyPair"];
                                    $field7 = $row["state"];

                                    echo "Configuration $configuration: <br />";

                                    switch($field1){
                                        case "ami-03d64741867e7bb94":
                                            $field1 = "RHEL";
                                            break;
                                        case "ami-08962a4068733a2b6":
                                            $field1 = "Ubuntu";
                                            break;
                                        case "ami-0ef98d91ff9126a43":
                                            $field1 = "Mac";
                                            break;
                                        case "ami-0b697c4ae566cad55":
                                            $field1 = "Windows";
                                            break;
                                        case "ami-0f052119b3c7e61d1":
                                            $field1 = "SUSE";
                                            break;
                                        default:
                                            $field1 = "Linux";
                                    }

                                    if($field2 == "t4gmicro"){
                                        $field2 = "t4g.micro";
                                    }

                                    if($field4 == "sg-0fe281761a436b242"){
                                        $field4 = "SSH, HTTP, HTTPS";
                                    }

                                    switch($field5){
                                        case "us-east-2":
                                            $field5 = "US East 2 (Ohio)";
                                            break;
                                        case "us-west-1":
                                            $field5 = "US West 1 (N. California)";
                                            break;
                                        case "us-west-2":
                                            $field5 = "US West 2 (Oregon)";
                                            break;
                                        default:
                                            $field5 = "US East 1 (Virginia)";
                                    }

                                    echo 'AMI: '.$field1.'<br />';
                                    echo 'Instance Type: '.$field2.'<br />';
                                    echo 'Count: '.$field3.'<br />';
                                    echo 'Security Group: '.$field4.'<br />';
                                    echo 'Region: '.$field5.'<br />';
                                    echo 'Key Pair File: '.$field6.'<br />';
                                    echo 'Current State: '.$field7.'<br />';

                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                    
                                    $configuration++;
                                }

                            }
                            else {
                                echo "Error: " . $sql . "<br>" . $mysqli->error;
                            }

                            $result->free();

                            $mysqli->close();
                        
                            
                        }

                    ?>
                    
                </div>

                <div id="Azure" class="tabcontent">
                    <h3>Azure Configurations</h3>
                    <p>Here is a review of your Azure Configurations</p>
                    <?php $selection = "azure";?>
                    
                    <?php
                    if($selection == "azure"){
                        display_azure();
                    }
                    
                    function display_azure(){
                        require 'db.conf';

                        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                        // Check for errors
                        if ($mysqli->connect_error){
                            $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
                            require "configure_form.php";
                            exit;
                        }
                        
                        $usernameForQuery = $_SESSION['loggedin'];

                        $sql_query = "SELECT id FROM users WHERE username like '$usernameForQuery'";

                        $result = mysqli_query($mysqli, $sql_query);
                        
                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $name = $row['username'];
                            $user_id = $row['id'];
            
                            $_SESSION["user_id"] = $user_id;
                            
                            $query = "SELECT * FROM azure WHERE userID = $user_id";
                            
                            $result = mysqli_query($mysqli, $query);
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "****** No Azure Configurations Found ******";
                            }
                            
                            $configuration = 1;
                            
                            if($result = $mysqli->query($query)) {
                                while ($row = $result->fetch_assoc()){
                                    $field1 = $row["instanceName"];
                                    $field2 = $row["resourceGroup"];
                                    $field3 = $row["system"];
                
                                    echo "Configuration $configuration: <br />";
                
                                    switch($field3){
                                        case "Ubuntu LTS":
                                            $field3 = "Ubuntu LTS";
                                            break;
                                        case "Centos8":
                                            $field3 = "Centos8";
                                            break;
                                        default:
                                            $field3 = "RHEL";
                                    }
                    
                                    echo 'Instance Name: '.$field1.'<br />';
                                    echo 'Resource Group: '.$field2.'<br />';
                                    echo 'System: '.$field3.'<br />';
                
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                
                                    $configuration++;
                                }
                
                            }
                            else {
                                echo "Error: " . $sql . "<br>" . $mysqli->error;
                            }
            
                            $result->free();
        
                            $mysqli->close();
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
             

    <script type="text/javascript">
        
        
        function openVideo(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>
    
    
</body>

</html>
