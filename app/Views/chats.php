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
            border-bottom-style: ridge;
            /* border: 1px solid black; */
            padding: 10px;
            font-size: 17px;
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

        .onlineStatus {
            font-size: 13px;
            margin: 0px;
            color: grey;
        }
    </style>
</head>

<body>
    <div class=" border-primary mt-3 mx-auto align-items-center container d-flex row p-0"
        style="background-color: #F8FAFC">
        <div class="col-4 p-0 border-end border-dark">
            <div class="container p-3" style="font-size:17px">
                Chats
            </div>
            <div class="user-list" style="background-color: #D4EBF8; height:678px">

            </div>
        </div>

        <div class="col-8  border-dark p-0" id="chatSection">
            <div class="p-3 border fs-bold" id="header" style="font-size:17px; background-color: #D4EBF8">
                this will be header
            </div>
            <div class="container p-4 bg-white messagesContainer" style="height:600px; overflow-y: scroll;">
            </div>
            <div class="w-100 d-flex align-items-center justify-content-center container mx-auto p-2 px-4 pt-3"
                style="background-color: #D4EBF8">
                <form class="w-100 text-center mb-2" id="messageForm" style="background-color: #D4EBF8">
                    <input class="col-11 p-2" type="text" id="messageInput" style="font-size: 15px;">
                    <button type="submit" class="btn btn-primary btn-sm " id="sendButton"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; padding:11px 15px;">Send</button>
                </form>
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
        const messageForm = document.getElementById('messageForm')
        const chatSection = document.getElementById('chatSection')
        chatSection.style.visibility = "hidden"
        // messageForm.style.visibility = "hidden"
        // socket.on('online', (data) => {
        //     console.log(data)
        //     if (data) {
        //         headerName.innerHTML += "<br>" + "online"
        //     }
        // })

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

        if (messageForm) {
            messageForm.addEventListener('submit', (e) => {
                e.preventDefault()
                let messageInput = document.getElementById('messageInput').value
                if (messageInput) {
                    appendRightMessage(messageInput)
                    sendMessageFunction(messageInput)
                    document.getElementById('messageInput').value = ""
                } 
            })
        }

        const sendMessageFunction = async (messageInput) => {
            const response = await fetch('http://localhost:8080/ChatController/getvalue')
            const name = await response.json()
            let data = {
                'sendername': name.username,
                'recievername': name.recievername,
                'message': messageInput,
                'roomname': name.recievername
            }
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
                    chatSection.style.visibility = "visible"
                    data = {
                        "id": element.getAttribute('data-value'),
                        'username': element.innerText
                    }

                    headerName.innerText = " "
                    headerName.innerHTML = element.innerText
                    socket.emit('checkIsOnline', element.innerText)
                    // let recieverNameHeading = document.createElement('div')
                    socket.on('isOnline', (data) => {
                        if (data) {
                            headerName.innerHTML = element.innerText + '<p class="onlineStatus">online'
                        }
                    })
                    // messagesContainer.appendChild(recieverNameHeading)
                    // console.log(recieverNameHeading)
                    storeUserSession(data)
                    openThisPanel = {
                        senderName: senderName,
                        recieverName: element.innerText,
                        roomname: data.username
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