<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_pemilik'];
    $plat = $_POST['no_plat'];
    $status = $_POST['status'];

    $cek = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE no_plat='$plat'");
    if (mysqli_num_rows($cek) > 0) {
       $pesan = "Nomor plat kendaraan sudah terdaftar!";
    } else {
        mysqli_query($koneksi,"INSERT INTO pelanggan (nama_pemilik, no_plat, status) VALUES ('$nama', '$plat', '$status')");
        $pesan = "Data pelanggan berhasil disimpan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Pelanggan</title>
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Roboto,Arial,sans-serif;}
        body {background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);min-height:100vh;padding:30px 20px;}
        .wadah {max-width:500px;margin:0 auto;}
        h2 {color:white;text-align:center;margin-bottom:25px;}
        .kotak {background:white;padding:30px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.3);}
        .pesan {text-align:center;margin-bottom:15px;padding:10px;border-radius:6px;}
        .berhasil {background:#d4edda;color:#155724;}
        .gagal {background:#f8d7da;color:#721c24;}
        .grup {margin-bottom:15px;}
        label {display:block;margin-bottom:5px;font-weight:500;}
        input, select {width:100%;padding:10px;border:1px solid #ced4da;border-radius:6px;font-size:15px;}
        button {width:100%;padding:10px;background:#28a745;color:white;border:none;border-radius:6px;font-weight:500;cursor:pointer;}
        button:hover {background:#218838;}
        .kembali {text-align:center;margin-top:15px;}
        .kembali a {color:white;text-decoration:none;}
    </style>
</head>
<body>
    <div class="wadah">
        <h2> Pendaftaran Pelanggan</h2>
        <div class="kotak">
            <?php if (isset($pesan)) {
                $jenis = strpos($pesan, 'berhasil') !== false ? 'berhasil' : 'gagal';
                echo "<div class='pesan $jenis'>$pesan</div>";
            } ?>
            <form method="POST">
                <div class="grup">
                    <label>Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" required>
                </div>
                <div class="grup">
                    <label>Nomor Plat Kendaraan</label>
                   <input type="text" name="no_plat" required>
                </div>
                <div class="grup">
                    <label>Status Keanggotaan</label>
                    <select name="status" required>
                        <option value="Member">Member</option>
                        <option value="Umum">Umum</option>
                    </select>
                </div>
                <button type="submit">Simpan Data</button>
            </form>
        </div>
        <div class="kembali">
            <a href="index.php">← Kembali ke Menu Utama</a>
        </div>
    </div>
</body>
</html>
