session_start();
include "koneksi.php";

if (!isset($_SESSION['petugas'])) {
    header("Location: login.php");
}

if (isset($_POST['simpan'])) {
    $no_plat       = $_POST['no_plat'];
    $layanan       = $_POST['layanan'];
    $biaya_layanan = $_POST['biaya_layanan'];
    $id_barang     = $_POST['id_barang'];
    $jumlah        = $_POST['jumlah'];
    $total_harga   = $_POST['total_harga'];

    mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('','$no_plat','$layanan','$biaya_layanan','$id_barang','$jumlah','$total_harga',NOW())");
    
    if (!empty($id_barang) && $jumlah>0) {
        mysqli_query($koneksi, "UPDATE barang SET stok=stok-$jumlah WHERE id_barang='$id_barang'");
    }
    echo "<script>location='nota.php?id=".mysqli_insert_id($koneksi)."';</script>";
}
