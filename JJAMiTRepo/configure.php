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

    extract($_POST);
    if ($platform == "aws") {
        file_put_contents("data.txt", "");

        $file=fopen("data.txt","a");
    
        fwrite($file, $ami . ":");
        fwrite($file, $instanceType . ":");
        fwrite($file, $count . ":");
        fwrite($file, $securityGroup . ":");
        fwrite($file, $region . ":");
        fwrite($file, $keyPair);
        fclose($file);
    } elseif ($platform == "azure") {
        file_put_contents("data.txt", "");
    
        $file = fopen("data.txt","a");
    
        fwrite($file, $instanceName . ":");
        fwrite($file, $resourceGroup . ":");
        fwrite($file, $system);
        fclose($file);
    } else {
        echo "Google Cloud will act here.";
    }

    $old_path = getcwd();
        
    chdir("/var/www/html/AZURE/");
    $output = shell_exec("./AzureCreateVM.sh");
        
    chdir($old_path);

    $action = empty($_POST['action']) ? '' : $_POST['action'];

    if($action == 'do_configure'){
        if($platform == 'aws'){
            create_aws();
            run_script_aws();
        }
        elseif($platform == 'azure'){
            create_azure();
            run_script_azure();
        }
    }
    else {
        echo "Unsuccessful action grab.";
    }

function run_script_aws(){
    if (isset($_REQUEST['submit'])) {
        $old_path = getcwd();
        
        chdir("AWS_CLI/");
        $output = shell_exec("./runInstanceTest.sh");
        
        chdir($old_path);
    }
}

function create_aws(){

    require_once 'db.conf';

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($mysqli->connect_error){
        $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
        require "configure_form.php";
        exit;
    }

    $ami = empty($_POST['ami']) ? '' : $_POST['ami'];
    $instanceType = empty($_POST['instanceType']) ? '' : $_POST['instanceType'];
    $count = empty($_POST['count']) ? '' : $_POST['count'];
    $securityGroup = empty($_POST['securityGroup']) ? '' : $_POST['securityGroup'];
    $region = empty($_POST['region']) ? '' : $_POST['region'];
    $keyPair = empty($_POST['keyPair']) ? '' : $_POST['keyPair'];
    $state = empty($_POST['state']) ? '' : $_POST['state'];
        
        
    $usernameForQuery = $_SESSION['loggedin'];
    $sql_query = "SELECT id FROM users WHERE username like '$usernameForQuery'";
        
    $result = mysqli_query($mysqli, $sql_query);
        
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['username'];
        $user_id = $row['id'];
                
        $_SESSION["user_id"] = $user_id;
            
        $sql = "INSERT INTO aws (userID, ami, instanceType, count, securityGroup, region, keyPair, state) VALUES ('$user_id', '$ami', '$instanceType', '$count', '$securityGroup', '$region', '$keyPair', '$state')";
        
        
        if($mysqli->query($sql) === TRUE) {
            
            require "configure_form.php";
            echo '<script type="text/javascript">';
            echo 'alert("Configuration Created Successfully! \r\n****Please click Download links at bottom at Configuration page****\r\nThis is needed to establish connection with your resources.\r\nFor more detailed instructions please click the Connection Instructions link on your History page.")';
            echo '</script>';
        }
        else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
            
        $result->free();
        
        $mysqli->close();
        exit;
            
    }       
}

    

function create_azure(){
    require_once 'db.conf';

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($mysqli->connect_error){
        $error = 'Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
        require "configure_form.php";
        exit;
    }

    $instanceName = empty($_POST['instanceName']) ? '' : $_POST['instanceName'];
    $resourceGroup = empty($_POST['resourceGroup']) ? '' : $_POST['resourceGroup'];
    $system = empty($_POST['system']) ? '' : $_POST['system'];


    $usernameForQuery = $_SESSION['loggedin'];
    $sql_query = "SELECT id FROM users WHERE username like '$usernameForQuery'";
        
    $result = mysqli_query($mysqli, $sql_query);
        
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['username'];
        $user_id = $row['id'];
            
        $_SESSION["user_id"] = $user_id;
            
            
        $sql = "INSERT INTO azure (userID, instanceName, resourceGroup, system) VALUES ('$user_id', '$instanceName', '$resourceGroup', '$system')";

        
        if($mysqli->query($sql) === TRUE) {
            require "configure_form.php";
            echo '<script type="text/javascript">';
            echo 'alert("Configuration Created Successfully! \r\n****Please click Download links at bottom at Configuration page****\r\nThis is needed to establish connection with your resources.\r\nFor more detailed instructions please click the Connection Instructions link on your History page.")';
            echo '</script>';
        }
        else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        $result->free();
        
        $mysqli->close();
        exit;        
    }      
}

?>
