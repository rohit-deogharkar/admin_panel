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
            <li class="breadcrumb-item"><a href="/show-campaigns">Show Campaign</a></li>
            <li class="breadcrumb-item"><a href="/add-campaign">Add Campaign</a></li>
        </ol>
    </div>
    <div class="mt-5 container text-center border bg-white w-50" style="font-size:13px">
        <?= session()->getFlashdata('message') ? "<div class='p-1 mt-1 text-danger'>*" . session()->getFlashdata('message') . "</div>" : "" ?>
        <form class="pt-3" action="<?= base_url('insert-campaign') ?>" method="POST">
            <div class="row p-0 justify-content-center">
                <span class="col-4">Enter Name
                </span>
                <input class="mb-2 col-4" name=" campaign_name" type="text" id=""><br>
            </div>
            <div class="row justify-content-center">
                <span class="col-4">Enter Description
                </span>
                <input class="mb-2 col-4" name="campaign_description" type="text" id=""><br><br>
            </div>

            <div class="row justify-content-center">
                <span class="col-4"> Select Supervisor:
                </span>
                <select class="mb-2 col-4" name="supervisor_id" id="roles" placeholder="select supervisor">
                    <?php if (count($supservisors) > 0): ?>
                        <?php foreach ($supservisors as $supservisor): ?>
                            <option value="<?= $supservisor['id'] ?>"><?= $supservisor['username'] ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No Supervisor</option>
                    <?php endif; ?>
                </select><br>
            </div>
            <input style="background-color:green; color:white; border:none" class="" type="submit" name="" id="">
        </form>
    </div>
</body>

</html>