<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama MyBengkel</title>
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Roboto,Arial,sans-serif;}
        body {background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:20px;}
        h1 {color:#ffffff;font-size:36px;margin-bottom:30px;text-align:center;}
        .menu {display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:15px;max-width:700px;width:100%;}
        .menu a {background:rgba(255,255,255,.15);color:white;text-decoration:none;padding:15px;border-radius:8px;text-align:center;border:1px solid rgba(255,255,255,.2);transition:.3s;}
        .menu a:hover {background:rgba(255,255,255,.25);transform:translateY(-2px);}
        .keluar {margin-top:25px;text-align:center;}
        .keluar a {color:#ffcccc;text-decoration:none;}
    </style>
</head>
<body>
    <h1>🔧 Sistem Informasi Bengkel</h1>
    <div class="menu">
        <a href="pendaftaran_pelanggan.php"> Pendaftaran Pelanggan</a>
        <a href="list_pelanggan.php"> Daftar Pelanggan</a>
        <a href="stok_barang.php"> Manajemen Stok</a>
        <a href="transaksi_bengkel.php"> Kasir / Transaksi</a>
        <a href="laporan_transaksi.php"> Laporan Transaksi</a>
    </div>
    <div class="keluar">
        <a href="keluar.php"> Keluar / Logout</a>
    </div>
</body>
</html>
