#Keychat

DROP DATABASE IF EXISTS keychat;

CREATE DATABASE keychat;
USE keychat;

/*
	Table: Users
	Info:
	id - auto incremented 
	username - name of user 
	email - valid email used to confirm user
	password - used to login to KeyChat
	isBlocked - determains if this userID has been blocked due to a corrupted account or deleted account
	isadmin - duh
*/
CREATE TABLE users  
	(
	id 			INT UNSIGNED			NOT NULL AUTO_INCREMENT,
	username 		VARCHAR(256)			NOT NULL,
	password 		VARCHAR(256)			NOT NULL,
	isblocked bool 	DEFAULT FALSE				NOT NULL,
	isadmin bool 	DEFAULT FALSE				NOT NULL,
	isonline bool	DEFAULT FALSE				NOT NULL,
	PRIMARY KEY 	(id)
	);

/*
	Table: Conversations
	Info:
	userone - id of first user part of conversation
	usertwo - second user part of conversation
	convoID - used to locate specific convresation
	conversation_rec - check whether or not conversation has been loaded in the front end
*/
CREATE TABLE conversations  
	(
	id 		INT UNSIGNED				NOT NULL AUTO_INCREMENT, 
	userone 	INT UNSIGNED				NOT NULL, 
	usertwo 	INT UNSIGNED				NOT NULL, 
	conversation_rec bool DEFAULT FALSE 			NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(userone) REFERENCES users(id),
	FOREIGN KEY(usertwo) REFERENCES users(id)

	);

/*
	Table: Messages
	Info:
	id - unique id of message
	convo_id - id of conversation the message is in
	fromuser - name of user who sent the message
	message - text of actual message
	messageDateTime - time and date the message was sent
*/
CREATE TABLE messages  
	(
	id 			INT  UNSIGNED				NOT NULL AUTO_INCREMENT, 
	convo_id 		INT  UNSIGNED				NOT NULL, 
	message 	text						NOT NULL, 
	messageDateTime date 						NOT NULL,
	fromuser		INT UNSIGNED				NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(convo_id) REFERENCES conversations(id)
	);

CREATE TABLE blockusers  
	(
	blocker 	INT UNSIGNED				NOT NULL,
	blockee 	INT UNSIGNED 				NOT NULL,
	FOREIGN KEY (blocker) REFERENCES users(id),
	FOREIGN KEY (blockee) REFERENCES users(id)

	);
