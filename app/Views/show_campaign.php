<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns</title>
</head>

<body>


    <div class="bg-white mt-1 d-flex align-items-center justify-content-between" style="font-size: 12px;">
        <ol class="breadcrumb m-0 px-2">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/show-campaigns">Show Campaign</a></li>
            
        </ol>
        <a href="<?= base_url('/add-campaign') ?>"><i class="fa-solid fa-plus px-5"></i> </a>
        
    </div>
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
                <?php foreach ($pageData as $campaign): ?>
                    <tr>
                        <td><?php echo $campaign->cid; ?></td>
                        <td><?php echo $campaign->campaign_name; ?></td>
                        <td><?php echo $campaign->supervisor; ?></td>
                        <td>

                            <a class="mx-1" href="/campaignupdatedetails/<?= $campaign->cid; ?>"><i
                                    class="fa-solid fa-pen-to-square text-success"></i></a>
                            <a class="mx-1" href="/deletecampaign/<?= $campaign->cid; ?>"><i
                                    class="fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div>
</body>

</html>