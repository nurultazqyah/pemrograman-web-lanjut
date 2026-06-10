session_start();
include "koneksi.php";

if (!isset($_SESSION['petugas'])) {
    header("Location: login.php");
}
