<?php

// menghubungkan ke file konfigurasi database
include("config.php");

// memulai sesi untuk menyimpan notifikasi
session_start();

// proses penambahan kategori baru
if (isset($_POST['simpan'])) {
    // mengambil data nama kategori dari form
    $category_name = $_POST['category_name'];

    // query untuk menambahkan data kategori ke dalam database
    $query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    $exec = mysqli_query($conn, $query);

    // menyimpan notifikasi berhasil atau gagal ke dalam session
    if ($exec){
        $_SESSION['notification'] = [
            'type' => 'primary', // jenis notifikasi (contoh: primary untuk keberhasilan)
            'message' => 'kategori berhasil ditamahkan!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger', // jenis notifikasi (contoh: danger untuk kegagalan)
            'message' => 'Gagal menambahkan kategori: ' . mysqli_error($conn)
        ];
    }

    // redirect kembalike halaman kategori
    header('Location: kategori.php');
    exit();
}

// Proses penghapusan kategori
if (isset($_POST['delete'])) {
    // Mengambil ID kategori dari parameter URL
    $catID = $_POST['catID'];

    // Query untuk menghapus kategori berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$catID'");

    // Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Kategori berhasil dihapus!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menghapus kategori: ' . mysqli_error($conn)
        ];
    }

    // Redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
}