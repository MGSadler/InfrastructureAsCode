show databases;

create user "ec2-user"@"localhost" identified by "matt";

grant select, insert, update on *.* to "ec2-user"@"localhost";

CREATE DATABASE UserData;

SHOW databases;
use UserData;

show tables;

create table users (
id int primary key auto_increment,
username varchar(255) not null unique,
userPassword text not null,
addDate datetime,
modifyDate datetime
);

insert into users (username, userPassword, addDate, modifyDate) values ('test', 'pass', now(), now());

select * from users;

SELECT id FROM users WHERE username = 'test' AND userPassword = 'pass';

show tables;

update users set userPassword = sha1(userPassword) , modifyDate = now() where id = 1;

select * from users;

desc users;

alter table users add firstName text default null after id;
alter table users add lastName text default null after firstName;
alter table users add email text default null after userPassword;
alter table users add birthday date default null after email;

desc users;

delete from users where id > 4;

INSERT INTO users (firstName, lastName, username, userPassword, email, birthday) VALUES ('Matt', 'Sadler', 'matt1', sha1('mattpass'), 'matt@matt.com', '2020-05-06');

INSERT INTO users (firstName, lastName, username, userPassword, email, birthday) VALUES ('Matt', 'Sadler', 'matt1', sha1('mattpass'), 'matt@matt.com', STR_TO_DATE('2020-05-06', '%Y-%m-%d'));


INSERT INTO aws (ami, instanceType, count, securityGroup, region, keyPair, state) VALUES ('ami-03d64741867e7bb94', 't4gmicro', '4', 'sg-0fe281761a436b242', 'us-east-2', 'JJAMiTTest1', 'start');

create table configurations (
id int primary key auto_increment,
userID int not null,
constraint fk_configurationsUserID foreign key (userID) references users(id),
ami varchar(30),
instanceType varchar(20),
count int,
securityGroup varchar(50),
region varchar(30),
keyPair varchar(50),
state varchar(20)
);

DROP table testTable;

create table configurations (
id int primary key auto_increment,
ami varchar(30),
instanceType varchar(20),
count int,
securityGroup varchar(50),
region varchar(30),
keyPair varchar(50),
state varchar(20)
);

drop table configurations;

select * from configurations;

create table aws (
id int primary key auto_increment,
userID int not null,
constraint fk_awsUserID foreign key (userID) references users(id),
ami varchar(30),
instanceType varchar(20),
count int,
securityGroup varchar(50),
region varchar(30),
keyPair varchar(50),
state varchar(20)
);

desc aws;

desc aws;

select * from aws;

create table aws (
id int primary key auto_increment,
userID int not null,
constraint fk_awsUserID foreign key (userID) references users(id),
ami varchar(30),
instanceType varchar(20),
count int,
securityGroup varchar(50),
region varchar(30),
keyPair varchar(50),
state varchar(20)
);

desc aws;

select * from testaws;

create table azure (
id int primary key auto_increment,
userID int not null,
constraint fk_azureUserID foreign key (userID) references users(id),
instanceName varchar(55),
resourceGroup varchar(50),
system varchar(30)
);

desc azure;

select * from testazure;