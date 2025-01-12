<?php
require 'fungsi.php';

$kode_dokter = mysqli_real_escape_string($koneksi, $_POST['kode_dokter']);
$nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
$spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
$no_str = mysqli_real_escape_string($koneksi, $_POST['no_str']);
$no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
$jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

// Cek apakah kode dokter atau STR sudah ada
$check_query = "SELECT * FROM dokter WHERE kode_dokter = '$kode_dokter' OR no_str = '$no_str'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "Kode Dokter atau Nomor STR sudah terdaftar";
    exit;
}

$sql = "INSERT INTO dokter (kode_dokter, nama_lengkap, spesialisasi, no_str, no_telepon, jenis_kelamin, alamat) 
        VALUES ('$kode_dokter', '$nama_lengkap', '$spesialisasi', '$no_str', '$no_telepon', '$jenis_kelamin', '$alamat')";

if (mysqli_query($koneksi, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>