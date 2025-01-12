<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit();
}
require "fungsi.php";

// Statistik Dasar
$total_pasien = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pasien"))['total'];
$total_dokter = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM dokter"))['total'];
$total_obat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM obat"))['total'];
$obat_menipis = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM obat WHERE stok < 10"))['total'];

// Get statistik jenis kelamin
$gender_stats = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT 
        SUM(CASE WHEN jenis_kelamin = 'L' THEN 1 ELSE 0 END) as total_male,
        SUM(CASE WHEN jenis_kelamin = 'P' THEN 1 ELSE 0 END) as total_female
    FROM pasien
"));

// Get statistik dokter berdasarkan spesialisasi
$spesialisasi_query = mysqli_query($koneksi, "SELECT spesialisasi, COUNT(*) as count FROM dokter GROUP BY spesialisasi");
$spesialisasi_labels = [];
$spesialisasi_data = [];
while ($row = mysqli_fetch_assoc($spesialisasi_query)) {
    $spesialisasi_labels[] = $row['spesialisasi'];
    $spesialisasi_data[] = $row['count'];
}

// Get statistik obat berdasarkan jenis
$jenis_obat_query = mysqli_query($koneksi, "SELECT jenis_obat, COUNT(*) as count FROM obat GROUP BY jenis_obat");
$jenis_obat_labels = [];
$jenis_obat_data = [];
while ($row = mysqli_fetch_assoc($jenis_obat_query)) {
    $jenis_obat_labels[] = $row['jenis_obat'];
    $jenis_obat_data[] = $row['count'];
}

// Get data terbaru
$latest_patients = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY created_at DESC LIMIT 5");
$latest_doctors = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY created_at DESC LIMIT 5");
$stok_menipis = mysqli_query($koneksi, "SELECT * FROM obat WHERE stok < 10 ORDER BY stok ASC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Administrator - MediCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/page.css">

</head>

<body>
    <?php require "sidebar.html"; ?>

    <nav class="navbar navbar-expand navbar-light shadow-sm py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-0">Dashboard MediCare</h1>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-large text-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-0"><?php echo $total_pasien; ?></h3>
                            <p class="text-muted mb-0">Total Pasien</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-large text-success">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-0"><?php echo $total_dokter; ?></h3>
                            <p class="text-muted mb-0">Total Dokter</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-large text-info">
                            <i class="fas fa-pills"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-0"><?php echo $total_obat; ?></h3>
                            <p class="text-muted mb-0">Total Obat</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon-large text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-0"><?php echo $obat_menipis; ?></h3>
                            <p class="text-muted mb-0">Stok Menipis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="card-title mb-4">Distribusi Dokter per Spesialisasi</h5>
                    <canvas id="doctorChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="card-title mb-4">Distribusi Obat per Jenis</h5>
                    <canvas id="medicineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Lists Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="card-title mb-4">Pasien Terbaru</h5>
                    <div class="data-list">
                        <?php while($patient = mysqli_fetch_assoc($latest_patients)) : ?>
                        <div class="list-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar mr-3">
                                    <?php echo substr($patient['nama_lengkap'], 0, 1); ?>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo $patient['nama_lengkap']; ?></h6>
                                    <small class="text-muted">
                                        <i class="fas fa-phone-alt mr-1"></i>
                                        <?php echo $patient['nomor_telepon']; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="card-title mb-4">Dokter Terbaru</h5>
                    <div class="data-list">
                        <?php while($doctor = mysqli_fetch_assoc($latest_doctors)) : ?>
                        <div class="list-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar mr-3">
                                    <?php echo substr($doctor['nama_lengkap'], 0, 1); ?>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo $doctor['nama_lengkap']; ?></h6>
                                    <small class="text-muted">
                                        <i class="fas fa-user-md mr-1"></i>
                                        <?php echo $doctor['spesialisasi']; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="card-title mb-4">Stok Obat Menipis</h5>
                    <div class="data-list">
                        <?php while($obat = mysqli_fetch_assoc($stok_menipis)) : ?>
                        <div class="list-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar mr-3">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo $obat['nama_obat']; ?></h6>
                                    <small class="danger-text">
                                        <i class="fas fa-box-open mr-1"></i>
                                        Stok: <?php echo $obat['stok']; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Dokter
        const doctorCtx = document.getElementById('doctorChart').getContext('2d');
        new Chart(doctorCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($spesialisasi_labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($spesialisasi_data); ?>,
                    backgroundColor: [
                        'rgba(67, 198, 172, 0.8)',
                        'rgba(25, 22, 84, 0.8)',
                        'rgba(111, 82, 237, 0.8)',
                        'rgba(47, 128, 237, 0.8)',
                        'rgba(236, 201, 75, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        align: 'center'
                    }
                }
            }
        });

        // Chart Obat
        const medicineCtx = document.getElementById('medicineChart').getContext('2d');
        new Chart(medicineCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jenis_obat_labels); ?>,
                datasets: [{
                    label: 'Jumlah Obat',
                    data: <?php echo json_encode($jenis_obat_data); ?>,
                    backgroundColor: 'rgba(67, 198, 172, 0.8)',
                    borderColor: 'rgba(67, 198, 172, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
    </script>
</body>
</html>