var sock = {
	connect: function()
	{
		var socket = io.connect(location.host, {path: '/chat/socket.io'});
		socket.on("connect",function() {	
			console.log("connected");
			socket.emit("register", session_id());
		});
		
		socket.on('conv', function(data) {
			switch(data.m)
			{
				case 'push':
					if(GET('page') == 'msg')
					{
						msg.push(JSON.parse(data.o));
					}
					else
					{
						conv.push(JSON.parse(data.o));
					}
					break;
			}
		});
		
		socket.on('info', function(data) {
			switch(data.m)
			{
				case 'badge':
					info.badge('info',data.o.count);
					break;
			}
		});
	}
};
