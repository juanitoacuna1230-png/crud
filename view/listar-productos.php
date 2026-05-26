<?php 
require_once '../model/producto.php';
$productoModel = new producto();
$producto = $productoModel->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos | Mi Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #d8651d;
            --sidebar-bg: #212529;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        #wrapper { display: flex; width: 100%; }
        
        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            background: var(--sidebar-bg);
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem;
            color: white;
            font-weight: bold;
            border-bottom: 1px solid #3d4146;
        }

        #sidebar-wrapper .list-group-item {
            background: none; border: none;
            color: rgba(255,255,255,0.7);
            padding: 1rem 1.5rem;
        }

        #sidebar-wrapper .list-group-item:hover {
            color: white; background: rgba(255,255,255,0.1);
        }

        #sidebar-wrapper .list-group-item.active {
            background: var(--primary-color); color: white;
        }

        #page-content-wrapper { width: 100%; flex-grow: 1; }

        .custom-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .price-text {
            color: #28a745;
            font-weight: 600;
        }

        .category-badge {
            background-color: #fff4e6;
            color: #d8651d;
            border: 1px solid #ffd8a8;
            padding: 0.4em 0.8em;
            border-radius: 50px;
            font-size: 0.85rem;
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
            <a href="../view/dashboard.php" class="list-group-item list-group-item-action">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="crear-categoria.php" class="list-group-item list-group-item-action">
                <i class="bi bi-folder me-2"></i> Categorías
            </a>
            <a href="#" class="list-group-item list-group-item-action active">
                <i class="bi bi-tag me-2"></i> Productos
            </a>
            <a href="../controller/ListarUsuarioController.php" class="list-group-item list-group-item-action">
                <i class="bi bi-people me-2"></i> Usuarios
            </a>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light custom-navbar py-3 px-4">
            <div class="container-fluid">
                <h4 class="m-0">Gestión de Inventario</h4>
                <a href="../view/dashboard.php" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </nav>

        <div class="container-fluid px-4 mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Catálogo de Productos</h2>
                <a href="../view/crear-producto.php" class="btn btn-success shadow-sm border-0" style="background-color: #198754;">
                    <i class="bi bi-cart-plus me-1"></i> Nuevo Producto
                </a>
            </div>

            <div class="card main-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4">ID</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Categoría</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($producto as $p): ?>
                                <tr>
                                    <td class="px-4 text-muted">#<?= $p['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded p-2 me-3">
                                                <i class="bi bi-box text-secondary"></i>
                                            </div>
                                            <span class="fw-bold"><?= htmlspecialchars($p['nombre']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price-text">$<?= number_format($p['precio'], 2) ?></span>
                                    </td>
                                    <td>
                                        <span class="category-badge">
                                            <?= htmlspecialchars($p['categoria']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group shadow-sm">
                                            <button onclick="confirmarEliminar(<?= $p['id'] ?>)" class="btn btn-white btn-sm border text-danger" title="Eliminar">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEliminar(id){
        Swal.fire({
            title: '¿Eliminar producto?',
            text: "Se quitará del inventario permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "../controller/ProductoController.php?eliminar=" + id;
            }
        });
    }
</script>

</body>
</html>