<?php
require_once("../config.php");
// mulai session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (usename, name, password)
    VALUES ('$username, $name, $hashedPassword')";
    if ($conn->query($sql) == TRUE) {
        // simpan notifikasi ke dalam session
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Registrasi Berhasil!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal Registrasi: ' . mysqli_error($conn)
        ];
    }
    header('Location: login.php');
    exit();

}

$conn->close();
?>