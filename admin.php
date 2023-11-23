<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: wp-admin.php");
    exit();
}
$admin_username = $_SESSION['$admin_username']?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <!-- Tabel Data User -->
<table>
<?php 
include 'koneksi.php';
$sql = "SELECT * FROM user";
$query = mysqli_query($conn,$sql);
$hasil = mysqli_fetch_array($query);

if(!empty($hasil['id_user'])){ 
    echo "
                <tr>
                    <td>" . $row['id_user'] . "</td>
                    <td>" . $row['nama'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td><a href='data-user.php?upd=" . $row['id_user'] . "'>Update</a> | 
                    <a href='data-user.php?del=" . $row['id_user'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a></td>
                </tr>";
            }

?> 
</table>
<?php 
include "koneksi.php";
if(isset($_GET['del'])){
$id_user = $_GET['del'];
$sql = "DELETE FROM user WHERE id_user = '$id_user' ";
$query = mysqli_query($koneksi, $sql);
}

?>         
<?php
include "koneksi.php";

if(isset($_GET['upd'])){
    $upd = $_GET['upd'];
    $sql = "select * from user where id_user='$upd' ";
    $query = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($query);
    if($hasil){
        ?>
        <!-- Form untuk update -->
        <?php
    }
}
if(isset($_POST['update'])){
    $upd = $_GET['upd'];
    $nama = $_POST['nama'];
    $username = $_POST['email'];
    $password = $_POST['password'];
    $update = "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id_user='$upd'";
    $query = mysqli_query($conn, $update);
    if($query){
        ?>
        <script>alert('Data Berhasil Diubah!'); document.location='admin.php';</script>
        <?php
    }
}
?>