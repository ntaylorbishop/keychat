var chatbutton = document.getElementById("send-message-button");
chatbutton.onclick = function() {
	message_ops.send_message("nobody", chatbutton.form.text.value);
};

var convobutton = document.getElementById("convo-button");
convobutton.onclick = function() {
	conversation_ops.start_conversation(convobutton.form['their-username'].value);
};
