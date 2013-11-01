/* api.js: API for keychat protocol
 *
 * Functions should never be invoked directly; they should be called through
 * these operations objects. That way when we start actually implementing
 * most of this functionality, we don't have to change the code much.
 *
 * Written by Calvin Owens
 */

/* Le global variables */
var encryption_ops = {};
var key_ops = {};
var conversation_ops = {};
var message_ops = {};
var interface_ops = {};
var conversations = {};
var public_keys = {};
var private_key = 0;

/* Oh yes, I am that lazy */
function log(str)
{
	console.log(str);
	return null;
}

/* POST request - can omit callback if you don't care
 * Data keys must be alphanumeric ONLY! */
function post_to_server(file, data, callback)
{
	var p = "";
	var x = new XMLHttpRequest();

	for (var i in data)
		p += (i + "=" + encodeURIComponent(data[i]) + "&");
	p = p.slice(0, -1);

	if (callback !== undefined)
		x.onreadystatechange = callback;

	x.open("POST", file, true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.send(p);
}

/* GET request - callback is required */
function get_from_server(file, data, callback)
{
	var x = new XMLHttpRequest();
	var g

	if (data !== null) {
		g = file + "?";
		for (var i in data)
			p += (i + "=" + encodeURIComponent(data[i]) + "&");
		p = p.slice(0, -1);
	} else {
		g = file;
	}

	x.onreadystatechange = callback;
	x.open("GET", g, true);
	x.send();
}

/* Watch for messages 
 * There is only one loop serving all conversations */
function long_poll_for_messages(their_username)
{
	get_from_server("/php/message.php", null, message_ops.receive_message);
}

function receive_message()
{

	if (this.readyState === 4) {
		if (this.status !== 200)
			return message_ops.long_poll_for_messages();

		var r = JSON.parse(this.responseText);
		c = conversations[r['their-username']];
		if (c === undefined)
			return log("CONVERSATION DOES NOT EXIST. WAT.");

		plaintext = encryption_ops.decrypt(byteify_printables(r.text), c["session_key"]);

		interface_ops.got_message(plaintext);

		/* Poll more */
		message_ops.long_poll_for_messages();
	}
}

function send_message(their_username, message_text)
{
	c = conversations[their_username];
	if (c === undefined)
		return log("CONVERSATION DOES NOT EXIST. WAT.");

	ciphertext = printableify_bytes(encryption_ops.encrypt(message_text, c["session_key"]));

	data = {
		"convo_id": c["id"],
		"text": ciphertext
	};

	post_to_server("/php/message.php", data);
	interface_ops.sent_message(message_text);
}

/* For now, these don't need to do anything
 * Eventually, they'll base64 encode stuff */
function printableify_bytes(bytes)
{
	return bytes;
}

function byteify_printables(text)
{
	return text;
}

function verify_conversation_started()
{
	if (this.readyState === 4) {
		var r = JSON.parse(this.responseText);
		if (r.id) {
			conversations[r['their-username']] = {"id": r.id,
				"session_key": "fontenotraley"};
			document.getElementById("their-username").value = r['their-username'];
			interface_ops.init_conversation();
		} else {
			console.log("ERROR in starting conversation");
		}
	}
}

function start_conversation(their_username)
{
	data = {
		"their_username": their_username
	};
	post_to_server("php/conversation.php", data, verify_conversation_started);
}

function long_poll_for_conversations()
{
	get_from_server("php/conversation.php", null, conversation_ops.receive_conversation);
}

function receive_conversation()
{
	if (this.readyState === 4) {
		log(this.responseText);
		var r = JSON.parse(this.responseText);
		conversations[r['their-username']] = {"id": r.id,
			"session_key": "fontenotraley"};
		document.getElementById("their-username").value = r['their-username'];
		interface_ops.init_conversation();
	}
}

var encryption_ops = {
	"expand_key": vigenere_expand_key,
	"encrypt": vigenere_encrypt_string,
	"decrypt": vigenere_decrypt_string,
	"printableify_bytes": printableify_bytes,
	"byteify_printables": byteify_printables,
	"generate_hmac": null,
	"verify_hmac": null,
	"make_signature": null,
	"verify_signature": null,
	"get_randomness": Math.random(), /* XXX: This is not good enough */
	"key_exchange": {
		"compute_private_value": null,
		"compute_public_point": null,
		"send_my_public_point": null,
		"get_their_public_point": null,
		"compute_secret": null
	},
	"hash_func": hex_sha1 /* XXX: Needs to handle non-printables */
};

var key_ops = {
	"get_my_private_key": null,
	"decrypt_private_key": null,
	"verify_private_key": null,
	"get_user_public_key": null,
	"sign_user_public_key": null,
	"submit_new_userkey_signature": null,
	"verify_userkey_signature": null
};

var conversation_ops = {
	"start_conversation": start_conversation,
	"receive_conversation": receive_conversation,
	"long_poll_for_conversations": long_poll_for_conversations
};

var message_ops = {
	"send_message": send_message,
	"receive_message": receive_message,
	"long_poll_for_messages": long_poll_for_messages,
};
