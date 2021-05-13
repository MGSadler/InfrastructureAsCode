#!/bin/bash
#addRules.sh allows users to add any ports they want open
column1=( $(cut -d':' -f1 addRuleName.txt) )
name=( $(cut -d':' -f1 $column1.txt) )
aws ec2 authorize-security-group-egress --group-id $name --ip-permissions IpProtocol=tcp,FromPort=80,ToPort=80,UserIdGroupPairs=[{GroupId=$name}]
