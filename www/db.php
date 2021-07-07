<?php

$connection = mysqli_connect("localhost", "pthon", "123456", "ktelekom");

if (!$connection) {
    die("Can't connect to database"); 
}