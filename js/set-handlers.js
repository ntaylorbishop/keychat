var button = document.getElementById("send-message-button");
button.onclick = function() {
	message_ops.send_message("nobody", button.form.text.value);
};

/* Dummy data for now */
conversations["nobody"] = {
	"session_key": "fontenotraley",
	"id": 1337
};
