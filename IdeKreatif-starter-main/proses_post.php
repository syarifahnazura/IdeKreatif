<?php
// menghubungkan file konfigurasi database
include 'config.php';

// memulai sesi php
session_start();

// mendapatkan id pengguna dari sesi
$userId = $_SESSION["user_id"];

// menangani form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    // mendapatkan data dari form
    $postTitle = $_POST["post_title"]; // judul postingan
    $content = $_POST["content"]; // konten postingan
    $categoryId = $_POST["category_id"]; // id kategori

    // mengatur direktori penyimpanan file gambar
    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES["image"]["name"]; // nama file gambar
    $imagePath = $imageDir . basename($imageName); // path lengkap gambar

    // memindahkan file gambar yang diunggah ke direktori tujuan
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // jika unggahan berhasil, masukkan
        // data postingan kedalam database
        $query = "INSERT INTO posts (post_title, content, created_at, category_id, user_id, image_path) VALUES ('$postTitle', '$content', NOW(), $categoryId, $userId, '$imagePath')";

        if ($conn->query($query) === TRUE) {
            // notifikasi berhasil jika postingan berhasil ditambahkan
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post successfully added.'
            ];
        } else {
            // notifikasi error jika gaga menambahkan postingan
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: '. $conn->error
            ];
        }
    } else {
        // notifikasi error jika unggahan gambar gagal
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Failed to upload image.'
        ];
    }

    // arahkan ke halaman dashboard setelah selesai
    header('Location: dashboard.php');
    exit();
}

// proses penghapus postingan
if (isset($_POST['delete'])) {
    // mengambil id post dari parameter url
    $postID = $_POST['postID'];

    // query untuk menghapus post berdasarkan id
    $exec = mysqli_query($conn, "DELETE FROM posts WHERE id_post='$postID'");

    // menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post successfully deleted.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting post: ' . mysqli_error($conn)
        ];
    }

    // redirect kembali ke halaman dashboard
    header('Location: dashboard.php');
    exit();
}