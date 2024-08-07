<?php

namespace Model;


class Frecuencia extends ActiveRecord {
    protected static $tabla = 'frecuencia';
    protected static $columnasDB = ['idFrecuencia', 'minutos'];

    public $id;
    public $minutos;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->minutos = $args['minutos'] ?? null;
    }

    public static function obtenerTodos() {
        $query = "SELECT * FROM " . self::$tabla;
        $resultado = self::$db->query($query);

        $frecuencia = [];
        while ($row = $resultado->fetch_assoc()) {
            $frecuencia[] = new self($row);
        }

        return $frecuencia;
    }
}