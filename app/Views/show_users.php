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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <style>
        body {
            font-family: "Rubik", sans-serif;
            background-color: #e1e1e1;
        }

        li a {
            text-decoration: none;
            color: black;
        }

        ul {
            list-style-type: none;
        }

        .operations-list {
            display: none;
            margin-top: 2px;
            padding: 7px;
            color: black;
            background-color: white;
            text-align: center;
            border: 0.5px solid #F0F0F0;
            font-size: 12px;
        }

        .operations-menu:hover .operations-list {
            display: block;
            position: fixed;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

    <div class="bg-white mt-1 d-flex align-items-center justify-content-between" style="font-size: 12px;">
        <ol class="breadcrumb m-0 px-2">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/show-users">Show Users</a></li>

        </ol>
        <a href="<?= base_url('/add-user') ?>"><i class="fa-solid fa-plus px-5"></i> </a>
    </div>

    <div class="mt-5 mx-auto border container bg-white">
        <?php if (count($pageData) > 0): ?>
            <table id="usertable" class="table table-striped" style="font-size:12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pageData as $user): ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->date_of_birth ?></td>
                            <td><?= $user->accessname ?></td>
                            <td>
                                <a class="mx-1" href="/updatedetials/<?= $user->id ?>"><i
                                        class="fa-solid fa-pen-to-square text-success"></i></a>
                                <a class="mx-1" href="/delete/<?= $user->id ?>"><i
                                        class="fa-solid fa-trash text-danger"></i></a>
                            </td>
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
    document.getElementById('usertable').dataTable()
</script>

</html>