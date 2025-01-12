<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MediCare - Tambah Obat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>

    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/page.css">
    
    <style>
        .form-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .section-title {
            background: #43C6AC;
            color: white;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        .form-group label {
            font-weight: 500;
            color: #64748B;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #E2E8F0;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #43C6AC;
            box-shadow: 0 0 0 2px rgba(67, 198, 172, 0.1);
        }

        select.form-control {
            height: auto !important;
            padding: 0.75rem 1rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2343C6AC' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
            padding-right: 2.5rem;
        }

        .btn-submit {
            background: #43C6AC;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #191654;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: transparent;
            color: #43C6AC;
            border: 1px solid #43C6AC;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 500;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: rgba(67, 198, 172, 0.1);
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>

<body>
    <?php require "sidebar.html"; ?>

    <nav class="navbar navbar-expand navbar-light shadow-sm py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-0">Tambah Obat Baru</h1>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="form-section">
            <h4 class="section-title">Data Obat</h4>
            
            <form id="addMedicineForm">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Kode Obat</label>
                            <input type="text" class="form-control" name="kode_obat" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Jenis Obat</label>
                            <select class="form-control" name="jenis_obat" required>
                                <option value="">Pilih Jenis Obat</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Kapsul">Kapsul</option>
                                <option value="Sirup">Sirup</option>
                                <option value="Salep">Salep</option>
                                <option value="Injeksi">Injeksi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Stok</label>
                            <input type="number" class="form-control" name="stok" required min="0">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Harga Satuan (Rp)</label>
                            <input type="number" class="form-control" name="harga_satuan" required min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Tanggal Kadaluarsa</label>
                            <input type="date" class="form-control" name="tanggal_kadaluarsa" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='obat.php'">Batal</button>
                    <button type="submit" class="btn btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#addMedicineForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: 'sv_tambah_obat.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if(response === 'success') {
                        alert('Data obat berhasil disimpan');
                        window.location.href = 'obat.php';
                    } else {
                        alert('Gagal menyimpan data: ' + response);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data');
                }
            });
        });
    });
    </script>
</body>
</html>