<?php
include "koneksimysql.php";

$order_id = $_POST['order_id'];
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$subtotal = $_POST['subtotal'];

$sql = "INSERT INTO order_detail (order_id, id_produk, nama_produk, harga, jumlah, subtotal)
        VALUES ('$order_id', '$id_produk', '$nama_produk', '$harga', '$jumlah', '$subtotal')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['result' => '1', 'message' => 'Detail berhasil ditambahkan']);
} else {
    echo json_encode(['result' => '0', 'message' => 'Gagal simpan detail']);
}
