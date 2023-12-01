<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: wp-admin.php");
    exit();
}
$admin_username = $_SESSION['$admin_username']?>
<?php 
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id_detail = $_POST['id_detail'];
    $judul = $_POST['judul'];
    $link_nonton = $_POST['link_nonton'];
    $tahun_rilis = $_POST['tahun_rilis'];
    $genre = $_POST['genre'];
    $sutradara = $_POST['sutradara'];
    $pemeran = $_POST['pemeran'];
    $perusahaan_produksi = $_POST['perusahaan_produksi'];
    $id_film = $_POST['id_film'];

    $sql = "insert into detail_film (id_film, judul,link_nonton,tahun_rilis,genre, sutradara, pemeran, perusahaan_produksi, id_film) values ($id_film, $judul, $link_nonton,$tahun_rilis,$genre, $sutradara, $pemeran, $perusahaan_produksi, $id_film)";
    $insert = mysqli_query($conn,$sql);

    if(!$insert){
        echo '<script>alert("Gagal insert ke database");</script>';
    } else {
        echo '<script>alert("Berhasil menyimpan ke database");window.location.href="data_detail.php"</script>';
    }
}
?>
<?php
include 'koneksi.php';
$sql = "SELECT * FROM film";
$query = mysqli_query($conn, $sql);

echo '<table border="1">
        <tr>
            <th>ID Detail</th>
            <th>ID Film</th>
            <th>Judul</th>
            <th>Link Nonton</th>
            <th>Tahun Rilis</th>
            <th>Genre</th>
            <th>Sutradara</th>
            <th>Pemeran</th>
            <th>Perusahaan Produksi</th>
        </tr>';

while ($hasil = mysqli_fetch_array($query)) {
    echo "
        <tr>
            <td>" . $hasil['id_detail'] . "</td>
            <td>" . $hasil['id_film'] . "</td>
            <td>" . $hasil['judul'] . "</td>
            <td>" . $hasil['link_nonton'] . "</td>
            <td>" . $hasil['tahun_rilis'] . "</td>
            <td>" . $hasil['genre'] . "</td>
            <td>" . $hasil['sutradara'] . "</td>
            <td>" . $hasil['pemeran'] . "</td>
            <td>" . $hasil['perusahaan_produksi'] . "</td>
        </tr>";
}

echo '</table>';
?>

<?php 
include "koneksi.php";
if(isset($_GET['del'])){
$id_user = $_GET['del'];
$sql = "DELETE FROM detail_film WHERE id_film = '$id_film' ";
$query = mysqli_query($conn, $sql);
}

?>         
<?php
include "koneksi.php";

if(isset($_GET['upd'])){
    $upd = $_GET['upd'];
    $sql = "select * from detail_film where id_film='$upd' ";
    $query = mysqli_query($conn,$sql);
    $hasil = mysqli_fetch_array($query);
    if($hasil){
        ?>
        <!-- Form untuk update -->
        <?php
    }
}
if(isset($_POST['update'])){
    $adm = $_GET['adm'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $update = "UPDATE admin SET username='$username', password='$password' WHERE id_admin='$adm'";
    $query = mysqli_query($conn, $update);
    if($query){
        ?>
        <script>alert('Data Berhasil Diubah!'); document.location='admin.php';</script>
        <?php
    }
}
?>