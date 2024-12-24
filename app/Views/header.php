<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
        /* width:150px; */
        /* margin-left: -35px; */
        color: black;
        background-color: white;
        text-align: center;
        border: 0.5px solid #F0F0F0;
        /* border-radius: 5px; */
        font-size: 12px;
    }

    .operations-menu:hover .operations-list {
        display: block;
        position: fixed;
        /* text-align: center; */

    }

    a,
    .link {
        text-decoration: none;
        color: black;
    }
</style>

<div class="py-2 px-4 border bg-white">
    <img src="<?= base_url('images/slash-icon.jpg') ?>" style="width:30px;" alt="">
</div>


<?= view('navbar'); ?>