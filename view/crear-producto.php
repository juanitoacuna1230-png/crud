<?php 
require_once '../model/categoria.php';

$categoriaModel = new categoria();
$categoria = $categoriaModel->obtenerTodas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Crear Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body{
            background: linear-gradient(135deg, #d8651d, #94920d);
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .card{
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="bg-light">

   <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="mb-4">Crear Producto</h3>

            <form method="POST" action="../controller/productoController.php">
            
                <div class="mb-3">
                    <label  class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">categoria</label>
                    <select name="id_categoria" class="form-select" required>
                        <option value="" disabled selected>Selecione</option>
                        <?php foreach ($categoria as $c): ?>
                            <option value="<?= $c['id'] ?>">
                                <?= $c['nombre'] ?>
                            </option>
                        <?php endforeach;  ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="../view/dashboard.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>

</body>
</html>