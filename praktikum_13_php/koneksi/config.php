<?php

$conn = mysqli_connect("localhost", "root", "", "praktikumsbd");

if (!$conn) {
    die("Database tidak terhubung ") . mysqli_connect_error($conn);
}
