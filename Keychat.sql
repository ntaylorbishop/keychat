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
*/
create table Users  
	(
	userName varchar(256), 
	password varchar(256), 
	isBlocked bool DEFAULT FALSE,
	isAdmin bool DEFAULT FALSE,
	primary key (userName)
	);

/*
	Table: Conversations
	Info:
	userOne - name of first user part of conversation
	userTwo - second user part of conversation
	convoID - used to locate specific convresation
	numMessages - keeps track of how many messages in convo (used for max messages stored)
*/
create table Conversations  
	(
	convoID int, 
	userOne varchar(256), 
	userTwo varchar(256), 
	numMessages int,
	primary key(convoID)
	);

/*
	Table: Messages
	Info:
	messagesID - unique id of message
	convoID - id of conversation the message is in
	fromUser - name of user who sent the message
	message - text of actual message
	messageDateTime - time and date the message was sent
*/
create table Messages  
	(
	messageID int, 
	convoID int, /* maybe make this a foregin key? */
	fromUser varchar(256), 
	message text, 
	messageDateTime date,
	primary key(messageID)
	);

create table BlockUsers  
	(
	blocker varchar(256),
	blockee varchar(256),
	foreign key (blocker) references Users(userName),
	foreign key (blockee) references Users(userName)

	);

/* also - grant all privileges on HW1.* to phpuser@'localhost' with grant option; */