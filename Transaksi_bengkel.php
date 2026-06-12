<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $pelanggan = $_POST['no_plat'];
    $layanan = $_POST['layanan'];
    $biaya = $_POST['biaya_layanan'];
    $id_barang = $_POST['id_barang'] ?? '';
    $jumlah = $_POST['jumlah'] ?? 0;
    $total = $_POST['total_bayar'];

    mysqli_query($koneksi,"INSERT INTO transaksi (no_plat, layanan, biaya, id_barang, jumlah, total, tanggal) VALUES ('$pelanggan', '$layanan', '$biaya', '$id_barang', '$jumlah', '$total', NOW())");
    $id_baru = mysqli_insert_id($koneksi);

    if (!empty($id_barang) && $jumlah > 0) {
        mysqli_query($koneksi,"UPDATE barang SET stok = stok - $jumlah WHERE id_barang = '$id_barang'");
    }

    echo "<script>alert('Transaksi Berhasil'); location='nota.php?id=$id_baru';</script>";
    exit;
}

$pelanggan = mysqli_query($koneksi,"SELECT * FROM pelanggan ORDER BY nama_pemilik ASC");
$barang = mysqli_query($koneksi,"SELECT * FROM barang ORDER BY nama_barang ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir / Transaksi</title>
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Roboto,Arial,sans-serif;}
        body {background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);min-height:100vh;padding:30px 20px;}
        .wadah {max-width:550px;margin:0 auto;}
        h2 {color:white;text-align:center;margin-bottom:25px;}
        .kotak-form {background:white;padding:30px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.3);}
        .grup {margin-bottom:16px;}
        label {display:block;font-weight:500;margin-bottom:6px;color:#333;}
        input, select {width:100%;padding:10px 12px;border:1px solid #ced4da;border-radius:6px;font-size:15px;}
        .total {font-size:17px;font-weight:bold;color:#212529;padding:10px 0;}
        .tombol {display:flex;gap:12px;margin-top:12px;}
        button, a {padding:10px 20px;border-radius:6px;font-size:15px;font-weight:500;border:none;cursor:pointer;text-decoration:none;}
        button {background:#28a745;color:white;}
        button:hover {background:#218838;}
        a {background:#6c757d;color:white;}
        a:hover {background:#545b62;}
        .kembali {text-align:center;margin-top:20px;}
        .kembali a {color:white;text-decoration:none;}
    </style>
</head>
<body>
    <div class="wadah">
        <h2> Kasir / Transaksi Bengkel</h2>
        <div class="kotak-form">
            <form method="POST" id="form-transaksi">
                <div class="grup">
                    <label>Pilih Pelanggan</label>
                    <select name="no_plat" id="pelanggan" required>
                        <option value="">-- Pilih --</option>
                        <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                        <option value="<?= $p['no_plat'] ?>"><?= $p['nama_pemilik'] ?> - <?= $p['no_plat'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="grup">
                    <label>Jenis Layanan</label>
                    <input type="text" name="layanan" placeholder="Contoh: Ganti Oli, Servis Ringan" required>
                </div>
                <div class="grup">
                    <label>Biaya Layanan (Rp)</label>
                    <input type="number" name="biaya_layanan" id="biaya" value="0" min="0" required>
                </div>
                <div class="grup">
                    <label>Pilih Sparepart</label>
                    <select name="id_barang" id="barang">
                        <option value="">-- Tidak Pakai --</option>
                        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                        <option value="<?= $b['id_barang'] ?>" data-harga="<?= $b['harga_umum'] ?>" data-stok="<?= $b['stok'] ?>">
                            <?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="grup">
                    <label>Jumlah Barang</label>
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1">
                </div>
                <div class="total">Total Bayar: Rp <span id="total">0</span></div>
                <input type="hidden" name="total_bayar" id="total_bayar" value="0">
                <div class="tombol">
                    <button type="submit" name="simpan">Simpan & Buat Nota</button>
                    <a href="index.php">Kembali</a>
                </div>
            </form>
        </div>
        <div class="kembali">
            <a href="index.php">← Kembali ke Menu Utama</a>
        </div>
    </div>
    <script>
    const biayaLayanan = document.getElementById('biaya');
    const barang = document.getElementById('barang');
    const jumlah = document.getElementById('jumlah');
    const totalTeks = document.getElementById('total');
    const totalInput = document.getElementById('total_bayar');

    function hitungTotal() {
        let lay = parseInt(biayaLayanan.value) || 0;
        let hrgBrg = parseInt(barang.selectedOptions[0].dataset.harga) || 0;
        let jml = parseInt(jumlah.value) || 0;
        let total = lay + (hrgBrg * jml);
        totalTeks.textContent = total.toLocaleString('id-ID');
        totalInput.value = total;
    }
    biayaLayanan.addEventListener('input', hitungTotal);
    barang.addEventListener('change', hitungTotal);
    jumlah.addEventListener('input', hitungTotal);
    </script>
</body>
</html>
