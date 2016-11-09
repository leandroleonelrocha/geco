var http = require('http://conve.local/angular');

http.createServer(function(res,req)
{
	res.writeHead(200,{"content-type":"text/html"});
	res.write("hola mundo");
	res.end();

}).listen(3000);

console.log('Corriendo en el puerto 3000');