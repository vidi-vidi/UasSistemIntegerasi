<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') { // Cek apakah request HTTPS GET
    include '../koneksi.php'; // Koneksi PHP

    $vaResult = []; // default result array
    //query sql
    $querySQL = "SELECT mk.MataKuliah,d.NamaDosen  FROM tmatakuliah mk INNER JOIN tdosen d on d.kdMatkul = mk.KdMataKuliah";
    $dbData = mysqli_query($conn, $querySQL);
    while ($row = mysqli_fetch_array($dbData)) {
        array_push($vaResult, array(  // push array
            "nama_dosen" => $row['NamaDosen'],
            "mata_kuliah" => $row['MataKuliah']
        ));
    }

    if (count($vaResult) > 0) { //Jika ada ditemukan
        echo json_encode($vaResult);
    } else {
        echo json_encode("Data tidak ditemukan");
    }
    mysqli_close($conn); // close koneksi
} else {
    echo json_encode("HTTP Not allowed");
}
