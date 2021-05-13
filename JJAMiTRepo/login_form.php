<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JJAMiT-IaC | Login</title>

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
        });

    </script>

</head>

<body>
    <!-- Create the navbar and links -->
    <div class="navContainer">
        <div class="leftNav">
            <a class="navLink" href="index.php">Back</a>
        </div>
        <div class="rightNav">
            <a class="navLink" href="join_form.php">Join!</a>
        </div>
    </div>

    <div class="spacer"></div>


    <div class="loginWrapperDiv">
        
        <div id="loginWidget" class="ui-widget">
            <h1>Login</h1>

            
            <?php
                if($error) {
                    print "<div class=\"ui-state-error\">$error</div>\n";
                }
            ?>

            <form action="login.php" method="post">

                <input type="hidden" name="action" value="do_login">

                <div class="stack">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all" autofocus value="<?php print $username; ?>">
                </div>

                <div class="stack">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all">
                </div>

                <div class="stack">
                    <input type="submit" value="Submit">
                </div>

            </form>
            
        </div>
    </div>

</body>

</html>
