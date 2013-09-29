#Keychat

create database Keychat;
use Keychat

/*
	Table: Users
	Info:
	userName - name of user 
	email - valid email used to confirm user
	password - used to login to KeyChat
	isBlocked - determains of this userID has be blocked due to a corrupted account or deleted account
	DELETED -- isOnline - users can only recieve messages when they are online -- DELEDTED THIS
*/
create table Users  
	(
	userName varchar(256), email varchar(256), 
	password varchar(256), isBlocked bool,  
	isAdmin bool, 
	primary key (userName)
	);

/*
	Table: Conversations
	Info:
	userOne - name of first user part of conversation
	userTwo - second user part of conversation
	convoID - used to locate specific convresation
*/
create table Conversations  
	(
	convoID int, userOne varchar(256), userTwo varchar(256),
	primary key(convoID)
	);

/*
	Table: Messages
	Info:
	messagesID - unique id of message
	convoID - id of conversation the message is in
	userSent - name of user who sent the message
	userRecieved - name of user who recieved the message
	message - text of actual message
	messageDateTime - time and date the message was sent
*/
create table Messages  
	(
	messageID int, convoID int, userSent varchar(256), 
	userRecieved varchar(256), message text, messageDateTime date,
	primary key(messageID)
	);

/* need to add this -  grant all privileges on HW1.* to phpuser@'localhost' with grant option; */