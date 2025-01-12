<?php
require 'fungsi.php';

$jmlDataPerHal = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$awalData = ($jmlDataPerHal * $page) - $jmlDataPerHal;

$stmt = $koneksi->prepare("SELECT * FROM obat 
    WHERE (nama_obat LIKE ? OR kode_obat LIKE ? OR jenis_obat LIKE ?) 
    LIMIT ?, ?");

$searchParam = "%{$search}%";
$stmt->bind_param("sssii", 
    $searchParam, 
    $searchParam, 
    $searchParam, 
    $awalData, 
    $jmlDataPerHal
);

$stmt->execute();
$hasil = $stmt->get_result();

$output = '';
if ($hasil->num_rows > 0) {
    $output .= '<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Kadaluarsa</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';
    
    $no = $awalData + 1;
    while ($row = $hasil->fetch_assoc()) {
        $stokClass = $row['stok'] < 10 ? 'stok-warning' : 'stok-safe';
        
        $output .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . htmlspecialchars($row["kode_obat"]) . '</td>
                        <td>' . htmlspecialchars($row["nama_obat"]) . '</td>
                        <td>
                            <span class="jenis-badge">
                                ' . htmlspecialchars($row["jenis_obat"]) . '
                            </span>
                        </td>
                        <td class="' . $stokClass . '">' . $row["stok"] . '</td>
                        <td>Rp ' . number_format($row["harga_satuan"], 0, ',', '.') . '</td>
                        <td>' . date('d/m/Y', strtotime($row["tanggal_kadaluarsa"])) . '</td>
                        <td>' . htmlspecialchars($row["keterangan"]) . '</td>
                        <td>
                            <a href="edit_obat.php?id=' . $row["id"] . '" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-delete" 
                                    data-id="' . $row["id"] . '">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>';
        $no++;
    }
    $output .= '</tbody></table></div>';

    // Hitung total halaman untuk pagination
    $countStmt = $koneksi->prepare("SELECT COUNT(*) AS total FROM obat 
        WHERE nama_obat LIKE ? OR kode_obat LIKE ? OR jenis_obat LIKE ?");
    $countStmt->bind_param("sss", 
        $searchParam, 
        $searchParam, 
        $searchParam
    );
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalData = $countResult->fetch_assoc()['total'];
    $jmlHal = ceil($totalData / $jmlDataPerHal);

    if ($jmlHal > 1) {
        $output .= '<nav><ul class="pagination justify-content-center">';

        if ($page > 1) {
            $output .= '<li class="page-item">
                        <a class="page-link" href="#" data-page="' . ($page - 1) . '">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                       </li>';
        }

        for ($i = 1; $i <= $jmlHal; $i++) {
            $activeClass = $i == $page ? ' active' : '';
            $output .= '<li class="page-item">
                        <a class="page-link' . $activeClass . '" href="#" data-page="' . $i . '">' 
                            . $i . 
                        '</a>
                       </li>';
        }

        if ($page < $jmlHal) {
            $output .= '<li class="page-item">
                        <a class="page-link" href="#" data-page="' . ($page + 1) . '">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                       </li>';
        }

        $output .= '</ul></nav>';
    }
} else {
    $output .= '<div class="alert alert-info">Tidak ada data obat ditemukan</div>';
}

echo $output;
?>