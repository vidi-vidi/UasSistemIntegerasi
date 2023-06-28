<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Cek apakah request HTTPS GET
    if (!isset($_POST['kode'])) {
        echo json_encode("Field kode required");
    } else if (!isset($_POST['nama'])) {
        echo json_encode("Field nama required");
    }

    include '../koneksi.php';

    $kodeDosen = $_POST['kode'];
    $namaDosen = $_POST['nama'];

    // query sql 
    $querySQL = "SELECT d.KdDosen FROM tdosen d  WHERE d.KdDosen = '$kodeDosen'";
    $dbData = mysqli_query($conn, $querySQL); // Cek apakah kode sudah ada
    if (mysqli_num_rows($dbData) > 0) {
        $querySQL = "UPDATE  tdosen SET NamaDosen = '$namaDosen' WHERE KdDosen = '$kodeDosen'";
        mysqli_query($conn, $querySQL); // Insert sql
        echo json_encode("Data Berhasil Diperbarui");
    } else {
        echo json_encode("Data Tidak ditemukan");
    }
    mysqli_close($conn);
} else {
    echo json_encode("HTTP Not allowed");
}
