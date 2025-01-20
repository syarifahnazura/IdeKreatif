<?php

// konfigurasi koneksi database
$host = "localhost"; // nama host server database
$username = "root"; // username untuk akses database
$password = ""; // password untuk akses database
$database = "idekreatif"; // nama database untuk digunakan

// membuat koneksi ke database menggunakan mysql
$conn = mysqli_connect($host, $username, $password, $database);

// mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // menampilkan pesan error jika kneksi gagal
    die("Database gagal terkoneksi: " . $conn->connect_error);
}

// jika koneksi berhasil, script akan terus berjalan tanpa pesan error
?>