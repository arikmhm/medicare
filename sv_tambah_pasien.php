<?php
require 'fungsi.php';

$nomor_rm = mysqli_real_escape_string($koneksi, $_POST['nomor_rm']);
$nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
$tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$nomor_telepon = mysqli_real_escape_string($koneksi, $_POST['nomor_telepon']);
$jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
$golongan_darah = mysqli_real_escape_string($koneksi, $_POST['golongan_darah']);

// Cek apakah nomor RM sudah ada
$check_query = "SELECT * FROM pasien WHERE nomor_rm = '$nomor_rm'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "Nomor RM sudah terdaftar";
    exit;
}

$sql = "INSERT INTO pasien (nomor_rm, nama_lengkap, tanggal_lahir, alamat, nomor_telepon, jenis_kelamin, golongan_darah) 
        VALUES ('$nomor_rm', '$nama_lengkap', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$jenis_kelamin', '$golongan_darah')";

if (mysqli_query($koneksi, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>