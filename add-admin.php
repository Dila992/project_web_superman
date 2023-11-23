<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: wp-admin.php");
    exit();
}

$admin_username = $_SESSION['$admin_username']?>
<?php 
if(isset($_POST['submit'])){
include 'koneksi.php';    
$username = $_POST['username'];
$password =$_POST['password'];
$insert ="INSERT INTO admin (username,password) VALUES ('$username','$password')";
if(mysqli_query($conn, $insert)){
    // Jika berhasil disisipkan, tampilkan pesan sukses
    echo "<script>alert('Registrasi Berhasil!');document.location('admin.php')</script>";
} else {
    // Jika gagal, tampilkan pesan kesalahan
    echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
}

// Menutup koneksi ke database
mysqli_close($koneksi);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
</head>
<body>
    <!-- Form untuk add admin di sini -->
</body>
</html>
