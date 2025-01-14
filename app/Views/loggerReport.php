<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logger Report</title>
</head>

<body>
    <div class="mt-3 mx-auto border container bg-white">
        <a href="<?= base_url('/LoggerReportController/download') ?>">Download</a>
        <?php if (count($pageData) > 0): ?>
            <table id="usertable" class="table table-striped" style="font-size:10px;">
                <thead>
                    <tr>
                        <th>Call Start</th>
                        <th>Call Type</th>
                        <th>Dispose Name</th>
                        <th>Dispose Type</th>
                        <th>Duration (sec.)</th>
                        <th>Agent Name</th>
                        <th>Campaign Name</th>
                        <th>Process Name</th>
                        <th>Leadset Id</th>
                        <th>Reference Id</th>
                        <th>Customer Id</th>
                        <th>Hold (sec.)</th>
                        <th>Mute (sec.)</th>
                        <th>Ringing (sec.)</th>
                        <th>Transfer (sec.)</th>
                        <th>Conference (sec.)</th>
                        <th>Call (sec.)</th>
                        <th>Dispose Time (sec.)</th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pageData as $data): ?>
                        <tr>
                            <td><?= $data['callstart'] ?></td>
                            <td><?= $data['call_type'] ?></td>
                            <td><?= $data['dispose_name'] ?></td>
                            <td><?= $data['dispose_type'] ?></td>
                            <td><?= $data['duration'] ?></td>
                            <td><?= $data['agentname'] ?></td>
                            <td><?= $data['campaign_name'] ?></td>
                            <td><?= $data['process_name'] ?></td>
                            <td><?= $data['leadset_id'] ?></td>
                            <td><?= $data['reference_uuid'] ?></td>
                            <td><?= $data['customer_uuid'] ?></td>
                            <td><?= $data['hold'] ?></td>
                            <td><?= $data['mute'] ?></td>
                            <td><?= $data['ringing'] ?></td>
                            <td><?= $data['transfer_time'] ?></td>
                            <td><?= $data['conference'] ?></td>
                            <td><?= $data['call_time'] ?></td>
                            <td><?= $data['dispose_time'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h1 class="text-center bg-body">No records found</h1>
        <?php endif; ?>
    </div>

</body>

</html>