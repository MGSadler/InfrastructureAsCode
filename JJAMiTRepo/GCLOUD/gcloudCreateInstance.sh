#!/bin/bash

name=( $(cut -d':' -f1 /var/www/html/data.txt) )
family=( $(cut -d':' -f2 /var/www/html/data.txt) )
project=( $(cut -d':' -f3 /var/www/html/data.txt) )

#Creates VM and allows oslogin
./google-cloud-sdk/bin/gcloud compute instances create $name \
--image-family=$family \
--image-project=$project \
--metadata enable-oslogin=TRUE

#The command below was trying to add oslogin to an instance
#./google-cloud-sdk/bin/gcloud compute instances add-metadata $name \
#--metadata enable-oslogin=TRUE



#---- Extra refernce information ----
#zone=us-central1-a
#image-family=rhel-7
#machine-type=rhel-7-v20200403
#NameProjectFamily=rhel-7-v20210420 rhel-cloud rhel-7

#centos-7-v20210420                                    centos-cloud         centos-7





