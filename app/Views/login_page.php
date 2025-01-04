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

    <!-- <div class="bg-white mt-1" style="font-size: 12px;">
        <ol class="breadcrumb m-0 px-2">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="">Show User</a></li>
            <li class="breadcrumb-item"><a href="/add-user">Add User</a></li>
        </ol>
    </div> -->
    <div class="mt-5 container text-center border bg-white w-25" style="font-size:13px">
        <img class="w-50" src="<?= base_url('images/slash2.jpg')?>" alt="">
        <?= session()->getFlashdata('message') ? "<div class='p-1 mt-1 text-danger'>*" . session()->getFlashdata('message') . "</div>" : "" ?>
        <form class="px-2" action="/postlogin" method="POST">

            <div class=" justify-content-center">

                <input class="mb-2 col-4 w-75 text-center" name="username" type="text" id=""
                    placeholder="Enter username"><br>
            </div>
            <div class="justify-content-center">
                <input type="password" class="mb-2 col-4 w-75 text-center" name="password" type="text" id=""
                    placeholder="Enter password"><br>
            </div>

            <input style="background-color:green; color:white; border:none" class="mt-2" type="submit" name="" id="">
        </form>
    </div>
</body>

</html>