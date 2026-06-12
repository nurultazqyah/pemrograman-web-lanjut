<?php
$koneksi = mysqli_connect("localhost", "root", "","mybengkel");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
