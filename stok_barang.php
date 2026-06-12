<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_u = $_POST['harga_umum'];
    $harga_m = $_POST['harga_member'];
    mysqli_query($koneksi,"INSERT INTO barang (nama_barang, stok, harga_umum, harga_member) VALUES ('$nama', '$stok', '$harga_u', '$harga_m')");
    $pesan = "Barang berhasil ditambahkan ke stok!";
}
$barang = mysqli_query($koneksi,"SELECT * FROM barang ORDER BY nama_barang ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Stok Barang</title>
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Roboto,Arial,sans-serif;}
        body {background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);min-height:100vh;padding:30px 20px;}
        .wadah {max-width:800px;margin:0 auto;}
        h2 {color:white;text-align:center;margin-bottom:25px;}
        .kotak-form {background:white;padding:25px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.3);margin-bottom:20px;}
        .pesan {text-align:center;padding:10px;border-radius:6px;margin-bottom:15px;background:#d4edda;color:#155724;}
        .grup {margin-bottom:15px;}
        label {display:block;margin-bottom:5px;font-weight:500;}
        input {width:100%;padding:10px;border:1px solid #ced4da;border-radius:6px;font-size:15px;}
        button {padding:10px 20px;background:#28a745;color:white;border:none;border-radius:6px;font-weight:500;cursor:pointer;}
        table {width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;box-shadow:0 8px 20px rgba(0,0,0,.3);}
        th, td {padding:12px;text-align:left;border-bottom:1px solid #e0e0e0;}
        th {background:#007bff;color:white;}
        tr:hover {background:#f1f8ff;}
        .kembali {text-align:center;margin-top:20px;}
        .kembali a {color:white;text-decoration:none;}
    </style>
</head>
<body>
    <div class="wadah">
        <h2>📦 Manajemen Stok Barang</h2>
        <div class="kotak-form">
            <?php if (isset($pesan)) echo "<div class='pesan'>$pesan</div>"; ?>
            <form method="POST">
                <div class="grup">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" required>
                </div>
                <div class="grup">
                    <label>Jumlah Stok</label>
                    <input type="number" name="stok" min="1" required>
                </div>
                <div class="grup">
                    <label>Harga Umum</label>
                    <input type="number" name="harga_umum" min="0" required>
                </div>
                <div class="grup">
                    <label>Harga Member</label>
                    <input type="number" name="harga_member" min="0" required>
                </div>
                <button type="submit">Tambah Barang</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Umum</th>
                    <th>Harga Member</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                <tr>
                    <td><?= $b['nama_barang'] ?></td>
                    <td><?= $b['stok'] ?></td>
                    <td>Rp <?= number_format((int)$b['harga_umum'],0,',','.') ?></td>
                    <td>Rp <?= number_format((int)$b['harga_member'],0,',','.') ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="kembali">
            <a href="index.php">← Kembali ke Menu Utama</a>
        </div>
    </div>
</body>
</html>
