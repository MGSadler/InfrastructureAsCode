<?php 
    /*
        Code used from lectures - start
    */

    if(!session_start()){
        header("Location: error.php");
        exit;
    }

    // Destroy all session data
    $_SESSION = array();

    // If the session was propagated using a cookie, remove that cookie
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(), '', 1,
                  $params["path"], $params["domain"],
                  $params["secure"], $params["httponly"]
            );
    }

    // Destroy the session
    session_destroy();

    // Redirect to login
    header("Location: login.php");
    exit;
?>
