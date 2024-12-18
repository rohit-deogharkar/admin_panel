<?php

echo view('navbar');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns</title>
</head>

<body>
    <div class="mt-5 mx-auto border container bg-white">
        <table id="usertable" class="table table-striped" style="font-size:12px;">
            <thead>
                <tr>
                    <th>Campaign ID</th>
                    <th>Campaign Name</th>
                    <th>Handling Supervisor Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($campaigns as $campaign): ?>
                    <tr>
                        <td><?php echo $campaign->cid; ?></td>
                        <td><?php echo $campaign->campaign_name; ?></td>
                        <td><?php echo $campaign->supervisor; ?></td>
                        <td>
                            <a href="/campaignupdatedetails/<?= $campaign->cid; ?>">Update</a>
                            <a href="/deletecampaign/<?= $campaign->cid; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div>
</body>

</html>