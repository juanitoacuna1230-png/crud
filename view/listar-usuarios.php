<?php
if (!isset($usuarios)) {
    die("Acceso no permitido");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios | Mi Sistema</title>
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
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            padding: 1rem 1.5rem;
        }

        #sidebar-wrapper .list-group-item:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        #sidebar-wrapper .list-group-item.active {
            background: var(--primary-color);
            color: white;
        }

        #page-content-wrapper { width: 100%; flex-grow: 1; }

        .custom-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Estilo de la Tabla */
        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .table thead {
            background-color: #f8f9fa;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table-hover tbody tr:hover {
            background-color: #fff9f4;
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
            <a href="../view/crear-categoria.php" class="list-group-item list-group-item-action ">
                <i class="bi bi-folder me-2"></i> Categorías
            </a>
            <a href="../view/listar-productos.php" class="list-group-item list-group-item-action">
                <i class="bi bi-tag me-2"></i> Producto
            </a>
            <a href="#" class="list-group-item list-group-item-action active">
                <i class="bi bi-people me-2"></i> Usuarios
            </a>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light custom-navbar py-3 px-4">
            <div class="container-fluid">
                <h4 class="m-0">Gestión de Usuarios</h4>
                <a href="../view/dashboard.php" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </nav>

        <div class="container-fluid px-4 mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Usuarios Registrados</h2>
                <a href="../view/crear-usuario.php" class="btn btn-primary shadow-sm" style="background-color: var(--primary-color); border:none;">
                    <i class="bi bi-plus-lg"></i> Nuevo Usuario
                </a>
            </div>

            <div class="card main-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="px-4">ID</th>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Fecha Nacimiento</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $u): ?>
                                    <tr id="fila-<?= $u['id'] ?>">
                                        <td class="px-4">
                                            <span class="badge bg-light text-dark border">#<?= $u['id'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                    <?= strtoupper(substr($u['nombre'], 0, 1)) ?>
                                                </div>
                                                <span class="fw-bold"><?= htmlspecialchars($u['nombre']) ?></span>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($u['correo']) ?></td>
                                        <td><i class="bi bi-calendar3 me-2 text-muted"></i><?= $u['fecha_nac'] ?></td>
                                        <td class="text-center">
                                            <div class="btn-group shadow-sm">
                                                <a href="../controller/EditarUsuarioController.php?id=<?= $u['id'] ?>" class="btn btn-white btn-sm border" title="Editar">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="#" onclick="return confirmarEliminar(<?= $u['id'] ?>)" class="btn btn-white btn-sm border" title="Eliminar">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </a>
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
            title: '¿Eliminar usuario?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result)=> {
            if(result.isConfirmed){
                window.location.href = "../controller/EliminarUsuarioController.php?id=" + id;
            }
        });
        return false;
    }
</script>

<?php if (isset($_GET['eliminado'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Hecho!',
        text: 'Usuario eliminado correctamente',
        timer: 2000,
        showConfirmButton: false
    });
</script>
<?php endif; ?>

</body>
</html>