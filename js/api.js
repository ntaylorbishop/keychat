/* api.js: API for keychat protocol
 *
 * Functions should never be invoked directly; they should be called through
 * these operations objects.
 *
 * Written by Calvin Owens
 */

var conversations = {};
var public_keys = {};
var private_key = 0;

var encryption_ops = {
	"expand_key": null,
	"encrypt": null,
	"decrypt": null,
	"generate_hmac": null,
	"verify_hmac": null,
	"make_signature": null,
	"verify_signature": null,
	"get_randomness": null,
	"key_exchange": {
		"compute_private_value": null,
		"compute_public_point": null,
		"send_my_public_point": null,
		"get_their_public_point": null,
		"compute_secret": null
	},
	"hash_func": null
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
	"start_conversation": null,
	"receive_conversation": null,
	"long_poll_for_conversations": null
};

var message_ops = {
	"send_message": null,
	"launder_received_message": null,
	"long_poll_for_messages": null,
};
