<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Cek apakah request HTTPS GET
    if (!isset($_POST['kode'])) {
        echo json_encode("Field kode required");
    } else if (!isset($_POST['nama'])) {
        echo json_encode("Field nama required");
    }

    include '../koneksi.php';

    $kodeMataKuliah = $_POST['kode'];
    $namaMataKuliah = $_POST['nama'];

    // query sql 
    $querySQL = "SELECT mk.KdMataKuliah FROM tmatakuliah mk WHERE mk.KdMataKuliah = '$kodeMataKuliah'";
    $dbData = mysqli_query($conn, $querySQL); // Cek apakah kode sudah ada
    if (mysqli_num_rows($dbData) > 0) {
        echo json_encode("Data sudah ada");
    } else {
        $querySQL = "INSERT INTO tmatakuliah (KdMataKuliah,MataKuliah) VALUES ('$kodeMataKuliah','$namaMataKuliah')";
        mysqli_query($conn, $querySQL); // Insert sql
        echo json_encode("Data berhasil disimpan");
    }
    mysqli_close($conn);
} else {
    echo json_encode("HTTP Not allowed");
}
