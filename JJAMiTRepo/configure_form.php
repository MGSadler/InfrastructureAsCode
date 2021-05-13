<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Configure Settings</title>

    <!-- Google font link -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- External CSS Link -->
    <link rel="stylesheet" href="styles.css">
    
    <!-- jQuery Link -->
    <link rel="stylesheet" type="text/css" href="./jquery-ui-1.11.4.custom/jquery-ui.min.css">
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

</head>

<body>
    
    <!-- Create the navbar and links -->
    <div class="navContainer">
        <ul id="navbar">
            <li class="nav" id="active"><a class="navLinks" href="configure_form.php">Configure</a></li>
            <li class="nav"><a class="navLinks" href="history.php">History</a></li>
            <li class="nav"><a class="navLinks" href="paid_form.php">Paid</a></li>
            <li class="nav"><a class="navLinks" href="logout.php">Logout</a></li>
        </ul>
    </div>


    <div class="spacer"></div>

    <div class="loginWrapperDiv">
        
        <div id="loginWidget" class="ui-widget">
            <h1>Select Settings</h1>
            
            <?php
                if($error) {
                    print "<div class=\"ui-state-error\">$error</div>\n";
                }
            ?>


            <form name="configureForm" action="configure.php" method="POST">

                <input type="hidden" name="action" value="do_configure">
                
                <div class="stack">
                    <label for="platform">Cloud Hosting Platform:</label>
                    <select id="platform" name="platform" class="ui-widget-content ui-corner-all" autofocus required>
                    <option value="aws">Amazon AWS</option>
                    <option value="azure">Microsoft Azure</option>
                    </select>
                </div>
                
                <div class="stack" id="amiDiv">
                    <label for="ami">Choose Your AMI:</label>
                    <select id="ami" name="ami" class="ui-widget-content ui-corner-all" required>
                        <option value="ami-0533f2ba8a1995cf9">Linux</option>
                        <option value="ami-03d64741867e7bb94">RHEL</option>
                        <option value="ami-08962a4068733a2b6">Ubuntu</option>
                        <option value="ami-0ef98d91ff9126a43">Mac</option>
                        <option value="ami-0b697c4ae566cad55">Windows</option>
                        <option value="ami-0f052119b3c7e61d1">SUSE</option>
                    </select>
                </div>

                <div class="stack" id="instanceTypeDiv">
                    <label for="instanceType">Select Type:</label>
                    <select id="instanceType" name="instanceType" class="ui-widget-content ui-corner-all" required>
                        <option value="t2.micro">t2.micro</option>
                        <option value="t4gmicro">t4g.micro</option>
                        
                    </select>
                </div>
                
                <div class="stack" id="countDiv">
                    <label for="count">Number of Instances:</label>
                    <input type="number" min="1" id="count" name="count" class="ui-widget-content ui-corner-all" required>
                </div>
                
                <div class="stack" id="securityGroupDiv">
                    <label for="securityGroup">Set Security Group:</label><br>
                    <select id="securityGroup" name="securityGroup" class="ui-widget-content ui-corner-all" required>
                        <option value="sg-0fe281761a436b242">SSH, HTTP, HTTPS</option>
                    </select>                         
                                               
                </div>
                
                <div class="stack" id="regionDiv">
                    <label for="region">Choose Region:</label>
                    <select id="region" name="region" class="ui-widget-content ui-corner-all" required>
                        <option value="us-east-1">US East 1 (Virginia)</option>
                        <option value="us-east-2">US East 2 (Ohio)</option>
                        <option value="us-west-1">US West 1 (N. California)</option>
                        <option value="us-west-2">US West 2 (Oregon)</option>
                    </select>
                </div>
                
                <div class="stack" id="keyPairDiv">
                    <label for="keyPair">Enter Key-Pair Filename:</label>

                    <input type="text" id="keyPair" name="keyPair" class="ui-widget-content ui-corner-all" placeholder="Enter Key Name" required>
                </div>
                
                <div class="stack" id="stateDiv">
                    <label for="state">Choose State:</label>
                    <select id="state" name="state" class="ui-widget-content ui-corner-all" required>
                        <option value="start">Start</option>
                        <option value="stop">Stop</option>
                        <option value="terminate">Terminate</option>
                    </select>
                </div>

                
                <!--
                Start Azure Config 
                -->
                <div class="stack" id="nameDiv">
                    <label for="name">Instance Name:</label>
                    <input type="text" id="instanceName" value="Requires A Name" name="instanceName" class="ui-widget-content ui-corner-all" placeholder="Enter name here" required>
                </div>
                
                <div class="stack" id="resourceGroupDiv">
                    <label for="resourceGroup">Resource Group:</label>
                    <select id="resourceGroup" name="resourceGroup" class="ui-widget-content ui-corner-all" required>
                        <option value="JJAMiT">Default</option>
                    </select>
                </div>
                
                <div class="stack" id="systemDiv">
                    <label for="system">Select System:</label>
                    <select id="system" name="system" class="ui-widget-content ui-corner-all" required>
                        <option value="RHEL">RHEL</option>
                        <option value="Ubuntu LTS">Ubuntu LTS</option>
                        <option value="Centos8">CentOS8</option>
                    </select>
                </div>
                <br>
                <div class="stack">
                    <input type="submit" value="Submit" name="submit">
                </div>
            </form>
            
            <br>
            <div id="outputDiv">
                
                <div id="awsDownloadDiv">
                    <a id="aws1" href="download.php?file=awsIPaddress.txt&id=aws1">Download AWS IP Address</a> 
                    
                    <?php 
                    
                    $key_name = $_REQUEST['keyPair'];
                    
                    echo "<a id=aws2 href=download.php?file=" . $key_name .".txt" . "&id=aws1" . ">Download AWS Private Key " . $key_name . "</a>" 
                    ?>
                </div>
                <div id="azureDownloadDiv">
                    <a id="azure1" href="download.php?file=AzureIpAddress.txt&id=azure1">Download Azure IP Address</a>
                    
                    <a href="download.php?file=AzurePrivateKey.pem&id=azure1">Download Azure Private Key</a>
                    
                </div>                          
            </div>
            
            
            
            
        </div>
    </div> 
<script src="hide_form.js"></script>
</body>

</html>
