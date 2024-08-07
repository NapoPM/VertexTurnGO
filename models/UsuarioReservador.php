<?php
namespace Model;

class UsuarioReservador extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'reservador';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'DNI', 'email', 'telefono', 'password', 'confirmado', 'token', 'TipoUsuario'];

    public $id;
    public $nombre;
    public $apellido;
    public $DNI;
    public $email;
    public $telefono;
    public $password;
    public $confirmado;
    public $token;
    public $TipoUsuario;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->DNI = $args['DNI'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->TipoUsuario = $args['TipoUsuario'] ?? 'Reservador';
    }
    // Validar el Login de UsuarioReservador
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        return self::$alertas;

    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta(){
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->DNI) {
            self::$alertas['error'][] = 'El DNI es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El Teléfono es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }
    

    public function existeUsuario(){
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";        
        $resultado = self::$db->query($query);
        
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El Usuario ya está registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    // Método para obtener el usuario por su ID
    public static function findById($id) {
        $query = "SELECT * FROM " . self::$tabla . " WHERE id = " . self::$db->real_escape_string($id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado && $resultado->num_rows > 0) {
            return new self($resultado->fetch_assoc());
        } else {
            return null;
        }
    }
    
    
}
