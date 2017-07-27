<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p id="power">0</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
	
	<script>
		var socket = io('http://192.168.10.16:3000');
		socket.on("test-channel:App\\Events\\NotificationTriggerEvent", function(message){
		    // increase the power everytime we load test route
		    $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
		});
	</script>
	
</body>
</html>

