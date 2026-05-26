<?php  
declare(strict_types=1);

require_once __DIR__. '/../config/conexion.php';

class producto{

    private PDO $db;

    public function __construct()
    {
        $this->db = conexion::getInstance()->getConexion();
    }

    public function insertar(string $nombre, float $precio, int $idCategoria): bool
    {
        $sql = "INSERT INTO productos (nombre, precio, id_categorias)
                VALUES (:nombre, :precio, :id_categorias)";

        $stmt = $this->db->prepare($sql);
        
        return  $stmt->execute([
            ':nombre' => htmlspecialchars(trim($nombre)),
            ':precio' => $precio,
            ':id_categorias' => $idCategoria
        ]);
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT 
                    productos.id,
                    productos.nombre,
                    productos.precio,
                    categorias.nombre AS categoria
                FROM productos
                JOIN  categorias
                    ON productos.id_categorias = categorias.id";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

}


?>