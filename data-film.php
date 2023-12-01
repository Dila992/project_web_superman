<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: wp-admin.php");
    exit();
}?>
<?php
include 'koneksi.php';
if (isset($_POST['submit'])) {
    // Mengambil nilai dari formulir
    $judul = $_POST["judul"];
    $link_nonton = $_POST["link_nonton"];
    // File upload
    $targetDir = "images/";
    $fileName = basename($_FILES["gambar"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    // Memindahkan file ke direktori tujuan
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
        // Query untuk menyimpan data ke dalam database
        $sql = "INSERT INTO film (judul, link_nonton, gambar) VALUES ('$judul', '$link_nonton', '$targetFilePath')";

        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan ke dalam database.";
        } else {
            echo "Maaf, terjadi kesalahan saat menyimpan data ke dalam database: " . $conn->error;
        }

        // Tutup koneksi database
        $conn->close();
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
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
    <form action="">
        <!-- Form untuk insert data film -->
    </form>
<?php 
include 'koneksi.php';
$sql = "SELECT * FROM film";
$query = mysqli_query($conn,$sql);
$hasil = mysqli_fetch_array($query);
echo '<table border="1">
        <tr>
            <th>ID Film</th>
            <th>Judul</th>
            <th>Link Nonton</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>';

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
<?php 
include "koneksi.php";
if(isset($_GET['del'])){
$id_user = $_GET['del'];
$sql = "DELETE FROM film WHERE id_film = '$id_film' ";
$query = mysqli_query($conn, $sql);
}

?>         
<?php
include "koneksi.php";

if(isset($_GET['upd'])){
    $upd = $_GET['upd'];
    $sql = "select * from film where id_film='$upd' ";
    $query = mysqli_query($conn,$sql);
    $hasil = mysqli_fetch_array($query);
    if($hasil){
        ?>
        <!-- Form untuk update -->
        <?php
    }
}

include 'koneksi.php';

if (isset($_GET['update'])) {
    $upd = $_GET['update'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mengambil nilai dari formulir
        $judul = $_POST["judul"];
        $link_nonton = $_POST["link_nonton"];

        // File upload
        $targetDir = "images/";
        $fileName = basename($_FILES["gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Memindahkan file ke direktori tujuan
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
            // Query untuk mendapatkan data film yang akan diupdate
            $sql_select = "SELECT * FROM film WHERE id = $upd";
            $result_select = $conn->query($sql_select);

            if ($result_select->num_rows > 0) {
                $row = $result_select->fetch_assoc();
                $oldImage = $row["gambar"];

                // Query untuk update data film
                $sql_update = "UPDATE film SET judul='$judul', link_nonton='$link_nonton', gambar='$targetFilePath' WHERE id=$upd";

                if ($conn->query($sql_update) === TRUE) {
                    // Hapus gambar lama setelah berhasil mengupdate data
                    unlink($oldImage);

                    echo "Data berhasil diupdate.";
                } else {
                    echo "Maaf, terjadi kesalahan saat mengupdate data: " . $conn->error;
                }
            } else {
                echo "Data film tidak ditemukan.";
            }

            // Tutup koneksi database
            $conn->close();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>
</body>
</html>

