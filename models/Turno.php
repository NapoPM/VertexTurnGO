<?php
namespace Model;

class Turno extends ActiveRecord {
    protected static $tabla = 'turnos';
    protected static $columnasDB = ['id', 'idServicio', 'dias', 'horaInicio', 'horaFin', 'frecuenciaMinutos', 'idEmpresa'];

    public $id;
    public $idServicio;
    public $dias;
    public $horaInicio;
    public $horaFin;
    public $frecuenciaMinutos;
    public $idEmpresa;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->idServicio = $args['idServicio'] ?? null;
        $this->dias = $args['dias'] ?? null;
        $this->horaInicio = $args['horaInicio'] ?? null;
        $this->horaFin = $args['horaFin'] ?? null;
        $this->frecuenciaMinutos = $args['frecuenciaMinutos'] ?? null;
        $this->idEmpresa = $args['idEmpresa'] ?? null;
    }

    public function validar() {
        self::$alertas = [];
        if (!$this->idServicio) {
            self::$alertas[] = "El servicio es obligatorio.";
        }
        if (!$this->dias) {
            self::$alertas[] = "Los días son obligatorios.";
        }
        if (!$this->horaInicio) {
            self::$alertas[] = "La hora de inicio es obligatoria.";
        }
        if (!$this->horaFin) {
            self::$alertas[] = "La hora de fin es obligatoria.";
        }
        if (!$this->frecuenciaMinutos) {
            self::$alertas[] = "La frecuencia es obligatoria.";
        }
        return self::$alertas;
    }


    public static function whereTurn($column, $value) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$column} = '{$value}'";
        $resultado = self::$db->query($query);

        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = new self($registro);
        }

    

        return $array;
    }

    public static function eliminarPorServicio($idServicio) {
        $query = "DELETE FROM " . static::$tabla . " WHERE idServicio = '{$idServicio}'";
        self::$db->query($query);
    }    
}
