<?php 
require_once '../model/categoria.php';
$categoriaModel = new categoria();
$categoria = $categoriaModel->obtenerTodas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías | Mi Sistema</title>
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

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(216, 101, 29, 0.25);
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
            <a href="#" class="list-group-item list-group-item-action active">
                <i class="bi bi-folder me-2"></i> Categorías
            </a>
            <a href="listar-productos.php" class="list-group-item list-group-item-action">
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
                <h4 class="m-0">Gestión de Categorías</h4>
                <a href="../view/dashboard.php" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
            </div>
        </nav>

        <div class="container-fluid px-4 mt-4">
            <div class="row g-4">
                
                <div class="col-lg-4">
                    <div class="card main-card p-4">
                        <h5 class="card-title mb-4"><i class="bi bi-plus-circle me-2"></i>Nueva Categoría</h5>
                        <form method="POST" action="../controller/CategoriaController.php">
                            <div class="mb-3">
                                <label class="form-label text-muted small uppercase fw-bold">Nombre de la Categoría</label>
                                <input type="text" name="nombre" class="form-control form-control-lg" placeholder="Ej: Electrónica" required>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-warning btn-lg text-white" style="background-color: var(--primary-color); border:none;">
                                    <i class="bi bi-save me-2"></i>Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card main-card">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h5 class="m-0">Categorías Existentes</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="px-4">ID</th>
                                            <th>Nombre</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categoria as $c): ?>
                                        <tr>
                                            <td class="px-4"><span class="text-muted">#<?= $c['id'] ?></span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-folder2-open me-2 text-warning"></i>
                                                    <span class="fw-bold"><?= htmlspecialchars($c['nombre']) ?></span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button onclick="confirmarEliminar(<?= $c['id'] ?>)" class="btn btn-outline-danger btn-sm border-0">
                                                    <i class="bi bi-trash3-fill"></i> Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div> </div> </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_GET['error'])): ?>
<script>
    Swal.fire({
        title: '¡Aviso!',
        text: 'No puedes eliminar una categoría con productos asociados.',
        icon: 'warning',
        confirmButtonColor: '#d8651d'
    });
</script>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
<script>
    Swal.fire({
        title: '¡Éxito!',
        text: 'Categoría procesada correctamente.',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
</script>
<?php endif; ?>

<script>
    function confirmarEliminar(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se borrará la categoría seleccionada.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed){
                window.location.href = "../controller/CategoriaController.php?eliminar=" + id;
            }
        });
    }
</script>

</body>
</html>