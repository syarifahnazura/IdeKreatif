<?php
session_start(); // memulai sesi
session_unset(); // menghapus semua data sesi
session_destroy(); // menghapus sesi sepenuhnya
header('Location: Login.php'); // arahkan pengguna ke halaman login
exit(); // menghentikan eksekusi script