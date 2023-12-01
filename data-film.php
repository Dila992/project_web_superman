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
$insert ="INSERT INTO film (judul,link_nonton) VALUES ('$judul','$link_nonton','$gambar')";
if(mysqli_query($conn, $insert)){
    // Jika berhasil disisipkan, tampilkan pesan sukses
    echo "<script>alert('Input Data Berhasil!');document.location('data-film.php')</script>";
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
    <title>Data Film</title>
</head>
<body>
<?php 
include 'koneksi.php';
$sql = "SELECT * FROM film";
$query = mysqli_query($conn,$sql);
$hasil = mysqli_fetch_array($query);

if(!empty($hasil['id_user'])){ 
    echo "
                <tr>
                    <td>" . $row['id_film'] . "</td>
                    <td>" . $row['judul'] . "</td>
                    <td>" . $row['link_nonton'] . "</td>
                    <td>" . $row['gambar'] . "</td>
                    <td><a href='data-user.php?upd=" . $row['id_film'] . "'>Update</a> | 
                    <a href='data-user.php?del=" . $row['id_film'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a></td>
                </tr>";
            }
?> 
</body>
</html>

