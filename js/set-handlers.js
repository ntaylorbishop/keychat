var chatbutton = document.getElementById("send-message-button");
chatbutton.onclick = function() {
	message_ops.send_message("nobody", chatbutton.form.text.value);
};

var convobutton = document.getElementById("convo-button");
convobutton.onclick = function() {
	message_ops.send_message("nobody", convobutton.form.text.value);
};

var loginbutton = document.getElementById("login-button");
loginbutton.onclick = function() {
	message_ops.send_message("nobody", loginbutton.form.text.value);
};
