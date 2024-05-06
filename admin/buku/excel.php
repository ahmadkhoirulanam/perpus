<?php
require 'vendor/autoload.php'; // Memuat autoload dari Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'data_perpus';

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Koneksi ke database gagal: ' . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file_excel"])) {
    $file_excel = $_FILES["file_excel"]["tmp_name"];

    try {
        $spreadsheet = IOFactory::load($file_excel);
    } catch (Exception $e) {
        die('Error loading file "' . $_FILES["file_excel"]["name"] . '": ' . $e->getMessage());
    }

    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
   

    // Mulai dari baris kedua untuk menghindari judul kolom
    for ($row = 2; $row <= count($sheetData); $row++) {
        $id_buku = $sheetData[$row]['A'];
        $judul_buku = $sheetData[$row]['B'];
        $pengarang = $sheetData[$row]['C'];
        $penerbit = $sheetData[$row]['D'];
        $th_terbit = $sheetData[$row]['E'];

        // Masukkan data ke dalam database
        $sql = "INSERT INTO tb_buku (id_buku, judul_buku, pengarang, penerbit, th_terbit) VALUES ('$id_buku', '$judul_buku', '$pengarang', '$penerbit', '$th_terbit')";
        if ($mysqli->query($sql) !== true) {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }

    echo "<script>alert('Data berhasil ditambah'); document.location='index.php?page=MyApp/data_buku';</script>";
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Excel</title>
</head>

<body>
    <div class='col-md-12'>
        <div class='box box-info'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Tambah Data Buku </h3>
            </div>
            <div class='box-body'>
                <div class="alert alert-info mb-5" role="alert">
                    <h4 class="alert-heading">
                        <i class="glyphicon glyphicon-warning-sign"></i>
                        Perhatian
                    </h4>
                    <ul>
                        <li>
                            Untuk mengimpor Data Buku, harap gunakan template excel yang tersedia.
                            <a class="font-weight-bold" target="_blank" href="uploads/Data_buku.xlsx">
                                <i class="glyphicon glyphicon-download-alt"></i>
                                 Unduh disini.
                            </a>
                        </li>
                        <li>
                            Selalu periksa kembali kebenaran Data Buku.
                        </li>
                        <li>
                            Mohon periksa kembali  Data Buku.
                        </li>
                        <li class="font-weight-bold">
                            Sesudah mengklik tombol upload, anda tidak bisa membatalkan proses upload.
                        </li>
                    </ul>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <table class='table table-condensed table-bordered'>
                        <tbody>
                           
                           

                            <tr>
                                <th width='120px' scope='row'>File</th>
                                <td><input type="file" name="file_excel" id="file_excel"></td>
                            </tr>
                        </tbody>
                    </table>

                    <input type="submit" value="Upload" name="submit">
                </form>
            </div>
        </div>
    </div>


</body>

</html>