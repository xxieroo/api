<?php
include "koneksimysql.php";

$order_id = $_POST['order_id'];
$uploadDir = "upload_bukti/";

if (isset($_FILES['bukti'])) {
    $fileName = time() . "_" . basename($_FILES["bukti"]["name"]);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $targetFilePath)) {
        // Update bukti_bayar dan status ke 'Diproses'
        $sql = "UPDATE orders SET bukti_bayar='$fileName', status='Diproses' WHERE order_id='$order_id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["success" => true, "message" => "Upload berhasil dan status diperbarui"]);
        } else {
            echo json_encode(["success" => false, "message" => "Upload berhasil, tapi gagal update status"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Gagal upload file"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "File tidak ditemukan"]);
}
