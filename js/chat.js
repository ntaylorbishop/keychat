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
	p.innerHTML = "You: " + text;
	d.appendChild(p);
}

function send_message(text)
{
	var u = encodeURIComponent(text);
	var x = new XMLHttpRequest();
	x.open("POST","message.php",true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.send("convo_id=" + convo_id + "&text=" + u);
	show_message_in_window(text);
}
