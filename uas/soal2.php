<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') { // Cek apakah request HTTPS GET
    include '../koneksi.php';

    $vaResult = []; // default result array

    $where = "";
    if (isset($_GET['jenis_kelamin'])) { // jika terdapat filter jenis kelamin
        $where = "WHERE m.JenisKelamin = '" . $_GET['jenis_kelamin'] . "'";
    }

    //query sql
    $querySQL = "SELECT m.NIM,m.NamaLengkap,m.JenisKelamin,m.Kelas FROM tmahasiswa m $where";
    $dbData = mysqli_query($conn, $querySQL);
    while ($row = mysqli_fetch_array($dbData)) {
        array_push($vaResult, array(  // push array
            "nim" => $row['NIM'],
            "nama_lengkap" => $row['NamaLengkap'],
            "jenis_kelamin" => $row['JenisKelamin'],
            "kelas" => $row['Kelas']
        ));
    }
    if (count($vaResult) > 0) { // jika data ditemukan
        echo json_encode($vaResult);
    } else {
        echo json_encode("Data tidak ditemukan");
    }

    mysqli_close($conn);
} else {
    echo json_encode("HTTP Not allowed");
}
