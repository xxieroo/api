<?php

define('host', 'localhost');

// Hosting
define('user', 'androidanggoro');
define('password', 'Anggoro123');
define('database', 'androidanggoro');

// Local
// define('user', 'androidanggoro');
// define('password', '');
// define('database', 'androi');

$conn = mysqli_connect(host, user, password, database);
if (!$conn) {
    echo "Koneksi Gagal : " . mysqli_connect_error();
    exit();
}
