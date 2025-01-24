<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Panel</title>
</head>

<body>
    <input type="hidden" id="usernamevalue" value="<?= session('data')['username'] ?>">
    <button class="stateButton" value="ready">Ready</button>
    <button class="stateButton" value="stop">Stop</button>
    <button class="stateButton" value="pause">Pause</button>
    <button class="stateButton" value="call">Call</button>
    <button class="stateButton" value="hold">Hold</button>
    <button class="stateButton" value="mute">Mute</button>
</body>

<script>
    // // console.log(data)
    // const readyStateButton = document.getElementById('readyStateButton');
    const username = document.getElementById('usernamevalue').value

    const data = {
        username: username,
        'stop': Date.now(),
    }

    const buttonNodes = document.querySelectorAll('.stateButton');
    // console.log(buttonNodes)

    buttonNodes.forEach(e => {
        // console.log(e)
        e.addEventListener('click', () => {
            // console.log(e.value)
            // const data = {
            //     username: username,
            //     state: e.value,
            //     timing: Date.now()
            // }
            const data = {}
            data['username'] = username
            data[e.value] = Date.now()
            // console.log(data)
            hitRequest(data)
        })
    })


    // readyStateButton.addEventListener('click', async () => {
    //     console.log('ready state hit', Date.now())
    //     const data = {
    //         username: username,
    //         state: "ready",
    //         timing: Date.now()
    //     }
    //     hitRequest(data)
    // })

    const hitRequest = async (data) => {
        console.log("This hit")
        try {
            const result = await fetch('http://localhost:8080/AgentStateContoller/setstate', {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            const response = await result.json()
            console.log("response=> ", response)
        }
        catch (ex) {
            console.log(ex)
        }
    }

    hitRequest(data)
</script>

</html>