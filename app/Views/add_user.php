<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: "Rubik", sans-serif;
            background-color: #e1e1e1;
        }
    </style>

</head>

<body>
    <?php ?>

    <div class="bg-white mt-1" style="font-size: 12px;">
        <ol class="breadcrumb m-0 px-2">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/show-users') ?>">Show User</a></li>
            <li class="breadcrumb-item"><a href="/add-user">Add User</a></li>
        </ol>
    </div>
    <div class="mt-5 container text-center border bg-white w-50" style="font-size:13px">
        <?= session()->getFlashdata('message') ? "<div class='p-1 mt-1 text-danger'>*" . session()->getFlashdata('message') . "</div>" : "" ?>
        <form class="pt-4" action="/post-user" method="POST">

            <div class="row p-0 justify-content-center">
                <span class="col-4">Enter username
                </span>
                <input class="mb-2 col-4" name="username" type="text" id=""><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4">Enter Email
                </span>
                <input class="mb-2 col-4" name="email" type="text" id=""><br><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4">Enter password
                </span>
                <input class="mb-2 col-4" name="password" type="text" id=""><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4"> Select Role:
                </span>
                <select class="mb-2 col-4" name="role" id="roles">
                    <?php foreach ($pageData as $level): ?>
                        <option value="<?= $level['lid'] ?>"><?= $level['level_name'] ?></option>
                    <?php endforeach; ?>
                </select><br>
            </div>

            <div class="row justify-content-center">
                <span class="col-4">Enter Date of Birth
                </span>
                <input class="mb-2 col-4" class="" name="date_of_birth" type="date" id=""><br><br>
            </div>

            <input style="background-color:green; color:white; border:none" class="" type="submit" name="" id="">
        </form>
    </div>
</body>

</html>