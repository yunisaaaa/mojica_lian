<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
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
        form {
            background: rgba(255, 248, 240, 0.95);
            max-width: 420px;
            margin: 40px auto;
            padding: 32px 44px;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(111, 78, 55, 0.18);
            display: flex;
            flex-direction: column;
            gap: 22px;
            border: 2px solid #a67c52;
        }
        label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #a67c52;
            font-size: 1.08em;
            font-family: 'Merriweather', serif;
        }
        input[type="text"], input[type="email"] {
            padding: 11px;
            border: 1px solid #a67c52;
            border-radius: 8px;
            background: #e6ccb2;
            color: #4b2e19;
            font-size: 1em;
            outline: none;
            transition: border 0.3s, background 0.3s;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            border: 1.5px solid #6f4e37;
            background: #fff8f0;
        }
        button {
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #a67c52 0%, #6f4e37 100%);
            color: #fff8f0;
            font-size: 1.08em;
            font-family: 'Merriweather', serif;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
            margin-top: 10px;
            box-shadow: 0 2px 8px #a67c5233;
        }
        button:hover {
            background: linear-gradient(90deg, #6f4e37 0%, #a67c52 100%);
            box-shadow: 0 4px 16px #6f4e3733;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #a67c52;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Merriweather', serif;
            transition: color 0.3s;
        }
        a:hover {
            color: #6f4e37;
        }
    </style>
    <!-- Google Fonts for Merriweather -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Create User</h1>
    <form action="<?=site_url('users/create');?>" method="post">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" >

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" >

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" >

        <button type="submit">Submit</button>
        <a href="<?=site_url('users/show');?>">Back to Show</a>
    </form>