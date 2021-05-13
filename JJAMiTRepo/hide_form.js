var script = document.createElement('script');
script.src = "jquery-ui-1.11.4.custom/external/jquery/jquery.js";
script.type = "text/javascript";
document.getElementsByTagName('head')[0].appendChild(script);

$("#platform").change(function() {
    if ($(this).val() == "aws") {
        
        //---------------------Show AWS----------------------------
        
        //Show ami div
        $('#amiDiv').show();
        $('#ami').attr('required', '');
        $('#ami').attr('data-error', 'This field is required.');
        
        //Show instance type div
        $('#instanceTypeDiv').show();
        $('#instanceType').attr('required', '');
        $('#instanceType').attr('data-error', 'This field is required.');
        
        //Show count div
        $('#countDiv').show();
        $('#count').attr('required', '');
        $('#count').attr('data-error', 'This field is required.');
        
        //Show security group div
        $('#securityGroupDiv').show();
        $('#securityGroup').attr('required', '');
        $('#securityGroup').attr('data-error', 'This field is required.');
        
        //Show region div
        $('#regionDiv').show();
        $('#region').attr('required', '');
        $('#region').attr('data-error', 'This field is required.');
        
        //Show keypair div
        $('#keyPairDiv').show();
        $('#keyPair').attr('required', '');
        $('#keyPair').attr('data-error', 'This field is required.');
        
        //Show state div
        $('#stateDiv').show();
        $('#state').attr('required', '');
        $('#state').attr('data-error', 'This field is required.');
        
        $('#awsDownloadDiv').show();
        
        //---------------------Hide Azure----------------------------
        
        //Hide name div
        $('#nameDiv').hide();
        $('#name').removeAttr('required');
        $('#name').removeAttr('data-error');
        
        //Hide resource group div
        $('#resourceGroupDiv').hide();
        $('#resourceGroup').removeAttr('required');
        $('#resourceGroup').removeAttr('data-error');
        
        //Hide system div
        $('#systemDiv').hide();
        $('#system').removeAttr('required');
        $('#system').removeAttr('data-error');
        
        //Hide download buttons
        $('#azureDownloadDiv').hide();
        
    } else {
        
        //---------------------Hide AWS----------------------------
        
        //Hide ami div
        $('#amiDiv').hide();
        $('#ami').removeAttr('required');
        $('#ami').removeAttr('data-error');
        
        //Hide instance type div
        $('#instanceTypeDiv').hide();
        $('#instanceType').removeAttr('required');
        $('#instanceType').removeAttr('data-error');
        
        //Hide count div
        $('#countDiv').hide();
        $('#count').removeAttr('required');
        $('#count').removeAttr('data-error');
        
        //Hide security group div
        $('#securityGroupDiv').hide();
        $('#securityGroup').removeAttr('required');
        $('#securityGroup').removeAttr('data-error');
        
        //Hide region div
        $('#regionDiv').hide();
        $('#region').removeAttr('required');
        $('#region').removeAttr('data-error');
        
        //Hide keypair div
        $('#keyPairDiv').hide();
        $('#keyPair').removeAttr('required');
        $('#keyPair').removeAttr('data-error');
        
        //Hide state div
        $('#stateDiv').hide();
        $('#state').removeAttr('required');
        $('#state').removeAttr('data-error');
        
        $('#awsDownloadDiv').hide();
        
    
        //---------------------Show Azure----------------------------
        
        //Show name div
        $('#nameDiv').show();
        $('#name').attr('required', '');
        $('#name').attr('data-error', 'This field is required.');
        
        //Show resource group div
        $('#resourceGroupDiv').show();
        $('#resourceGroup').attr('required', '');
        $('#resourceGroup').attr('data-error', 'This field is required.');
        
        //Show system div
        $('#systemDiv').show();
        $('#system').attr('required', '');
        $('#system').attr('data-error', 'This field is required.');
        
        $('#azureDownloadDiv').show();
    }
});
$("#platform").trigger('change');

