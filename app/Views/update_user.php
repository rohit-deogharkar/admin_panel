<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: "Rubik", sans-serif;
            background-color: #e1e1e1;
        }
    </style>

</head>


<body>
    <? ?>
    <div class="mt-5 container text-center p-3 border bg-white w-50" style="font-size:13px">
        <form class="p-3" action="/postupdatedetials/<?= $user['id']?>" method="POST">

            <div class="row justify-content-center">
                <span class="col-4">Enter username
                </span>
                <input class="mb-2 col-4" name="username" type="text" id="" value="<?= $user['username']?>"><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4">Enter Email
                </span>
                <input class="mb-2 col-4" name="email" type="text" id="" value="<?= $user['email']?>"><br><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4">Enter password
                </span>
                <input class="mb-2 col-4" name="password" type="text" id="" value="<?= $user['password']?>"><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4"> Select Role:
                </span>
                <select class="mb-2 col-4" name="role" id="roles" value="<?= $user['role']?>">
                    <option value="Team Leader">Team Leader</option>
                    <option value="Agent">Agent</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Admin">Admin</option>
                </select><br>
            </div>

            <div class="row justify-content-center">
                <span class="col-4">Enter Date of Birth
                </span>
                <input class="mb-2 col-4" class="" name="date_of_birth" type="date" id="" value="<?= $user['date_of_birth']?>"><br><br>
            </div>

            <input style="background-color:green; color:white; border:none" class="" type="submit" name="" id="">
        </form>
    </div>
</body>

</html>