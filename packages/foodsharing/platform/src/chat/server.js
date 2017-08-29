var http = require('http');
var cookie = require('cookie');
var input_port = 1338;
var client_port = 1337;
var connected_clients = {};
var listenHost = process.argv[2] || '127.0.0.1';
var num_registrations = 0;
var num_connections = 0;

sendtoclient = function(client,a,m,o){
	if(connected_clients[client]) {
		for(var i=0; i<connected_clients[client].length; i++) {
			connected_clients[client][i].emit(a, {"m":m,"o":o});
		}
		return true;
	} else {
		return false;
	}
}

var app = http.createServer(function  (req, res) {
	if(req.url == "/stats") {
		res.writeHead(200);
		res.end(JSON.stringify({
			connections: num_connections,
			registrations: num_registrations,
			sessions: Object.keys(connected_clients).length
		}));
		return;
	}
	var client,app,options,method;
	var query = require('url').parse(req.url,true).query;

	client = 	query.c;
	app = 		query.a;
	method = 	query.m;
	options = 	query.o;
	
	if(client) {
		sendtoclient(client,app,method,options);
	}
	res.writeHead(200);
	res.end("\n");
});
app.listen(input_port, listenHost);
console.log("http server started on", listenHost + ':' + input_port);

var app2 = http.createServer(function  (req, res) {
	res.writeHead(200);
	res.end("\n");
});
var io = require('socket.io')(app2);
io.use(function(socket, next){
	var cookieVal = socket.request.headers.cookie;
	if(cookieVal) {
		socket.sid = cookie.parse(cookieVal).PHPSESSID;
		if (socket.sid) next();
	}
	next(new Error('not authorized'));
});

app2.listen(client_port, listenHost);
console.log("socket.io started on port", listenHost + ':' + client_port);

io.on('connection', function (socket) {
	var sid = socket.sid;
	num_connections++;
	socket.on('register', function () {
		num_registrations++;
		if(!connected_clients[sid]) connected_clients[sid] = [];
		connected_clients[sid].push(socket);
	});

	socket.on('disconnect',function(){
		num_connections--;
		var connections = connected_clients[sid];
		if(sid && connections) {
			var i = connections.indexOf(socket);
			if(i !== -1) {
				connections.splice(i, 1);
				num_registrations--;
			}
			if (connections.length === 0) {
				delete connected_clients[sid];
			}
		}
	});
});
