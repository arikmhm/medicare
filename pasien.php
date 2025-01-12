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
    <title>MediCare - Manajemen Pasien</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/page.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(135deg, #43C6AC 0%, #191654 100%);
        }

        .navbar h1 {
            color: white;
        }

        .page-header {
            display: flex;
            justify-content: right;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-container {
            position: relative;
            max-width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #E2E8F0;
            border-radius: 0.5rem;
            background-color: white;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
        }

        .btn-add {
            background: #43C6AC;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background: #191654;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .table {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #F8FAFC;
            color: #64748B;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: #43C6AC;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            color: white;
        }

        .blood-type-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            background: rgba(67, 198, 172, 0.1);
            color: #43C6AC;
        }

        .pagination {
            margin-top: 1.5rem;
            justify-content: center;
        }

        .page-link {
            border: none;
            color: #64748B;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
        }

        .page-link.active {
            background: #43C6AC;
            color: white;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
        }

        .btn-outline-primary {
            color: #43C6AC;
            border-color: #43C6AC;
        }

        .btn-outline-primary:hover {
            background: #43C6AC;
            border-color: #43C6AC;
            color: white;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .navbar {
            margin-left: 250px;
        }
        .main-content {
         margin-left: 250px;   
        }
    </style>
</head>
<body>
    <?php require "sidebar.html"; ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light shadow-sm py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-0">Manajemen Pasien</h1>
            
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
        <div class="page-header">
            <div class="d-flex align-items-center gap-4">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="search" class="search-input" placeholder="Cari pasien..." autofocus>
                </div>
                
                <a href="tambah_pasien.php" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Pasien Baru
                </a>
            </div>
        </div>

        <div id="feedback" class="alert" style="display:none;"></div>
        <div id="result"></div>
    </div>

    <script src="js/script.js"></script>

</body>
</html>