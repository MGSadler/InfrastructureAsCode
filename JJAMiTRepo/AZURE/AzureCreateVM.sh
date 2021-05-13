#!/bin/bash

name=( $(cut -d':' -f1 /var/www/html/data.txt) )
image=( $(cut -d':' -f3 /var/www/html/data.txt) )

#Creates instance along with creating a key pair
az vm create \
--name $name \
--resource-group JJAMiT \
--generate-ssh-keys \
--image $image > instanceInfoAZ.txt 

#Finds IP address of instance and puts it in AzureIpAddress.txt
az vm show -d --name $name \
--resource-group JJAMiT \
--query publicIps > /var/www/html/AZURE/AzureIpAddress.txt

#Copies private key from id_rsa and places it in AzurePrivateKey.pem
awk '{print}' /home/ec2-user/.ssh/id_rsa > AzurePrivateKey.pem
