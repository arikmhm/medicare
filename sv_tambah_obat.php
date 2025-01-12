<?php
require 'fungsi.php';

$kode_obat = mysqli_real_escape_string($koneksi, $_POST['kode_obat']);
$nama_obat = mysqli_real_escape_string($koneksi, $_POST['nama_obat']);
$jenis_obat = mysqli_real_escape_string($koneksi, $_POST['jenis_obat']);
$stok = intval($_POST['stok']);
$harga_satuan = floatval($_POST['harga_satuan']);
$tanggal_kadaluarsa = mysqli_real_escape_string($koneksi, $_POST['tanggal_kadaluarsa']);
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

// Cek apakah kode obat sudah ada
$check_query = "SELECT * FROM obat WHERE kode_obat = '$kode_obat'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "Kode obat sudah terdaftar";
    exit;
}

$sql = "INSERT INTO obat (kode_obat, nama_obat, jenis_obat, stok, harga_satuan, tanggal_kadaluarsa, keterangan) 
        VALUES ('$kode_obat', '$nama_obat', '$jenis_obat', $stok, $harga_satuan, '$tanggal_kadaluarsa', '$keterangan')";

if (mysqli_query($koneksi, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>