<?php 
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
if (!$loggedIn) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        
        <title>Connection Instructions</title>
        
        <!-- Google font link -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

        <!-- External CSS Link -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        
        <div class="navContainer">
            <ul id="navbar">
                <li class="nav" id="active"><a class="navLinks" href="history.php">Back To History</a></li>
                <li class="nav" id="active>"><a class="navLinks" href="instructions_page_azure.php">Azure Instructions</a> </li>
                <li class="nav"><a class="navLinks" href="configure_form.php">Configure</a> </li>
                
                <li class="nav"><a class="navLinks" href="paid_form.php">Paid</a></li>
                <li class="nav"><a class="navLinks" href="logout.php">Logout</a></li>
            </ul>
        </div>
        
        <div class="spacer"></div>
        <div class="connectionHeader">
            <h1>AWS Connection Information:</h1>
        </div>
        
        <div class="connectionWrapperDiv">
             
            
           
             
            <div class="instructions">
                <p>Be aware - it can take a few minutes for the instance to be ready so you can connect to it.
                </p>
                <p>Obtain your public DNS name or IP address and your username, which is likely ec2-user unless you changed it manually.</p>
                <h3>Connect to your instance using SSH:</h3>
                <p>1. Open a new terminal window</p>
                <p>2. Navigate to the directory where you saved your private key (.pem) file.  <a id="changeDirLink" href="https://www.git-tower.com/learn/git/ebook/en/command-line/appendix/command-line-101/">Here</a> is a resource that describes how to do so. </p>
                <p>3. It is important that you set the correct permissions for your private key file.  You do so with the command: chmod 400 my-key-pair.pem.</p>
                <p>4. Once you have moved into the directory where you saved your private key file using terminal, you will run the following command: <br> ssh -i "my-key-pair.pem" my-instance-user-name@my-instance-public-dns-name <br><br> For you, it may look closer to: <br> ssh -i "myKey.pem" ec2-user@ec2-198-51-100-1.compute-1.amazonaws.com</p>
                <p>5. (Optional) Verify that the displayed fingerprint is the same as the one you previously received if you chose to obtain an instance fingerprint. </p>
                <p>6. Enter yes when prompted, and you should see a success message similar to the following: <br> Warning: Permanently added 'ec2-198-51-100-1.compute-1.amazonaws.com' (ECDSA) to the list of known hosts. <br> At this point, you know your instance is up and running and you have connected successfully via SSH!</p>
            </div>
        
        </div>
    </body>

</html>