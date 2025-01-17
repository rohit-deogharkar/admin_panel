<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logger Report</title>
</head>

<body>
    <button onclick="toggleFilter()">Filters</button>
    <div id="filterdiv" class="container text-center">
        <form action="<?= base_url('LoggerReportController/filter') ?>" method="POST">
            <select name="agentname" id="">
                <?php if (!empty($filterdata['condition']['agentname'])): ?>
                    <option value="<?= $filterdata['condition']['agentname'] ?>">
                        <?= $filterdata['condition']['agentname'] ?>
                    </option>
                <?php else: ?>
                    <option selected disabled>Agent Name</option>
                <?php endif; ?>

                <?php foreach ($filterdata['agentname'] as $names): ?>
                    <?php if (!$names == null): ?>
                        <option value="<?= $names ?>"><?= $names ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <select name="process_name" id="">
                <?php if (!empty($filterdata['condition']['process_name'])): ?>
                    <option value="<?= $filterdata['condition']['process_name'] ?>">
                        <?= $filterdata['condition']['process_name'] ?>
                    </option>
                <?php else: ?>
                    <option selected disabled>Process Name</option>
                <?php endif; ?>

                <?php foreach ($filterdata['process_name'] as $names): ?>
                    <?php if (!$names == null): ?>
                        <option value="<?= $names ?>"><?= $names ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <select name="call_type" id="">
                <?php if (!empty($filterdata['condition']['call_type'])): ?>
                    <option value="<?= $filterdata['condition']['call_type'] ?>">
                        <?= $filterdata['condition']['call_type'] ?>
                    </option>
                <?php else: ?>
                    <option selected disabled>Call Type</option>
                <?php endif; ?>

                <?php foreach ($filterdata['call_type'] as $names): ?>
                    <?php if (!$names == null): ?>
                        <option value="<?= $names ?>"><?= $names ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <select name="dispose_name" id="">
                <?php if (!empty($filterdata['condition']['dispose_name'])): ?>
                        <option value="<?= $filterdata['condition']['dispose_name'] ?>">
                            <?= $filterdata['condition']['dispose_name'] ?>
                        </option>
                    <?php else: ?>
                        <option selected disabled>Dispose Name</option>
                    <?php endif; ?>

                    <?php foreach ($filterdata['dispose_name'] as $names): ?>
                        <?php if (!$names == null): ?>
                            <option value="<?= $names ?>"><?= $names ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </select>

            <select name="leadset_id" id="">
                <?php if (!empty($filterdata['condition']['leadset_id'])): ?>
                    <option value="<?= $filterdata['condition']['leadset_id'] ?>">
                        <?= $filterdata['condition']['leadset_id'] ?>
                    </option>
                <?php else: ?>
                    <option selected disabled>Leadset Id</option>
                <?php endif; ?>

                <?php foreach ($filterdata['leadset_id'] as $names): ?>
                    <?php if (!$names == null): ?>
                        <option value="<?= $names ?>"><?= $names ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <select name="dispose_type" id="">
                <?php if (!empty($filterdata['condition']['dispose_type'])): ?>
                    <option value="<?= $filterdata['condition']['dispose_type'] ?>">
                        <?= $filterdata['condition']['dispose_type'] ?>
                    </option>
                <?php else: ?>
                    <option selected disabled>Dispose Type</option>
                <?php endif; ?>

                <?php foreach ($filterdata['dispose_type'] as $names): ?>
                    <?php if (!$names == null): ?>
                        <option value="<?= $names ?>"><?= $names ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <select name="campaign_name" id="">
                <?php if (!empty($filterdata['condition']['campaign_name'])): ?>
                    <option value="<?= $filterdata['condition']['campaign_name'] ?>">
                        <?= $filterdata['condition']['campaign_name'] ?>
                    </option>
                <?php else: ?>
                    <option selected disabled>Campaign Name</option>
                <?php endif; ?>

                <?php foreach ($filterdata['campaign_name'] as $names): ?>
                    <?php if (!$names == null): ?>
                        <option value="<?= $names ?>"><?= $names ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <input type="submit" name="" id="">
        </form>
    </div>
    <div class="mt-3 mx-auto border container bg-white">
        <form action="<?= base_url('/LoggerReportController/index') ?>">
            <select name="datarequest" id="">
                <option value="sql">MySql Logger Report</option>
                <option value="mongo">Mongo Logger Report</option>
                <option value="elastic">Elastic Logger Report</option>
                <input type="submit" name="" id="">
            </select>
        </form>
        <a href="<?= base_url('/LoggerReportController/downloadMysqlCdr') ?>">Download</a>
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
                            <td><?= isset($data['call_type']) ? $data['call_type'] : $data['calltype'] ?></td>
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

<script>
    const filterdiv = document.getElementById("filterdiv")
    // filterdiv.style.visibility = "hidden"
    const toggleFilter = () => {
        console.log("hello ")
        filterdiv.style.visibility === "hidden" ? filterdiv.style.visibility = "visible" : filterdiv.style.visibility = "hidden";
    }
</script>

</html>