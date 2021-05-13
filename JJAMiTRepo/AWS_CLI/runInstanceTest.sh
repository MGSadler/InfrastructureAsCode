#!/bin/bash
#runInstance.sh Allows users to deploy an AWS instance instantly 



ami=( $(cut -d':' -f1 /var/www/html/data.txt) )
cpu=( $(cut -d':' -f2 /var/www/html/data.txt) )
count=( $(cut -d':' -f3 /var/www/html/data.txt) )
security=( $(cut -d':' -f4 /var/www/html/data.txt) )
region=( $(cut -d':' -f5 /var/www/html/data.txt) )
key=( $(cut -d':' -f6 /var/www/html/data.txt) )

#Created the key pair in AWS and put the Private Key into $key.pem to be downloaded
aws ec2 create-key-pair --key-name $key --query "KeyMaterial" --output text > $key.pem

#Deployed the instance and sent the information to awsInstanceInfo.txt
aws ec2 run-instances \
--image-id $ami \
--instance-type $cpu \
--count $count \
--security-group-ids $security \
--region $region \
--key-name $key > awsInstanceInfo.txt

#Gathered information from instance and found instance ID column
aws ec2 describe-instances | grep [i-] | awk '{print $9}' awsInstanceInfo.txt > awkTest.txt

#Got only the instance ID 
grep i- awkTest.txt > instanceID.txt

ID=( $(cut -d':' -f1 instanceID.txt) )

#Used variable ID to obtain the ip address the user deployed
aws ec2 describe-instances --instance-ids $ID --query 'Reservations[*].Instances[*].PublicIpAddress' --output text > awsIPaddress.txt





#	---- code that was not implemented but is useful for next steps ----

#aws ec2 create-key-pair --key-name MyKeyPair

#aws ec2 descibe-vpcs

#aws ec2 create-security-group --group-name MySecurityGroup --description "My security group" --vpc-id vpc-82b71bff

#(ssh)
#aws ec2 authorize-security-group-ingress \\
#    --group-name MySecurityGroup \
#    --protocol tcp \
#    --port 22 \
#    --cidr 203.0.113.0/24

#aws ec2 stop-instances --instance-ids i-1234567890abcdef0

#aws ec2 terminate-instances --instance-ids i-1234567890abcdef0

#aws ec2 create-volume \
#    --volume-type gp2 \
#    --size 80 \
#    --availability-zone us-east-1a

#aws ec2 attach-volume --volume-id vol-1234567890abcdef0 --instance-id i-01474ef662b89480 --device /dev/sdf

#aws ec2 delete-volume --volume-id vol-049df61146c4d7901

#aws ec2 create-snapshot --volume-id vol-1234567890abcdef0 --description "This is my root volume snapshot"

#aws ec2 delete-snapshot --snapshot-id snap-1234567890abcdef0

