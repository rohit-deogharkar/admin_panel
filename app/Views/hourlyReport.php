<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hourly Report</title>
</head>

<body>
    <form action="<?= base_url('LoggerReportController/getMysqlHourly') ?>">
        <select name="reportType" id="">
            <option value="hourly">Hourly Report</option>
            <option value="agentwise">Agentwise</option>
            <input type="submit" name="" id="">
        </select>
    </form>
    <div class="mt-3 mx-auto border container bg-white">
        <?php if (count($pageData) > 0): ?>
            <table id="usertable" class="table table-striped" style="font-size:10px;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <?= isset($pageData[0]['hour']) ? "<th>Hour</th>" : '<th>Agent Name</th>' ?>
                        <th>Total Calls</th>
                        <th>Total Duration</th>
                        <th>Total Call Time</th>
                        <th>Total Hold Time</th>
                        <th>Total Mute Time</th>
                        <th>Total Transfer Time</th>
                        <th>Total Conference Time</th>
                        <th>Total Ringing Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pageData as $data): ?>
                        <tr>
                            <td><?= date('Y-m-d', strtotime($data['date'])) ?></td>
                            <td><?= isset($data['hour']) ? date('h', timestamp: strtotime($data['hour'])) . "-" . date('h', strtotime($data['hour'])) + 1 : $data['agentname'] ?>
                            </td>
                            <td><?= $data['total_calls'] ?></td>
                            <td><?= gmdate("H:i:s", $data['total_duration']) ?></td>
                            <td><?= gmdate("H:i:s", $data['total_call_time']) ?></td>
                            <td><?= gmdate("H:i:s", $data['total_hold_time']) ?></td>
                            <td><?= gmdate("H:i:s", $data['total_mute_time']) ?></td>
                            <td><?= gmdate("H:i:s", $data['total_transfer_time']) ?></td>
                            <td><?= gmdate("H:i:s", $data['total_conference_time']) ?></td>
                            <td><?= gmdate("H:i:s", $data['total_ringing_time']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h1 class="text-center bg-body">No records found</h1>
        <?php endif; ?>
</body>

</html>