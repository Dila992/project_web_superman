<?php
session_start();

include "koneksi.php";
if(isset($_POST['submit'])){
$entered_username = $_POST['username'];
$entered_password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username = '$entered_username' AND password = '$entered_password'";
$query = mysqli_query($conn, $sql);

if ($query) {
    // Periksa jumlah baris hasil query
    $jumlah_baris = mysqli_num_rows($query);

    if ($jumlah_baris == 1) {
        // Kredensial benar, inisialisasi sesi
        $_SESSION['username'] = $entered_username;

        // Redirect ke halaman dashboard atau halaman lain yang sesuai
        header("Location: index.php");
        exit();
    } else {
        // Kredensial salah, mungkin tampilkan pesan kesalahan atau redirect kembali ke halaman login
        echo "alert(Kombinasi username dan password salah)";
    exit();
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!-- Form Login di Sini -->
</body>
</html>