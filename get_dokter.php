<?php
require 'fungsi.php';

$jmlDataPerHal = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$awalData = ($jmlDataPerHal * $page) - $jmlDataPerHal;

$stmt = $koneksi->prepare("SELECT * FROM dokter 
    WHERE (nama_lengkap LIKE ? OR kode_dokter LIKE ? OR spesialisasi LIKE ?) 
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
                            <th>Nama Lengkap</th>
                            <th>Kode Dokter</th>
                            <th>Spesialisasi</th>
                            <th>No. STR</th>
                            <th>No. Telepon</th>
                            <th>L/P</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';
    
    $no = $awalData + 1;
    while ($row = $hasil->fetch_assoc()) {
        $firstLetter = strtoupper(substr($row["nama_lengkap"], 0, 1));
        
        $output .= '<tr>
                        <td>' . $no . '</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">' . $firstLetter . '</div>
                                <span>' . htmlspecialchars($row["nama_lengkap"]) . '</span>
                            </div>
                        </td>
                        <td>' . htmlspecialchars($row["kode_dokter"]) . '</td>
                        <td>
                            <span class="spesialisasi-badge">
                                ' . htmlspecialchars($row["spesialisasi"]) . '
                            </span>
                        </td>
                        <td>' . htmlspecialchars($row["no_str"]) . '</td>
                        <td>' . htmlspecialchars($row["no_telepon"]) . '</td>
                        <td>' . htmlspecialchars($row["jenis_kelamin"]) . '</td>
                        <td>
                            <a href="edit_dokter.php?id=' . $row["id"] . '" 
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
    $countStmt = $koneksi->prepare("SELECT COUNT(*) AS total FROM dokter 
        WHERE nama_lengkap LIKE ? OR kode_dokter LIKE ? OR spesialisasi LIKE ?");
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
    $output .= '<div class="alert alert-info">Tidak ada data dokter ditemukan</div>';
}

echo $output;
?>