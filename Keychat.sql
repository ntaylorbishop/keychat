#Keychat

create database Keychat;
use Keychat

create table Users (userName varchar(256), email varchar(256), password varchar(256), isBlocked bool, isOnline bool, isAdmin bool, loginAttempts int);
create table Conversations (userOne varchar(256), userTwo varchar(256), convoID int, convoFile varchar(256));
create table Messages (messageID int, convoID int, userOne varchar(256), userTwo varchar(256), message text);