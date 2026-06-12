<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $admin_user = "admin";
    $admin_pass = "bengkel123";
    if ($user === $admin_user && $pass === $admin_pass) {
        $_SESSION['admin'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Nama pengguna atau kata sandi salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - MyBengkel</title>
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Roboto,Arial,sans-serif;}
        body {background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);min-height:100vh;display:flex;align-items:center;justify-content:center;}
        .kotak-login {background:#fff;padding:35px 40px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.3);width:100%;max-width:360px;}
        h2 {text-align:center;margin-bottom:20px;color:#222;}
        .pesan {color:red;text-align:center;margin-bottom:15px;}
        .grup {margin-bottom:15px;}
        label {display:block;margin-bottom:5px;font-weight:500;color:#333;}
        input {width:100%;padding:10px;border:1px solid #ced4da;border-radius:6px;font-size:15px;}
        button {width:100%;padding:10px;background:#007bff;color:white;border:none;border-radius:6px;font-weight:500;cursor:pointer;}
        button:hover {background:#0056b3;}
    </style>
</head>
<body>
    <div class="kotak-login">
        <h2>🔐 Masuk Admin</h2>
        <?php if (isset($pesan)) echo "<div class='pesan'>$pesan</div>"; ?>
        <form method="POST">
            <div class="grup">
                <label>Nama Pengguna</label>
                <input type="text" name="username" required>
            </div>
            <div class="grup">
               <label>Kata Sandi</label>
                <input type="password" name="password"required>
            </div>
            <button type="submit">Masuk ke Aplikasi</button>
        </form>
    </div>
</body>
</html>
