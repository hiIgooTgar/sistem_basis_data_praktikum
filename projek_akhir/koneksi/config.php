<?php

$conn = mysqli_connect("localhost", "root", "", "restoran_sbd");

if (!$conn) {
    die("Database tidak terhubung ") . mysqli_connect_error($conn);
}
