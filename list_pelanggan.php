<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
include "koneksi.php";
$data = mysqli_query($koneksi,"SELECT * FROM pelanggan ORDER BY nama_pemilik ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Roboto,Arial,sans-serif;}
        body {background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);min-height:100vh;padding:30px 20px;}
        .wadah {max-width:700px;margin:0 auto;}
        h2 {color:white;text-align:center;margin-bottom:25px;}
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
        <h2> Daftar Pelanggan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Pemilik</th>
                    <th>Nomor Plat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($p = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $p['nama_pemilik'] ?></td>
                    <td><?= $p['no_plat'] ?></td>
                    <td><?= $p['status'] ?></td>
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
