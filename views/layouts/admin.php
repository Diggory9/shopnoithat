<?php
use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="<?php



 echo BASE__URL?>css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo BASE__URL?>css/admin.css" rel="stylesheet" />
    <link href="<?php echo BASE__URL?>css/style.css" rel="stylesheet"/>
    <link href="<?php echo BASE__URL?>css/detailproduct.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Trang quản trị</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->

        <!-- Navbar-->
        <ul class="d-none d-md-inline-block navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="\logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                       <!-- Danh mục -->
                       <a class="nav-link" href="/admin/category">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                           Quản lý danh mục
                        </a>
                        <!-- Sản phẩm -->
                        <a class="nav-link" href="/admin/product">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                           Quản lý sản phẩm
                        </a>
                         <!-- Role -->
                        <a class="nav-link" href="/admin/role">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                           Quản lý role
                        </a>
                         <!-- Nhà cung cấp -->
                        <a class="nav-link" href="/admin/supplier">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                           Quản lý nhà cung cấp
                        </a>
                         <!-- User -->
                        <a class="nav-link" href="/admin/user">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                           Quản lý user
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
        <?php
		if (!empty(Application::$app->session->getFlash('success'))): ?>
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<strong>Well done!</strong> <?php echo Application::$app->session->getFlash('success')?>
			</div>

			<?php Application::$app->session->removeFlash('success')?>
		<?php endif; ?>
            {{content}}
            
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASE__URL?>assets/demo/chart-area-demo.js"></script>
    <script src="<?php echo BASE__URL?>assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="<?php echo BASE__URL?>js/datatables-simple-demo.js"></script>
    <script src="<?php echo BASE__URL?>js/detailproduct.js"></script>
</body>

</html>