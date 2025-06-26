<?php
include 'koneksimysql.php'; // sesuaikan nama file koneksi kamu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];

    // Pastikan data produk ditemukan
    $cek = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
    if (mysqli_num_rows($cek) > 0) {
        // Update jumlah pengunjung
        $update = mysqli_query($conn, "UPDATE tbl_produk SET jumlah_pengunjung = jumlah_pengunjung + 1 WHERE id_produk = '$id_produk'");
        if ($update) {
            echo json_encode(["success" => true, "message" => "Viewer updated"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal update viewer"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Produk tidak ditemukan"]);
    }
}
