<?php

use App\App\App;
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title ?> - ToDoList PHP MVC</title>
    <link rel="stylesheet" type="text/css" href="<?php echo App::get('config')['APP_URL'] . '/public/assets/css/bootstrap.min.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo App::get('config')['APP_URL'] . '/public/assets/css/daterangepicker.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo App::get('config')['APP_URL'] . '/public/assets/css/fullcalendar.min.css' ?>" />

    <style type="text/css">
        label.error {
            font-size: 14px;
            color: #ff0000;
            font-style: italic;
        }
    </style>
</head>

<body>