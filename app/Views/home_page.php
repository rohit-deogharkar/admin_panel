<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

    <div class="bg-white mt-1" style="font-size: 12px;">
        <ol class="breadcrumb m-0 px-2">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        </ol>
    </div>

    <div class="container">
        <div class="row p-2">
            <div class="col p-5 shadow-sm bg-white m-4">
                Agents Logged In
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar w-75" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col shadow-sm bg-white m-4">
                Column
            </div>
            <div class="col shadow-sm bg-white m-4">
                Column
            </div>
        </div>
    </div>
</body>


</html>