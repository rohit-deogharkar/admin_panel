<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script>
        const socket = io('http://localhost:3000/');

        socket.emit('userConnected', "rohit")
    </script>
</body>


</html>