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

if ($action == 'do_create') {
    // If the action is "do_login", then the form was submitted
    create_user();
} else {
    // Else, the form wasn't submitted, so present the login
    login_form();
}

function create_user() {
    $firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
    $lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
    $username = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];
    $confirmPass = empty($_POST['confirmPass']) ? '' : $_POST['confirmPass'];
    $birthday = empty($_POST['birthday']) ? '' : $_POST['birthday'];
    $email = empty($_POST['email']) ? '' : $_POST['email'];
    

    if(strcmp($password, $confirmPass) == 0){
        // Require the credentials
        require_once "db.conf";
    
        // Connect to database
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        // Check for errors
        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
            require "login_form.php";
            exit;
        }
       
        $firstName = $mysqli->real_escape_string($firstName);
        $lastName = $mysqli->real_escape_string($lastName);
        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        $confirmPass = $mysqli->real_escape_string($confirmPass);
        $birthday = $mysqli->real_escape_string($birthday);
        $email = $mysqli->real_escape_string($email);
    
        $query = "INSERT INTO users (firstName, lastName, username, userPassword, email, birthday) VALUES ('$firstName', '$lastName', '$username', sha1('$password'), '$email', STR_TO_DATE('$birthday', '%Y-%m-%d'))";
    

    
        if($mysqli->query($query) === TRUE){
                $error = "New User Created Successfully!";
                require "login_form.php";
                
        }
        else {
            $error = 'Insert Error: ' . $query . '<br>' . $mysqli->error;
            require "join_form.php";
           
        }
    
        $mysqli->close();
        exit;

    }
    else {
    $error = "Error: Passwords do not match!";
    require "join_form.php";
    exit;
}

}


function login_form() {
    $username = "";
    $error = "";
    require "login_form.php";
}

?>
