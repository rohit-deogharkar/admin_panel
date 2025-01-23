<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Panel</title>
</head>

<body>
    <input type="hidden" id="usernamevalue" value="<?= session('data')['username'] ?>">
    <button id="readyStateButton">Ready</button>
</body>

<script>
    const readyStateButton = document.getElementById('readyStateButton');
    const username = document.getElementById('usernamevalue').value
    readyStateButton.addEventListener('click', async () => {
        console.log('ready state hit', Date.now())
        const data = {
            username: username,
            state: "ready",
            timing: Date.now()
        }
        hitRequest(data)
        // console.log(data)
    })

    const hitRequest = async (data) => {
        try {
            const result = await fetch('http://localhost:8080/AgentStateContoller/setstate', {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            const response = await result.json()
            console.log(response)
        }
        catch (ex) {
            console.log(ex)
        }
    }
</script>

</html>