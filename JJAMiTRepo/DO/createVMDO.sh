#!/bin/bash

keyName=( $(cut -d':' -f1 /var/www/html/data.txt) )
image=( $(cut -d':' -f2 /var/www/html/data.txt) )
size=( $(cut -d':' -f3 /var/www/html/data.txt) )
region=( $(cut -d':' -f4 /var/www/html/data.txt) )
name=( $(cut -d':' -f5 /var/www/html/data.txt) )

#Creates key pair without asking for a passphrase
ssh-keygen -b 2048 -t rsa -f /var/www/html/DO/$keyName -q -N ""

publicKey=$(sed "" $keyName.pub) 

#Supposed to import public key, but does not like variable being there
curl -X POST -H "Content-Type:application/json" -H "Authorization: Bearer abfc8a063058686f9302846a463651b64377cbefeaab43cbb6f438ae0a543753" -d "{'name':'Test','public_key':'$publicKey'}" "https://api.digitalocean.com/v2/account/keys" > postKey.txt

#Gets key pair ID
awk '{print $1}' postKey.txt | cut -d ":" -f3 postKey.txt > postPart2.txt

id=( $(cut -d "," -f1 postPart2.txt) )

#Creates instance and uses key pair from key pair ID
doctl compute droplet create \
--image $image \
--size $size \
--region $region \
--ssh-keys $id \
$name
 

#---- testing commands ----

#publicKey=( $(awk -F" " '{print $1, $2, $3}' $keyName.pub) )

#publicKey=$ sed "" test2.txt.pub

#curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer b7d03a6947b217efb6f3ec3bd3504582" -d '{"name":"My SSH Public Key","public_key":"ssh-rsa AEXAMPLEaC1yc2EAAAADAQABAAAAQQDDHr/jh2Jy4yALcK4JyWbVkPRaWmhck3IgCoeOO3z1e2dBowLh64QAM+Qb72pxekALga2oi4GvT+TlWNhzPH4V example"}' "https://api.digitalocean.com/v2/account/keys"


