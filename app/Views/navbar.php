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

<div class="pt-2 pb-2 shadow-sm m-0 border bg-white">
    <div class="d-flex justify-content-center px-5">
        <div class="row text-center " style="font-size:12px">
            <div class="col col-md-auto align-items-center">
                <a class="link" href="<?= base_url('/') ?>"><i class="fa-solid fa-chart-line px-1"
                        style="font-size:10px"></i>
                    Dashboard</a>
            </div>
            <div class="col col-md-auto align-items-center">
                <div class="operations-menu">
                    <a class="link" href="#">
                        <i class="fa-solid fa-rss px-1" style="font-size:10px"></i>
                        Live</a>
                    <!-- <ul class="operations-list">
                        <li><a href="/">Users</a></li>
                        <li><a href="/">Campaigns</a></li>
                    </ul> -->
                </div>
            </div>
            <div class="col col-md-auto">

                <div class="col col-md-auto align-items-center">
                    <div class="operations-menu">
                        <a class="link" href="#"><i class="fa-solid fa-file-lines px-1" style="font-size:10px"></i>
                            Reports</a>
                        <!-- <ul class="operations-list">
                            <li><a href="/">Users</a></li>
                            <li><a href="/">Campaigns</a></li>
                        </ul> -->
                    </div>

                </div>
            </div>
            <div class="col col-md-auto">

                <div class="col col-md-auto align-items-center">
                    <div class="operations-menu">
                        <a class="link" href="#"><i class="fa-solid fa-comments px-1" style="font-size:10px"></i>
                            Conversations</a>
                        <ul class="operations-list">
                            <li><a href="<?=base_url('ChatController')?>">Chats</a></li>
                            
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col col-md-auto">

                <div class="col col-md-auto align-items-center">
                    <div class="operations-menu">
                        <a class="link" href="#"><i class="fa-solid fa-address-book px-1" style="font-size:10px"></i>
                            Contact</a>
                        <!-- <ul class="operations-list">
                            <li><a href="/">Users</a></li>
                            <li><a href="/">Campaigns</a></li>
                        </ul> -->
                    </div>

                </div>
            </div>
            <div class="col col-md-auto">

                <div class="col col-md-auto align-items-center">
                    <div class="operations-menu">
                        <a class="link" href="#"><i class="fa-brands fa-ubuntu px-1" style="font-size:10px"></i>
                            Operations</a>
                        <ul class="operations-list">

                            <li><a href="<?= base_url('/show-users') ?>">Show User</a></li>

                            <li><a href="<?= base_url('/show-campaigns') ?>">Show Campaign</a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col col-md-auto">
                <div class="col col-md-auto align-items-center">
                    <div class="operations-menu">
                        <a class="link" href="#"> <i class="fa-solid fa-sliders px-1" style="font-size:10px"></i>
                            Advanced Settings</a>
                        <!-- <ul class="operations-list">
                            <li><a href="/">Users</a></li>
                            <li><a href="/">Campaigns</a></li>
                        </ul> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>