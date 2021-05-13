#!/bin/bash
#keyPairs.sh Allows users to create a key pair
column1=( $(cut -d':' -f1 keypair.txt) ) 
aws ec2 create-key-pair --key-name $column1 --query 'KeyMaterial' --output text > $column1.pem

#aws ec2 import-key-pair --key-name "$column1" --public-key-material file://~/aws/column1.pem
