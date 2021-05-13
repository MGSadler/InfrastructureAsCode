<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JJAMiT-IaC | Join</title>

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
        <div class="leftNav">
            <a class="navLink" href="index.php">Back</a>
        </div>
        <div class="rightNav">
            <a class="navLink" href="login.php">Login</a>
        </div>
    </div>

    <div class="spacer"></div>


    <div class="loginWrapperDiv">
        
        <div id="loginWidget" class="ui-widget">
            <h1>Create Account</h1>

            
            <?php
                if($error) {
                    print "<div class=\"ui-state-error\">$error</div>\n";
                }
            ?>

            <form name="joinForm" action="join.php" method="post">

                <input type="hidden" name="action" value="do_create">

                <div class="stack">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" class="ui-widget-content ui-corner-all" autofocus required>
                </div>

                <div class="stack">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="username">User Name:</label>
                    <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="confirmPass">Confirm Password:</label>
                    <input type="password" id="confirmPass" name="confirmPass" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday" min="1921-05-11" max="2005-05-11" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="ui-widget-content ui-corner-all" required>
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
