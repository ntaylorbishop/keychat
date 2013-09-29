/* This sript is for inserting sample users */
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

insert into Users (userName, email, password, isBlocked, isAdmin, loginAttempts) 
	values
	("ckvamme", "cpkvamme@gmail.com", "123", false, true, 0),
	("thargett", "tyler.t.hargett@gmail.com", "123", false, true, 0),
	("cowens", "jcalvinowens@gmail.com", "123", false, true, 0),
	("kfallatah", "g1232216@gamil.com", "123", false, false, 0),
	("hhouston", "hmhouston7@gmail.com", "123", false, false, 0),
	("tbishop", "ntaylorbishop@gmail.com", "123", false, false, 0)
	;