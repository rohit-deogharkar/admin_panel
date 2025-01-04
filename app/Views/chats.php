<!DOCTYPE html>
<?php

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-size: 13px;
        }

        .users {
            border: 1px solid black;
            padding: 10px;
        }

        .left-message {
            max-width: max-content;
            inline-size: 300px;
            overflow-wrap: break-word;
        }

        .right-message {
            max-width: max-content;
            inline-size: 300px;
            overflow-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class="border-primary mt-3 mx-auto align-items-center container d-flex row p-0">
        <div class="border container col-4 user-list">
        </div>
        <div class="col-8">
            <div class="header p-1 border" id="header"></div>
            <div class="container p-4 bg-white messagesContainer" style="height:600px; overflow-y: scroll;">
            </div>
            <div class="mt-3 d-flex align-items-center justify-content-center container mx-auto p-0">
                <input class="w-25 p-1 mx-3" type="text" id="messageInput">
                <button class="btn btn-primary btn-sm" id="sendButton"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Send</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"
        integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+"
        crossorigin="anonymous"></script>
    <script>

        const socket = io("http://localhost:3000");

        const getName = async () => {
            const response = await fetch('http://localhost:8080/ChatController/getvalue')
            const name = await response.json()
            let username = name.username
            return username
        }

        const sendConnectionEvent = async () => {
            const username = await getName()
            console.log(username)
            socket.emit('userConnected', username)
        }

        sendConnectionEvent()

        const messagesContainer = document.querySelector('.messagesContainer')
        const headerName = document.getElementById('header')

        const appendRightMessage = (message) => {
            let classes = ['ms-auto', 'mt-2', 'bg-primary', 'text-start', 'px-3', 'p-1', 'text-white', 'border', 'rounded', 'shadow', 'left-message']
            const newMessage = document.createElement('div')
            newMessage.classList.add(...classes)
            newMessage.innerHTML = message
            messagesContainer.appendChild(newMessage)
        }

        const appendLeftMessage = (message) => {
            let classes = ['me-auto', 'mt-2', 'bg-success', 'text-start', 'px-3', 'p-1', 'text-white', 'border', 'rounded', 'shadow', 'right-message']
            const newMessage = document.createElement('div')
            newMessage.classList.add(...classes)
            newMessage.innerHTML = message
            messagesContainer.appendChild(newMessage)
        }

        const sendButton = document.getElementById('sendButton')

        sendButton.addEventListener('click', () => {
            let messageInput = document.getElementById('messageInput').value
            appendRightMessage(messageInput)
            sendMessageFunction(messageInput)
            document.getElementById('messageInput').value = ""
        })

        const sendMessageFunction = async (messageInput) => {
            const response = await fetch('http://localhost:8080/ChatController/getvalue')
            const name = await response.json()
            let data = {
                'sendername': name.username,
                'recievername': name.recievername,
                'message': messageInput
            }
            // socket.emit('sendmessage', data)
            socket.emit('sendThisMessageToRoom', data)
        }

        const userlist = document.querySelector('.user-list');

        const getUserFromSql = async () => {
            const usersFromSql = await fetch('http://localhost:8080/ChatController/getUers')
            const UserList = await usersFromSql.json()
            return UserList
        }

        const renderUserList = async () => {
            const users = await getUserFromSql()
            const senderName = await getName()
            users.forEach((element) => {
                let newdivs = `<div class="users" data-value="${element.id}">${element.username}</div>`
                userlist.innerHTML += newdivs
            });
            const userdivs = document.querySelectorAll('.users')
            userdivs.forEach((element) => {
                element.addEventListener('click', function () {
                    data = {
                        "id": element.getAttribute('data-value'),
                        'username': element.innerText
                    }
                    headerName.innerText = " "
                    // let recieverNameHeading = document.createElement('div')
                    headerName.innerText = element.innerText
                    // messagesContainer.appendChild(recieverNameHeading)
                    // console.log(recieverNameHeading)
                    storeUserSession(data)
                    let dataForRoomName = [senderName, data.username]
                    socket.emit('weJoinedRoom', { 'data': dataForRoomName, 'roomname': dataForRoomName.sort().join("_") })
                    openThisPanel = {
                        senderName: senderName,
                        recieverName: element.innerText
                    }
                    socket.emit('sendPreviousMessages', openThisPanel)
                    socket.on('takethisdata', (data) => {
                        messagesContainer.innerHTML = ""
                        data.forEach(newname => {
                            console.log(newname)
                            console.log(senderName)
                            if (newname.sendername == senderName && newname.recievername == element.innerText) {
                                appendRightMessage(newname.message)
                            }
                            if (newname.sendername == element.innerText && newname.recievername == senderName) {
                                appendLeftMessage(newname.message)
                            }
                        })
                    })
                    element.disabled = true
                })

            })
        }

        renderUserList()

        async function storeUserSession(data) {
            const response = await fetch('http://localhost:8080/ChatController/userSession', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            newResponse = await response.json()
            console.log(newResponse)
        }

        socket.on('sendThisMessageToRoom', (data) => {
            const sendMessageFunction = async (messageInput) => {
                const response = await fetch('http://localhost:8080/ChatController/getvalue')
                const name = await response.json()
                const recievername = name.recievername
                console.log(data.sendername)
                console.log(recievername)
                if (recievername == data.sendername) {
                    appendLeftMessage(data.message)
                }
                else {
                    return;
                }
            }
            sendMessageFunction()
        })

    </script>
</body>


</html>