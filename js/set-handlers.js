var button = document.getElementById("send-message-button");
button.onclick = function() {
	send_message(button.form.text.value);
};
