<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Cek apakah request HTTPS GET
    if (!isset($_POST['kode'])) {
        echo json_encode("Field kode required");
    }

    include '../koneksi.php';

    $kodeMataKuliah = $_POST['kode'];

    // query sql 
    $querySQL = "SELECT mk.KdMataKuliah FROM tmatakuliah mk WHERE mk.KdMataKuliah = '$kodeMataKuliah'";
    $dbData = mysqli_query($conn, $querySQL); // Cek apakah kode sudah ada
    if (mysqli_num_rows($dbData) > 0) {
        $querySQL = "DELETE FROM tmatakuliah WHERE KdMataKuliah = '$kodeMataKuliah'";
        mysqli_query($conn, $querySQL);
        echo json_encode("Data berhasil dihapus ");
    } else {
        echo json_encode("Data tidak ditemukan ");
    }
    mysqli_close($conn);
} else {
    echo json_encode("HTTP Not allowed");
}
