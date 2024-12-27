<!DOCTYPE html>
<?php


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

    </style>
</head>

<body>
    <div onclick="{sendRequest()}" class="button">This is a button</div>

    <div class="w-50 mt-4 container p-4 bg-white" style="height:700px; overflow-y: auto;">
        <div class="me-auto bg-success text-start px-3 p-2 text-white border rounded shadow"
            style="max-width:max-content ;inline-size: 300px; overflow-wrap: break-word;">
            Note The overflow-wrap property acts in the same way as the non-standard property word-wrap. The word-wrap
            property is now treated by browsers as an alias of the standard property.
        </div>
        <div class="ms-auto mt-5 bg-primary text-start ps-3 p-2 text-white border rounded shadow"
            style="max-width:max-content ;inline-size: 300px; overflow-wrap: break-word;">
            Note: The overflow-wrap property acts in the same way as the non-standard property word-wrap. The word-wrap
            property is now treated by browsers as an alias of the standard property.
        </div>
        <div class="me-auto bg-success text-start px-3 p-2 text-white border rounded shadow"
            style="max-width:max-content ;inline-size: 300px; overflow-wrap: break-word;">
            Note The overflow-wrap property acts in the same way as the non-standard property word-wrap. The word-wrap
            property is now treated by browsers as an alias of the standard property.
        </div>
        <div class="ms-auto mt-5 bg-primary text-start ps-3 p-2 text-white border rounded shadow"
            style="max-width:max-content ;inline-size: 300px; overflow-wrap: break-word;">
            Note: The overflow-wrap property acts in the same way as the non-standard property word-wrap. The word-wrap
            property is now treated by browsers as an alias of the standard property.
        </div>
        <div class="me-auto bg-success text-start px-3 p-2 text-white border rounded shadow"
            style="max-width:max-content ;inline-size: 300px; overflow-wrap: break-word;">
            Note The overflow-wrap property acts in the same way as the non-standard property word-wrap. The word-wrap
            property is now treated by browsers as an alias of the standard property.
        </div>
        <div class="ms-auto mt-5 bg-primary text-start ps-3 p-2 text-white border rounded shadow"
            style="max-width:max-content ;inline-size: 300px; overflow-wrap: break-word;">
            Note: The overflow-wrap property acts in the same way as the non-standard property word-wrap. The word-wrap
            property is now treated by browsers as an alias of the standard property.
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-center container mx-auto">
        <input class="w-50 mx-3" type="text" name="messageInput" id="">
        <button class="btn btn-primary">Send</button>
    </div>

    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"
        integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+"
        crossorigin="anonymous"></script>
    <script>

        const socket = io("http://localhost:3000");

        const getName = async ()=>{
            const response = await fetch('http://localhost:8080/ChatController/getvalue')
            const name = await response.json()
            let username = name.username
            return username
        }

        const sendEvent =async ()=>{
            const username =await getName()
            socket.emit('userConnected', username)
        }

        const sendRequest =()=>{
            console.log('clicked')
        }

        sendEvent()

    </script>
</body>


</html>