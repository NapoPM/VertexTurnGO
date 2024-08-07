<?php
namespace Model;

class UsuarioEmpresa extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'empresa';
    protected static $columnasDB = ['id', 'nombreEmpresa', 'nombre', 'apellido', 'email', 'telefono', 'codigoPostal', 'dniResponsable', 'password', 'admin', 'confirmado', 'token', 'TipoUsuario'];

    public $id;
    public $nombreEmpresa;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $codigoPostal;
    public $dniResponsable;
    public $password;
    public $admin;
    public $confirmado;
    public $token;
    public $TipoUsuario;
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombreEmpresa = $args['nombreEmpresa'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->codigoPostal = $args['codigoPostal'] ?? '';
        $this->dniResponsable = $args['dniResponsable'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->TipoUsuario = $args['TipoUsuario'] ?? 'Reservador';
    }
    // Validar el Login de UsuarioEmpresa
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
        if (!$this->nombreEmpresa) {
            self::$alertas['error'][] = 'El Nombre de la Empresa es Obligatorio';
        }
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El Teléfono es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->codigoPostal) {
            self::$alertas['error'][] = 'El Codigo Postal es Obligatorio';
        }
        if (!$this->dniResponsable) {
            self::$alertas['error'][] = 'El DNI Responsable es Obligatorio';
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
}