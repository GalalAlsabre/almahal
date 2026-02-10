<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'نظام إدارة الفندق' ?></title>
    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d2451;
            --secondary-color: #f39c12;
            --bg-light: #f4f7f6;
            --sidebar-width: 250px;
        }
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-light);
        }
        .wrapper {
            display: flex;
            width: 100%;
        }
        #sidebar {
            width: var(--sidebar-width);
            background: var(--primary-color);
            color: #fff;
            min-height: 100vh;
            transition: all 0.3s;
            position: fixed;
            right: 0;
            z-index: 1000;
        }
        #content {
            width: calc(100% - var(--sidebar-width));
            margin-right: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }
        .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            text-align: center;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li a {
            padding: 15px 20px;
            display: block;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar-menu li a:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        .sidebar-menu li a i {
            margin-left: 10px;
            width: 20px;
        }
        .sidebar-menu li.active > a {
            background: var(--secondary-color);
            color: #fff;
        }
        .top-navbar {
            background: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04);
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        /* Room Grid */
        .room-box {
            height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            color: #fff;
            margin-bottom: 15px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .room-box:hover {
            transform: scale(1.05);
        }
        .room-available { background-color: #27ae60; }
        .room-busy { background-color: #e74c3c; }
        .room-dirty { background-color: #f1c40f; }
        .room-maintenance { background-color: #95a5a6; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-hotel"></i> إدارة الفندق</h4>
            </div>
            <ul class="sidebar-menu">
                <li class="<?= $active_menu == 'dashboard' ? 'active' : '' ?>">
                    <a href="/dashboard"><i class="fas fa-home"></i> الرئيسية</a>
                </li>
                <li class="<?= $active_menu == 'bookings' ? 'active' : '' ?>">
                    <a href="/bookings"><i class="fas fa-calendar-check"></i> الحجوزات</a>
                </li>
                <li class="<?= $active_menu == 'rooms' ? 'active' : '' ?>">
                    <a href="/rooms"><i class="fas fa-bed"></i> الغرف</a>
                </li>
                <li class="<?= $active_menu == 'accounting' ? 'active' : '' ?>">
                    <a href="/accounting"><i class="fas fa-calculator"></i> المالية</a>
                </li>
                <li class="<?= $active_menu == 'reports' ? 'active' : '' ?>">
                    <a href="/reports"><i class="fas fa-file-invoice-dollar"></i> التقارير</a>
                </li>
                <li class="<?= $active_menu == 'settings' ? 'active' : '' ?>">
                    <a href="/settings"><i class="fas fa-cogs"></i> الإعدادات</a>
                </li>
                <li>
                    <a href="/auth/logout"><i class="fas fa-sign-out-alt"></i> خروج</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <div class="top-navbar">
                <div>
                    <span class="text-muted">مرحباً، <strong><?= $_SESSION['full_name'] ?></strong></span>
                </div>
                <div>
                    <span class="badge bg-secondary"><?= $_SESSION['role'] == 'admin' ? 'مدير' : ($_SESSION['role'] == 'receptionist' ? 'موظف استقبال' : 'محاسب') ?></span>
                </div>
            </div>

            <div class="container-fluid">
                <?php if (isset($flash_success)): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $flash_success ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($flash_error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $flash_error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?= $content ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Common AJAX setup if needed
    </script>
</body>
</html>
