<?php
require "fungsi.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_obat = mysqli_real_escape_string($koneksi, $_POST['nama_obat']);
    $jenis_obat = mysqli_real_escape_string($koneksi, $_POST['jenis_obat']);
    $stok = intval($_POST['stok']);
    $harga_satuan = floatval($_POST['harga_satuan']);
    $tanggal_kadaluarsa = mysqli_real_escape_string($koneksi, $_POST['tanggal_kadaluarsa']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    if (empty($nama_obat) || empty($jenis_obat) || $stok < 0 || $harga_satuan < 0 || empty($tanggal_kadaluarsa)) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
        exit;
    }

    $stmt = $koneksi->prepare("UPDATE obat SET 
        nama_obat = ?, 
        jenis_obat = ?,
        stok = ?,
        harga_satuan = ?,
        tanggal_kadaluarsa = ?,
        keterangan = ?
        WHERE id = ?");

    $stmt->bind_param("ssiissi", 
        $nama_obat,
        $jenis_obat,
        $stok,
        $harga_satuan,
        $tanggal_kadaluarsa,
        $keterangan,
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