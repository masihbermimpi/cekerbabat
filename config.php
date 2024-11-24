<?php
$host = "localhost"; // atau alamat IP server
$username = "root"; // username database
$password = ""; // password database
$database = "restoran"; // nama database

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}