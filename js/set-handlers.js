var button = document.getElementById("send-message-button");
button.onclick = function() {
	message_ops.send_message(null, button.form.text.value);
};
