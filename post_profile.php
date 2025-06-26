<?php
include "koneksimysql.php";
header('Content-Type: application/json');

// Inisialisasi respon default
$response = [
    "result" => 0,
    "message" => "Terjadi kesalahan."
];

// Ambil dan filter data dari POST
$email    = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
$nama     = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
$alamat   = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');
$kota     = mysqli_real_escape_string($conn, $_POST['kota'] ?? '');
$provinsi = mysqli_real_escape_string($conn, $_POST['provinsi'] ?? '');
$telp     = mysqli_real_escape_string($conn, $_POST['telp'] ?? '');
$kodepos  = mysqli_real_escape_string($conn, $_POST['kodepos'] ?? '');

// Cek kelengkapan input
if (empty($email) || empty($nama) || empty($alamat) || empty($kota) || empty($provinsi) || empty($telp) || empty($kodepos)) {
    $response['message'] = "Data tidak lengkap.";
    echo json_encode($response);
    exit;
}

// === Upload Foto Jika Ada ===
$fotoFileName = null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "image_profile/";

    // Buat folder jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $fileType = mime_content_type($_FILES["foto"]["tmp_name"]);

    if (!in_array($fileType, $allowedTypes)) {
        $response['message'] = "Tipe file tidak diizinkan.";
        echo json_encode($response);
        exit;
    }

    $fotoFileName = time() . "_" . basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $fotoFileName;

    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $response['message'] = "Upload foto gagal.";
        echo json_encode($response);
        exit;
    }
}

// === Siapkan Query Update ===
$sql = "UPDATE tbl_pelanggan SET 
            nama = '$nama',
            alamat = '$alamat',
            kota = '$kota',
            provinsi = '$provinsi',
            telp = '$telp',
            kodepos = '$kodepos'";


// Tambah update foto jika ada
if ($fotoFileName) {
    $sql .= ", foto = '$fotoFileName'";
}

$sql .= " WHERE email = '$email'";

// === Eksekusi Query ===
$hasil = mysqli_query($conn, $sql);

if ($hasil) {
    $response['result'] = 1;
    $response['message'] = $fotoFileName ? "Profil dan foto berhasil diperbarui." : "Profil berhasil diperbarui.";
    if ($fotoFileName) {
        $response['foto'] = $fotoFileName;
    }
} else {
    $response['message'] = "Simpan gagal: " . mysqli_error($conn);
}

// Tutup koneksi dan kirim respon
mysqli_close($conn);
echo json_encode($response);
