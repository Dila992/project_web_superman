<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: wp-admin.php");
    exit();
}?>
<?php 
if(isset($_POST['submit'])){
include 'koneksi.php';    
$judul = $_POST['judul']; 
$link_nonton = $_POST['link_nonton'];
$link_info =$_POST['link_info'];
$insert ="INSERT INTO film (judul,link_nonton,link_info) VALUES ('$judul','$link_nonton','$link_info')";
if(mysqli_query($conn, $insert)){
    // Jika berhasil disisipkan, tampilkan pesan sukses
    echo "<script>alert('Input Data Berhasil!');document.location('info-film.php')</script>";
} else {
    // Jika gagal, tampilkan pesan kesalahan
    echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
}

// Menutup koneksi ke database
mysqli_close($koneksi);
}
?>
