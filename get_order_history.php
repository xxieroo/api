<?php
include "koneksimysql.php";
header('Content-Type: application/json');

$email = $_POST['email'];
$data = [];

$sql = "SELECT * FROM orders WHERE email='$email' ORDER BY tanggal DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
