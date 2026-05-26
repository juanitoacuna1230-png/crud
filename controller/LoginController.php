<?php
declare(strict_types=1);

require_once __DIR__. "/../model/usuario.php";

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $usuarioModel = new usuario();
    $usuario = $usuarioModel->obtenerPorCorreo($correo);

    if ($usuario) {

    if (password_verify($password, $usuario['password'])) {

        session_regenerate_id(true);

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];

        header("Location: ../view/dashboard.php");
        exit;
    }

    elseif ($password === $usuario['password']) {

        $nuevoHash = password_hash($password, PASSWORD_BCRYPT);

        $db = conexion::getInstance()->getConexion();
        $stmt = $db->prepare("UPDATE usuarios SET password = :pass WHERE id = :id");
        $stmt->execute([
            ':pass' => $nuevoHash,
            ':id' => $usuario['id']
        ]);

        session_regenerate_id(true);

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];

        header("Location: ../view/dashboard.php");
        exit;
    }
}

    echo "Correo o Contraseña incorrectos";
}

?>