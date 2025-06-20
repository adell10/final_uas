<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "projectuas";

$connection = mysqli_connect("localhost:3307", "username", "password", "database");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>