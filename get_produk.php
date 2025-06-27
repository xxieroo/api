<?php
header('Content-Type: application/json');
include "koneksimysql.php";

// Query untuk mengambil data produk
$sql = "SELECT id_produk, nama, hargajual, stok, kategori, deskripsi, foto, jumlah_pengunjung FROM tbl_produk";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Mengembalikan data dalam format JSON
echo json_encode($products);

$conn->close();
