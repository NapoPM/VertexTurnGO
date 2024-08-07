<?php
namespace Model;


class Servicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombreServicio', 'imagenServicio', 'id_categoria', 'descripcion', 'precio', 'created_at', 'id_empresa'];

    public $id;
    public $nombreServicio;
    public $imagenServicio;
    public $id_categoria;
    public $descripcion;
    public $precio;
    public $created_at;
    public $id_empresa;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombreServicio = $args['nombreServicio'] ?? '';
        $this->imagenServicio = $args['imagenServicio'] ?? '';
        $this->id_categoria = $args['id_categoria'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '0.00';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->id_empresa = $args['id_empresa'] ?? null;
    }
     // Constructor y métodos como sincronizar y validarNuevoServicio deben ajustarse según sea necesario

    // Método para sincronizar datos del formulario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }


    // Método para validar nuevo servicio
    public function validarNuevoServicio() {
        if(!$this->nombreServicio) {
            self::$alertas['error'][] = 'El nombre del servicio es obligatorio';
        }

        if(!$this->id_categoria) {
            self::$alertas['error'][] = 'La categoría del servicio es obligatoria';
        }

        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción del servicio es obligatoria';
        }

        if(!$this->precio) {
            self::$alertas['error'][] = 'El precio del servicio es obligatorio';
        }

        return self::$alertas;
    }

    // Método para guardar la imagen del servicio
    public function setImagen($imagen) {
        // Eliminar imagen previa si existe
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        // Asignar el nombre de la imagen al atributo
        $this->imagenServicio = $imagen;
    }

    // Método para eliminar imagen previa (opcional)
    public function borrarImagen() {
        // Eliminar la imagen previa del servidor
        if(file_exists(CARPETA_IMAGENES . $this->imagenServicio)) {
            unlink(CARPETA_IMAGENES . $this->imagenServicio);
        }
    }


    //Obtiene los servicios para mostrarlos
    public static function obtenerServicios() {
        $id_empresa = $_SESSION['id'] ?? null;
        if ($id_empresa) {
            
            $query = "SELECT * FROM " . self::$tabla . " WHERE id_empresa = ?";
            
            // Preparar la consulta
            $stmt = self::$db->prepare($query);
            $stmt->bind_param('i', $id_empresa);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $servicios = [];
            while ($row = $resultado->fetch_assoc()) {
                $servicios[] = new self($row);
            }
    
            $stmt->close();
            return $servicios;
        } else {
            self::setAlerta('error', 'No estás logeado como empresa');
            return [];
        }
    }

    // Método para obtener servicios por categoría con datos de la empresa
    public static function obtenerPorCategoria($id_categoria) {
        $query = "SELECT servicios.*, empresa.nombreEmpresa AS nombreEmpresa FROM " . self::$tabla . " 
                  LEFT JOIN empresa ON servicios.id_empresa = empresa.id 
                  WHERE id_categoria = " . self::$db->real_escape_string($id_categoria);

        $resultado = self::$db->query($query);

        $servicios = [];
        while ($row = $resultado->fetch_assoc()) {
            $servicio = new self($row);
            $servicio->nombreEmpresa = $row['nombreEmpresa'] ?? '';
            $servicios[] = $servicio;
        }

        return $servicios;
    }

}
