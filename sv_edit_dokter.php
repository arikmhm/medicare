<?php
require "fungsi.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    if (empty($nama_lengkap) || empty($spesialisasi) || empty($no_telepon) || 
        empty($jenis_kelamin) || empty($alamat)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field harus diisi!']);
        exit;
    }

    $stmt = $koneksi->prepare("UPDATE dokter SET 
        nama_lengkap = ?, 
        spesialisasi = ?,
        no_telepon = ?,
        jenis_kelamin = ?,
        alamat = ?
        WHERE id = ?");

    $stmt->bind_param("sssssi", 
        $nama_lengkap,
        $spesialisasi,
        $no_telepon,
        $jenis_kelamin,
        $alamat,
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