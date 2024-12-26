<!DOCTYPE html>
<?php


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .left {
            left: 0px;
            border: 2px solid black;
            width: 30%;

        }
    </style>
</head>

<body>

    <div class="mt-2 container shadow" style="height:600px; width:500px; background-color:white; border-radius:10px;">
        <!-- <div class="left" style="margin-top: 20px;">
            this is a left
        </div>   -->
    </div>

    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"
        integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+"
        crossorigin="anonymous"></script>
    <script>
        const socket = io("http://localhost:3000");

        socket.emit('userConnected', "rohit")
    </script>
</body>


</html>