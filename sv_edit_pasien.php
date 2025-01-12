<?php
require "fungsi.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $nomor_telepon = mysqli_real_escape_string($koneksi, $_POST['nomor_telepon']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $golongan_darah = mysqli_real_escape_string($koneksi, $_POST['golongan_darah']);

    // Validasi input
    if (empty($nama_lengkap) || empty($tanggal_lahir) || empty($alamat) || 
        empty($nomor_telepon) || empty($jenis_kelamin) || empty($golongan_darah)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field harus diisi!']);
        exit;
    }

    $stmt = $koneksi->prepare("UPDATE pasien SET 
        nama_lengkap = ?, 
        tanggal_lahir = ?,
        alamat = ?,
        nomor_telepon = ?,
        jenis_kelamin = ?,
        golongan_darah = ?
        WHERE id = ?");

    $stmt->bind_param("ssssssi", 
        $nama_lengkap,
        $tanggal_lahir,
        $alamat,
        $nomor_telepon,
        $jenis_kelamin,
        $golongan_darah,
        $id
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>