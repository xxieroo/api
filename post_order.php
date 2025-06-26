<?php
include "koneksimysql.php";
header('Content-Type: application/json');

// Ambil data dari POST
$email      = $_POST['email'];
$nama       = $_POST['nama'];
$alamat     = $_POST['alamat'];
$telp       = $_POST['telp'];
$kodepos    = $_POST['kodepos'];
$provinsi   = $_POST['provinsi'];
$kota       = $_POST['kota'];
$metode     = $_POST['metode_pembayaran'];
$subtotal   = $_POST['subtotal'];
$ongkir     = $_POST['ongkir'];
$estimasi   = $_POST['estimasi'];
$total      = $_POST['total'];
$status     = $_POST['status'];

$sql = "INSERT INTO orders (email, nama, alamat, telp, kodepos, provinsi, kota,
        metode_pembayaran, subtotal, ongkir, estimasi, total, status)
        VALUES ('$email', '$nama', '$alamat', '$telp', '$kodepos', '$provinsi', '$kota',
        '$metode', '$subtotal', '$ongkir', '$estimasi', '$total', '$status')";


if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo json_encode(['result' => '1', 'message' => 'Order berhasil', 'order_id' => $last_id]);
} else {
    echo json_encode(['result' => '0', 'message' => 'Gagal simpan order: ' . mysqli_error($conn)]);
}
