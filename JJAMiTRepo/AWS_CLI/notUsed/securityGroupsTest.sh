#!/bin/bash
#securityGroup.sh Allows users to create a security group
column1=( $(cut -d':' -f1 sgName.txt) )
column2=( $(cut -d':' -f2 sgName.txt) )
aws ec2 create-security-group --group-name $column1 --description "$column2" > $column1.txt
