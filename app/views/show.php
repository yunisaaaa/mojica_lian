<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Merriweather', serif;
            color: #4b2e19;
            background: linear-gradient(-45deg, #c2b280, #a67c52, #e6ccb2, #6f4e37);
            background-size: 400% 400%;
            animation: coffeeGradient 16s ease infinite;
        }
        @keyframes coffeeGradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        h1 {
            text-align: center;
            margin-top: 40px;
            letter-spacing: 2px;
            font-family: 'Merriweather', serif;
            font-size: 2.2em;
            color: #6f4e37;
            text-shadow: 0 2px 8px #e6ccb2;
        }
        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
            background: rgba(255, 248, 240, 0.95);
            box-shadow: 0 8px 32px 0 rgba(111, 78, 55, 0.18);
            border-radius: 18px;
            overflow: hidden;
        }
        th, td {
            padding: 14px 18px;
            text-align: left;
            font-size: 1.08em;
        }
        th {
            background: #a67c52;
            color: #fff8f0;
            font-family: 'Merriweather', serif;
        }
        tr:nth-child(even) td {
            background: #e6ccb2;
        }
        tr:nth-child(odd) td {
            background: #fff8f0;
        }
        td {
            color: #4b2e19;
        }
        a {
            color: #a67c52;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Merriweather', serif;
            transition: color 0.3s;
        }
        a:hover {
            color: #6f4e37;
        }
        .create-link {
            display: block;
            text-align: center;
            margin: 28px auto 0 auto;
            color: #a67c52;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Merriweather', serif;
            font-size: 1.15em;
            transition: color 0.3s;
            width: fit-content;
        }
        .create-link:hover {
            color: #6f4e37;
        }
    </style>
    <!-- Google Fonts for Merriweather -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Show User</h1>
    <table>
         <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Action</th>
         </tr>
         <?php foreach (html_escape($users) as $user):?>
            <tr>
                <td><?=$user['id'];?></td>
                <td><?=$user['last_name'];?></td>
                <td><?=$user['first_name'];?></td>
                <td><?=$user['email'];?></td>
                <td>
                    <a href="<?=site_url('users/update/'.$user['id']);?>">Update</a> |
                    <a href="<?=site_url('users/delete/'.$user['id']);?>">Delete</a>
                </td>
            </tr>
         <?php endforeach;?>
    </table>
    <a class="create-link" href="<?=site_url('users/create');?>">Create