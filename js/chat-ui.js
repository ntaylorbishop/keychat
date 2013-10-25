var convo_id = 0;

function get_message()
{
	
}

function poll_server_loop()
{

}

function show_message_in_window(text)
{
	var d = document.getElementById("messagelog");
	var p = document.createElement("p");
	p.className = "sent-message";
	p.innerHTML = "You: " + text;
	d.appendChild(p);
}


/* Interface between UI javascript and encryption backend javascript */
var interface_ops = {
	"got_message": null,
	"sent_message": show_message_in_window,
	"init_conversation": null,
	"end_conversation": null
};
