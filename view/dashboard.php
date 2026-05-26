<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #d8651d;
            --secondary-color: #94920d;
            --sidebar-bg: #212529;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Estructura Sidebar */
        #wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            background: var(--sidebar-bg);
            transition: all 0.3s;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem;
            font-size: 1.2rem;
            color: white;
            font-weight: bold;
            border-bottom: 1px solid #3d4146;
        }

        #sidebar-wrapper .list-group-item {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            padding: 1rem 1.5rem;
            transition: 0.3s;
        }

        #sidebar-wrapper .list-group-item:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        #sidebar-wrapper .list-group-item.active {
            background: var(--primary-color);
            color: white;
        }

        /* Contenido Principal */
        #page-content-wrapper {
            width: 100%;
            flex-grow: 1;
        }

        .custom-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 15px;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
            <i class="bi bi-box-seam me-2"></i> Mi Sistema
        </div>
        <div class="list-group list-group-flush mt-3">
            <a href="#" class="list-group-item list-group-item-action active">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="crear-categoria.php" class="list-group-item list-group-item-action">
                <i class="bi bi-folder me-2"></i> Categorías
            </a>
            <a href="listar-productos.php" class="list-group-item list-group-item-action">
                <i class="bi bi-tag me-2"></i> Productos
            </a>
            <a href="../controller/ListarUsuarioController.php" class="list-group-item list-group-item-action">
                <i class="bi bi-people me-2"></i> Usuarios
            </a>
            <a href="../controller/LogoutController.php" class="list-group-item list-group-item-action text-danger mt-5">
                <i class="bi bi-box-arrow-left me-2"></i> Cerrar Sesión
            </a>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light custom-navbar py-3 px-4">
            <div class="container-fluid">
                <h4 class="m-0">Panel de Control</h4>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 d-none d-md-inline">Hola, <strong><?= $_SESSION['nombre'] ?></strong></span>
                    <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['nombre'] ?>&background=d8651d&color=fff" class="rounded-circle" width="35" alt="user">
                </div>
            </div>
        </nav>

        <div class="container-fluid px-4 mt-4">
            <div class="card welcome-card p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>¡Bienvenido de nuevo! 👋</h2>
                        <p class="mb-0">Aquí tienes un resumen de lo que está pasando en tu sistema hoy.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-sm-6 col-xl-4">
                    <a href="crear-categoria.php" class="text-decoration-none text-dark">
                        <div class="card stat-card p-3">
                            <div class="icon-box bg-warning text-white">
                                <i class="bi bi-folder-plus"></i>
                            </div>
                            <h5>Categorías</h5>
                            <p class="text-muted small m-0">Gestionar y crear nuevas secciones.</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <a href="listar-productos.php" class="text-decoration-none text-dark">
                        <div class="card stat-card p-3">
                            <div class="icon-box bg-primary text-white">
                                <i class="bi bi-cart4"></i>
                            </div>
                            <h5>Productos</h5>
                            <p class="text-muted small m-0">Ver inventario y existencias.</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <a href="../controller/ListarUsuarioController.php" class="text-decoration-none text-dark">
                        <div class="card stat-card p-3">
                            <div class="icon-box bg-dark text-white">
                                <i class="bi bi-person-gear"></i>
                            </div>
                            <h5>Usuarios</h5>
                            <p class="text-muted small m-0">Control de permisos y cuentas.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>


