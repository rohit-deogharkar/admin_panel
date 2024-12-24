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

    <div class="filter-div container m-auto mt-2 text-center" style="font-size:12px;">
        <form action="/show-campaigns">
            <select class="" id="filter-select" name="filter-supervisor">
                <option value="" type="disabled">Select Supervisor</option>
                <?php foreach ($filterData as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" id="">
        </form>
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
                        <td><?php echo $campaign['cid']; ?></td>
                        <td><?php echo $campaign['campaign_name']; ?></td>
                        <td><?php echo $userData[$campaign['supervisor_id'] - 1]['username']; ?></td>
                        <td>

                            <a class="mx-1" href="/campaignupdatedetails/<?= $campaign['cid']; ?>"><i
                                    class="fa-solid fa-pen-to-square text-success"></i></a>
                            <a class="mx-1" href="/deletecampaign/<?= $campaign['cid']; ?>"><i
                                    class="fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="container d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
        <div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // document.getElementById('usertable').dataTable()

    $(document).ready(function () {
        $('#filter-select').select2({
            width: "13%"
        })
    });
</script>

</html>