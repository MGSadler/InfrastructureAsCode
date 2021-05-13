<?php 

// https redirect
if($_SERVER['HTTPS'] !== 'on'){
    $redirectURL = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $header("Location: $redirectURL");
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

// If the user is logged in, redirect them home
if ($loggedIn) {
    header("Location: configure_form.php");
    exit;
}

// Pull out "action" value from $_POST
$action = empty($_POST['action']) ? '' : $_POST['action'];

if ($action == 'do_login') {
    // If the action is "do_login", then the form was submitted
    handle_login();
} else {
    // Else, the form wasn't submitted, so present the login
    login_form();
}

function handle_login() {
    $username = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];
    
    // Require the credentials
    require_once "db.conf";
    
    // Connect to database
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // Check for errors
    if ($mysqli->connect_error) {
        $error = 'Error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error;
        require "login_form.php";
        exit;
    }
       
    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);
    
    $query = "SELECT id FROM users WHERE username = '$username' AND userPassword = sha1('$password')";
    

    $result = $mysqli->query($query);
    
    if($result){
        $match = $result->num_rows;
        
        if($match == 1) {
            $_SESSION['loggedin'] = $username;
            header("Location: configure_form.php");

        } else {
            $error = "Error: Incorrect username or password";
            require "login_form.php";

        }
    }
    else {
        $error = 'Login Error: Please contact the system administrator.';
        require "login_form.php";
        exit;
    }
    
    $result->close();
    $mysqli->close();
    exit;
}

function login_form() {
    $username = "";
    $error = "";
    require "login_form.php";
}

?>
