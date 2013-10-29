function show_sent_message_in_window(text)
{
	var d = document.getElementById("messagelog");
	var p = document.createElement("p");
	p.className = "sent-message";
	p.innerHTML = "You: " + text;
	d.appendChild(p);
}

function show_got_message_in_window(text)
{
	var d = document.getElementById("messagelog");
	var p = document.createElement("p");
	p.className = "got-message";
	p.innerHTML = "Them: " + text;
	d.appendChild(p);
}

/* Interface between UI javascript and encryption backend javascript */
var interface_ops = {
	"got_message": show_got_message_in_window,
	"sent_message": show_sent_message_in_window,
	"init_conversation": null,
	"end_conversation": null
};
