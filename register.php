<?php 
if(isset($_POST['submit'])){
include 'koneksi.php';    
$nama = $_POST['first_name'] . $_POST['last_name'];
$email = $_POST['email'];
$password =$_POST['password'];
$insert ="INSERT INTO user (nama,password,email) VALUES ('$nama','$password','$email')";
if(mysqli_query($koneksi, $insert)){
    // Jika berhasil disisipkan, tampilkan pesan sukses
    echo "<script>alert('Registrasi Berhasil!');document.location('login.php')</script>";
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
    <title>Register</title>
</head>
<body>
    <!-- Front End Di Sini -->
</body>
</html>