<?php
// https redirect
if($_SERVER['HTTPS'] !== 'on'){
    $redirectURL = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirectURL");
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
    <title>JJAMiT | IaC</title>

    <!-- Google font link -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- External CSS Link -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Create the navbar and links -->
    <div class="navContainer">
        <div class="leftNav">
            <a class="navLink" href="login_form.php">Login</a>
        </div>
        <div class="rightNav">
            <a class="navLink" href="join_form.php">Join!</a>
        </div>
    </div>

    <!-- Create Main Header for initial landing page -->
    <div class="homeHeader">
        <h1>Welcome to JJAMiT's Infrastructure As Code!</h1>
    </div>

    <!--  Create wrapper for content  -->
    <div class="wrapperDiv">
        <!--  Create wrapper header and text content  -->
        <h2 class="videoDivHeader">A site dedicated to deployment of resources for your infrastructure needs</h2>

        <p class="siteDescription">In this site you will be guided through a process that will deploy your infrastructure needs through a cloud-based structure. Your settings will be stored so you can access them later to either reconfigure or use as a reference for a different deployment. Please join the site to gain access. Otherwise, please enjoy the video below that provides information on what Infrastructure as Code is exactly.</p>

        <div class="iacVidWrapper">
            <!--  Embed YouTube Video  -->
            <div class="homeVideo">
                <iframe class="whatisIacVid" src="https://www.youtube.com/embed/KxxRl6VEBxI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</body>

</html>
