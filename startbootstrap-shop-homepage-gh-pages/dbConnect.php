<?php
/**
 * Created by PhpStorm.
 * User: AZZA
 * Date: 2019-02-19
 * Time: 18:22
 */


$connection = mysqli_connect('localhost', 'root', 'root', 'dinnersdirect');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'shop');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

    ?>
