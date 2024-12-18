<?php

echo view('navbar');

?>


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
        <form class="p-3" action="/postcampaignupdatedetails/<?= $updatdetails['cid'] ?>" method="POST">

            <div class="row justify-content-center">
                <span class="col-4">Enter username
                </span>
                <input class="mb-2 col-4" name="campaign_name" type="text" id=""
                    value="<?= $updatdetails['campaign_name'] ?>"><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4">Enter Email
                </span>
                <input class="mb-2 col-4" name="campaign_description" type="text" id=""
                    value="<?= $updatdetails['campaign_description'] ?>"><br><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4"> Select Role:
                </span>
                <select class="mb-2 col-4" name="supervisor_id" id="roles">
                    <?php foreach ($supservisors as $supervisor): ?>
                        <option value="<?= $supervisor['id'] ?>"><?= $supervisor['username'] ?></option>
                    <?php endforeach; ?>
                </select><br>
            </div>


            <input style="background-color:green; color:white; border:none" class="" type="submit" name="" id="">
        </form>
    </div>
</body>

</html>